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
 'indah',
 'cantik',
 'menawan',
 'elok',
 'molek',
 'jelek',
 'buruk',
 'kusam',
 'kasar',
 'mengindahkan',
 'keindahan',
 'diindahkan',
 'terindah',

'cepat',
 'kilat',
 'tangkas',
 'lincah',
 'lekas',
 'lambat',
 'lelah',
 'lemah',
 'lesu',
 'mempercepat',
 'kecepatan',
 'dipercepat',
 'tercapai',

'besar',
 'luas',
 'agung',
 'raksasa',
 'gigantik',
 'kecil',
 'sempit',
 'mini',
 'mikro',
 'memperbesar',
 'kebesaran',
 'dibesarkan',
 'terbesar',

'sukses',
 'berhasil',
 'berjaya',
 'maju',
 'menang',
 'gagal',
 'kandas',
 'jatuh',
 'runtuh',
 'menyukseskan',
 'kesuksesan',
 'disukseskan',
 'tersukses',

'bahagia',
 'senang',
 'gembira',
 'sejahtera',
 'ceria',
 'sedih',
 'susah',
 'sengsara',
 'muram',
 'membanggakan',
 'kebahagiaan',
 'dibahagiakan',
 'terbahagia',

'pintar',
 'cerdas',
 'pandai',
 'cerdik',
 'bijak',
 'bodoh',
 'dungu',
 'tolol',
 'lemot',
 'memintarkan',
 'kepintaran',
 'dipintarkan',
 'terpintar',

'kuat',
 'tangguh',
 'gagah',
 'perkasa',
 'lemah',
 'rapuh',
 'loyo',
 'ringkih',
 'menguatkan',
 'kekuatan',
 'dikuatkan',
 'terkuat',
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
