<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleEditorTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_page_loads_existing_content_into_visual_editor(): void
    {
        $user = User::factory()->create();
        $article = Article::create([
            'title' => 'Artikel Lama',
            'slug' => 'artikel-lama',
            'content' => '<p>Isi artikel lama — harus tampil dan bisa diedit.</p>',
            'published' => true,
        ]);

        $response = $this->actingAs($user)->get(route('admin.articles.edit', $article));

        $response->assertOk();
        $response->assertSee($article->content, false);
        $response->assertSee('contenteditable="true"', false);
        $response->assertSee('data-command="justifyFull"', false);
    }

    public function test_create_page_uses_visual_editor_with_alignment_tools(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.articles.create'));

        $response->assertOk();
        $response->assertSee('contenteditable="true"', false);
        $response->assertSee('data-command="justifyLeft"', false);
        $response->assertSee('data-command="justifyRight"', false);
        $response->assertSee('data-command="justifyFull"', false);
        $response->assertSee("block.style.textAlign = alignment", false);
    }
}
