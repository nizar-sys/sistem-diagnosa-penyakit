<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class CreateGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Batuk lebih dari 2 minggu',
                'kode' => 'G001'
            ],
            [
                'nama' => 'Batuk darah',
                'kode' => 'G002'
            ],
            [
                'nama' => 'Penurunan Berat badan',
                'kode' => 'G003'
            ],
            [
                'nama' => 'Turun Nafsu Makan',
                'kode' => 'G004'
            ],
            [
                'nama' => 'Demam Pada Malam Hari',
                'kode' => 'G005'
            ],
            [
                'nama' => 'Malaise',
                'kode' => 'G006'
            ],
            [
                'nama' => 'Sesak Nafas',
                'kode' => 'G007'
            ],
            [
                'nama' => 'Nyeri dada',
                'kode' => 'G008'
            ],
            [
                'nama' => 'Mengeluarkan keringat dingin di malam hari',
                'kode' => 'G009'
            ]
        ];

        Gejala::insert($data);
    }
}
