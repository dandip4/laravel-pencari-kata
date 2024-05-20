<?php

namespace Database\Seeders;

use App\Models\Kata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            'pintar',
            'cerdas',
            'pintu',
            'buku',
            'meja',
            'puteri',
            // Tambahkan kata lainnya sesuai kebutuhan
            'kursi',
            'mobil',
            'jendela',
            'lampu',
            'komputer',
            'pohon',
            'taman',
            'kucing',
            'anjing',
            'burung',
            'laptop',
            'rumah',
            'motor',
            'sepeda',
            'atas',
            'bawah',
            'kanan',
            'kiri',
            'depan',
            'belakang',
            'besar',
            'kecil',
            'panjang',
            'pendek',
            'ramai',
            'sepi',
            'dingin',
            'panas',
            'santai',
            'serius',
            'senang',
            'sedih',
            'gelap',
            'terang',
            'tidur',
            'makan',
            'minum',
            'berjalan',
            'berlari',
            'berenang',
            'terbang',
        ];

        // Seed each word with kelas_kata_id 1
        foreach ($words as $word) {
            Kata::create([
                'kata' => $word,
                'kelas_kata_id' => 1,
            ]);
        }
    }
}
