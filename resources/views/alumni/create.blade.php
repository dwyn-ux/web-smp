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
                        <select name="class_level" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none bg-white">
                            <option value="">Pilih Kelas</option>
                            <option value="9A" {{ old('class_level') == '9A' ? 'selected' : '' }}>9A</option>
                            <option value="9B" {{ old('class_level') == '9B' ? 'selected' : '' }}>9B</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Kelulusan SMP</label>
                        <select name="graduation_year" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none bg-white" {{ $graduationYears->isEmpty() ? 'disabled' : '' }}>
                            <option value="">{{ $graduationYears->isEmpty() ? 'Belum ada pilihan tahun kelulusan' : 'Pilih Tahun Kelulusan' }}</option>
                            @foreach($graduationYears as $year)
                                <option value="{{ $year->year }}" {{ (string) old('graduation_year') === (string) $year->year ? 'selected' : '' }}>{{ $year->year }}</option>
                            @endforeach
                        </select>
                        @if($graduationYears->isEmpty())
                            <p class="mt-2 text-sm text-red-500">Pilihan tahun kelulusan belum tersedia. Silakan hubungi admin sekolah.</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea name="address" rows="3" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Alamat lengkap Anda saat ini">{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sekolah Saat Ini (SMA/SMK/MA)</label>
                        <input type="text" name="current_school" value="{{ old('current_school') }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Nama sekolah saat ini">
                    </div>

                    <div class="hidden">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Universitas Saat Ini <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="current_university" value="{{ old('current_university') }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none" placeholder="Nama universitas jika sudah kuliah">
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
                        <p class="mt-2 text-sm text-gray-500">Unggah foto kualitas baik bersama almamater. Format JPG/PNG maksimal 5 MB.</p>
                    </div>

                    <button type="submit" class="w-full rounded-3xl px-6 py-4 font-bold transition {{ $graduationYears->isEmpty() ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-900 text-white hover:bg-blue-800' }}" {{ $graduationYears->isEmpty() ? 'disabled' : '' }}>Kirim Data Alumni</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
