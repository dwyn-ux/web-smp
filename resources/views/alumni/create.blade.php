@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gray-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="bg-blue-900 text-white p-10 text-center">
                <h1 class="text-3xl font-black mb-2">Pendataan Alumni</h1>
                <p class="text-blue-100 max-w-2xl mx-auto">Isi data berikut agar kami dapat tetap menjalin silaturahmi dan mengenang perjalananmu di SMP Muhammadiyah Unggulan Ashidiq.</p>
            </div>
            <div class="p-10">
                @if(session('success'))
                    <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-5 text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Nama lengkap Anda">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas Saat di SMP</label>
                        <input type="text" name="class_level" value="{{ old('class_level') }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Misal: 9A atau 8B">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea name="address" rows="3" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Alamat lengkap Anda saat ini">{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sekarang Sekolah di Mana</label>
                        <input type="text" name="current_school" value="{{ old('current_school') }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Nama sekolah atau perguruan tinggi saat ini">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan dan Kesan</label>
                        <textarea name="message" rows="4" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Tulis pesan dan kesan Anda selama di SMP Ashidiq">{{ old('message') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Saran</label>
                        <textarea name="suggestion" rows="3" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Apa saran Anda untuk sekolah atau alumninya">{{ old('suggestion') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto Terbaik dengan Almamater</label>
                        <input type="file" name="photo" accept="image/*" class="w-full rounded-3xl border border-gray-300 px-5 py-3 focus:border-blue-500 focus:ring-blue-100 outline-none">
                    </div>

                    <button type="submit" class="w-full bg-blue-900 text-white rounded-3xl px-6 py-4 font-bold hover:bg-blue-800 transition">Kirim Data Alumni</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
