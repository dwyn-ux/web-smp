<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ArticleAdminController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
            'tags' => 'nullable'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'uploads');
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'published' => true
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dipublikasikan.');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('articles/content', 'uploads');
            return response()->json(['location' => '/uploads/' . $path]);
        }
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|min:10',
            'provider' => 'nullable|string|in:openai,deepseek,gemini,custom',
            'endpoint' => 'nullable|string|url',
            'api_key' => 'nullable|string',
            'model' => 'nullable|string',
        ]);

        $provider = $request->input('provider', 'openai');

        $prompt = trim($request->prompt);
        $systemPrompt = 'Kamu adalah penulis artikel profesional berbahasa Indonesia untuk website sekolah. Gayamu natural, hangat, dan mudah dipahami — seperti tulisan manusia, bukan robot. Kamu tidak pernah menggunakan markdown (tanpa ##, **, -, atau simbol lainnya). Setiap paragraf dipisahkan oleh satu baris kosong (ENTER), bukan pakai poin atau bullet. Judul dan isi dipisahkan dengan jelas. Di akhir artikel, selalu sertakan 3–5 tag keyword yang relevan, dipisahkan koma. Artikel yang kamu tulis SEO-friendly dan enak dibaca. Kamu TIDAK PERNAH membalas dengan kalimat pembuka seperti "Tentu, berikut artikelnya" atau sejenisnya — langsung tulis artikel saja.';
        $userPrompt = "Tulis artikel dalam bahasa Indonesia tentang topik ini: \"{$prompt}\".\n\nAturan WAJIB:\n- JANGAN gunakan markdown apapun (tidak ada ##, **, *, -, atau simbol format)\n- JANGAN mulai dengan kalimat pembuka seperti \"Tentu, berikut artikel...\" atau \"Berikut adalah artikel...\" — LANGSUNG tulis judul artikel di baris pertama\n- Judul artikel di baris pertama, tanpa tanda baca apapun di awal\n- Kosongkan satu baris setelah judul, lalu tulis isi artikel\n- Setiap paragraf dipisahkan satu baris kosong (ENTER)\n- Gaya bahasa natural seperti tulisan manusia, bukan AI\n- Akhiri dengan baris kosong lalu tulis \"Tags: tag1, tag2, tag3\" (3-5 tag yang benar-benar mencerminkan isi artikel, bukan tag generik seperti SEO)\n- Target panjang: 600–900 kata";

        $content = match ($provider) {
            'deepseek' => $this->callDeepSeek($systemPrompt, $userPrompt),
            'gemini' => $this->callGemini($systemPrompt, $userPrompt),
            'custom' => $this->callCustom($systemPrompt, $userPrompt, $request),
            default => $this->callOpenAI($systemPrompt, $userPrompt),
        };

        if ($content === null) {
            return response()->json(['error' => 'Gagal menghasilkan konten.'], 500);
        }

        return response()->json(['content' => $content]);
    }

    private function callOpenAI(string $system, string $user): ?string
    {
        $apiKey = config('services.openai.key');
        if (! $apiKey) {
            return null;
        }

        $response = Http::withToken($apiKey)
            ->timeout(60)
            ->post(config('services.openai.base_uri') . '/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $user],
                ],
                'temperature' => 0.7,
                'max_tokens' => 1500,
            ]);

        if ($response->failed()) {
            return null;
        }

        return data_get($response->json(), 'choices.0.message.content');
    }

    private function callDeepSeek(string $system, string $user): ?string
    {
        $apiKey = config('services.deepseek.key');
        if (! $apiKey) {
            return null;
        }

        $response = Http::withToken($apiKey)
            ->timeout(60)
            ->post(config('services.deepseek.base_uri') . '/v1/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $user],
                ],
                'temperature' => 0.7,
                'max_tokens' => 1500,
            ]);

        if ($response->failed()) {
            return null;
        }

        return data_get($response->json(), 'choices.0.message.content');
    }

    private function callGemini(string $system, string $user): ?string
    {
        $apiKey = config('services.gemini.key');
        if (! $apiKey) {
            return null;
        }

        $response = Http::timeout(60)
            ->post(config('services.gemini.base_uri') . '/v1beta/models/gemini-2.0-flash:generateContent', [
                'key' => $apiKey,
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $system . "\n\n" . $user],
                        ],
                    ],
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 1500,
                ],
            ]);

        if ($response->failed()) {
            return null;
        }

        return data_get($response->json(), 'candidates.0.content.parts.0.text');
    }

    private function callCustom(string $system, string $user, Request $request): ?string
    {
        $endpoint = $request->input('endpoint');
        $apiKey = $request->input('api_key');
        $model = $request->input('model', 'gpt-4o-mini');

        if (! $endpoint) {
            return null;
        }

        $http = Http::timeout(60);

        if ($apiKey) {
            $http = $http->withToken($apiKey);
        }

        $response = $http->post($endpoint, [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => $user],
            ],
            'temperature' => 0.7,
            'max_tokens' => 1500,
        ]);

        if ($response->failed()) {
            return null;
        }

        return data_get($response->json(), 'choices.0.message.content');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
            'tags' => 'nullable'
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'uploads');
        }

        $slug = Str::slug($request->title);
        if ($slug !== $article->slug) {
            $originalSlug = $slug;
            $counter = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        }

        $article->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return back();
    }
}
