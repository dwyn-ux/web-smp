<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('facilities')->insert([
            ['title' => 'Laboratorium Modern', 'description' => 'Fasilitas yang lengkap untuk praktik sains dan teknologi.', 'image' => 'assets/kegiatan-1.jpg', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Perpustakaan Nyaman', 'description' => 'Ruang belajar tenang dengan koleksi buku dan referensi lengkap.', 'image' => 'assets/kegiatan-2.jpg', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Lapangan & Ekstrakurikuler', 'description' => 'Area olahraga dan kegiatan kreatif untuk siswa aktif.', 'image' => 'assets/kegiatan-3.jpg', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('facilities');
    }
};
