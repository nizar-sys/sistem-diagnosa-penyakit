<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class CreateRuleSeeder extends Seeder
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
                'kode_penyakit' => 'P001',
                'G001' => true,
                'G002' => true,
                'G003' => true,
                'G004' => true,
                'G005' => true,
                'G006' => true,
                'G007' => true,
                'G008' => true,
                'G009' => true
            ]
            
        ];

        foreach($data as $row) {
            Rule::create($row);
        }
    }
}
