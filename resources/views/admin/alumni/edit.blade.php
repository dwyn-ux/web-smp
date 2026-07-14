@extends('admin.layout')

@section('content')
<div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Alumni</h2>
            <p class="text-gray-500">Perbarui dan setujui data alumni untuk tampil di landing page.</p>
        </div>
        <a href="{{ route('admin.alumni.index') }}" class="text-blue-600 font-bold hover:text-blue-800">Kembali ke daftar</a>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 p-5 text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.alumni.update', $alumnus->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $alumnus->name) }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas Saat di SMP</label>
            <input type="text" name="class_level" value="{{ old('class_level', $alumnus->class_level) }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Kelulusan SMP</label>
            <select name="graduation_year" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none bg-white">
                <option value="">Pilih Tahun Kelulusan</option>
                @foreach($graduationYears as $year)
                    <option value="{{ $year->year }}" {{ (string) old('graduation_year', $alumnus->graduation_year) === (string) $year->year ? 'selected' : '' }}>{{ $year->year }}</option>
                @endforeach
                @if($alumnus->graduation_year && ! $graduationYears->contains('year', $alumnus->graduation_year))
                    <option value="{{ $alumnus->graduation_year }}" selected>{{ $alumnus->graduation_year }}</option>
                @endif
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
            <textarea name="address" rows="3" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">{{ old('address', $alumnus->address) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Sekolah Saat Ini (SMA/SMK/MA)</label>
            <input type="text" name="current_school" value="{{ old('current_school', $alumnus->current_school) }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Universitas Saat Ini <span class="text-gray-400 font-normal">(Opsional)</span></label>
            <input type="text" name="current_university" value="{{ old('current_university', $alumnus->current_university) }}" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan dan Kesan</label>
            <textarea name="message" rows="4" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">{{ old('message', $alumnus->message) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Saran</label>
            <textarea name="suggestion" rows="3" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">{{ old('suggestion', $alumnus->suggestion) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full rounded-3xl border border-gray-300 px-5 py-4 focus:border-blue-500 focus:ring-blue-100 outline-none">
                <option value="pending" {{ old('status', $alumnus->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status', $alumnus->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ old('status', $alumnus->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" id="show_on_homepage" name="show_on_homepage" value="1" class="rounded text-blue-600 focus:ring-blue-500" {{ old('show_on_homepage', $alumnus->show_on_homepage) ? 'checked' : '' }}>
            <label for="show_on_homepage" class="text-sm font-semibold text-gray-700">Tampilkan di landing page</label>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto Alumni</label>
            <input type="file" name="photo" accept="image/*" class="w-full rounded-3xl border border-gray-300 px-5 py-3 focus:border-blue-500 focus:ring-blue-100 outline-none">
            <p class="mt-2 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah foto. Format JPG/PNG maksimal 5 MB.</p>
        </div>

        <button type="submit" class="w-full bg-blue-900 text-white rounded-3xl px-6 py-4 font-bold hover:bg-blue-800 transition">Simpan Perubahan</button>
    </form>
</div>
@endsection
