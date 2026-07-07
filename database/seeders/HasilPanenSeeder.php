<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilPanenSeeder extends Seeder
{
    public function run()
    {
        // Pastikan untuk menambahkan: use Illuminate\Support\Facades\DB; di bagian atas file

        DB::table('hasil_panens')->insert([
            [
                'nama_komoditas' => 'Padi',
                'jumlah_kg' => 500,
                'tanggal_panen' => '2026-05-10',
            ],
            [
                'nama_komoditas' => 'Jagung',
                'jumlah_kg' => 300,
                'tanggal_panen' => '2026-05-12',
            ],
        ]);
    }
}