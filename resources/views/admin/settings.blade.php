@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-blue-900 p-8 text-white">
            <h1 class="text-2xl font-bold">Pengaturan Website</h1>
            <p class="text-blue-200">Atur lokasi sekolah untuk ditampilkan di Google Maps.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-8 space-y-8">
            @csrf

            @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-medium">{{ session('success') }}</div>
            @endif

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Sekolah</label>
                <input type="text" name="site_address" value="{{ old('site_address', $address) }}"
                    class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900"
                    placeholder="Nama dan alamat sekolah">
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Garis Lintang (Latitude)</label>
                    <input type="text" name="site_latitude" value="{{ old('site_latitude', $latitude) }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900"
                        placeholder="contoh: -6.914744">
                    <p class="text-xs text-gray-400 mt-1">Koordinat latitude (-90 sampai 90)</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Garis Bujur (Longitude)</label>
                    <input type="text" name="site_longitude" value="{{ old('site_longitude', $longitude) }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white text-gray-900"
                        placeholder="contoh: 107.609810">
                    <p class="text-xs text-gray-400 mt-1">Koordinat longitude (-180 sampai 180)</p>
                </div>
            </div>

            <!-- Map Preview -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pratinjau Lokasi</label>
                <div id="map-preview" class="w-full h-64 rounded-2xl border border-gray-200 bg-gray-100"></div>
                <p class="text-xs text-gray-400 mt-1">Geser pin untuk menyesuaikan lokasi.</p>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                <i data-lucide="save"></i> Simpan Pengaturan
            </button>
        </form>
    </div>
</div>

<script>
    // Google Maps preview with draggable marker
    function initMap() {
        const latInput = document.querySelector('input[name="site_latitude"]');
        const lngInput = document.querySelector('input[name="site_longitude"]');
        const lat = parseFloat(latInput.value) || -6.914744;
        const lng = parseFloat(lngInput.value) || 107.609810;

        const map = new google.maps.Map(document.getElementById('map-preview'), {
            center: { lat, lng },
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        const marker = new google.maps.Marker({
            position: { lat, lng },
            map: map,
            draggable: true,
            title: 'Lokasi Sekolah',
        });

        marker.addListener('dragend', function () {
            const pos = marker.getPosition();
            latInput.value = pos.lat().toFixed(6);
            lngInput.value = pos.lng().toFixed(6);
        });

        // Update marker when input changes
        function updateMarker() {
            const newLat = parseFloat(latInput.value);
            const newLng = parseFloat(lngInput.value);
            if (!isNaN(newLat) && !isNaN(newLng)) {
                const pos = { lat: newLat, lng: newLng };
                marker.setPosition(pos);
                map.setCenter(pos);
            }
        }

        latInput.addEventListener('change', updateMarker);
        lngInput.addEventListener('change', updateMarker);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY', '') }}&callback=initMap" async defer></script>
@endsection
