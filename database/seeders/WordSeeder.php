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
