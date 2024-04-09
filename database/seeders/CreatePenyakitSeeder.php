<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class CreatePenyakitSeeder extends Seeder
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
                'nama' => 'Tuberkulosis',
                'kode' => 'P001',
                'penyebab' => 'Virus'
            ]

        ];

        Penyakit::insert($data);
    }
}
