<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hobi;

class HobiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Hobi::create(['name' => 'Membaca']);
        \App\Models\Hobi::create(['name' => 'Olahraga']);
        \App\Models\Hobi::create(['name' => 'Musik']);
    }


}
