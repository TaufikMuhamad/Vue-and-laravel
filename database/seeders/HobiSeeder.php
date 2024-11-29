<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Hobi;

class HobiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hobi1 = Hobi::create(['name' => 'Membaca']);
        $hobi2 = Hobi::create(['name' => 'Olahraga']);
        $hobi3 = Hobi::create(['name' => 'Musik']);
        $hobi3 = Hobi::create(['name' => 'bermotor']);
        $hobi3 = Hobi::create(['name' => 'M']);

        $siswa1 = Siswa::create([
            'full_name' => 'Muhamad Progammer Taufik',
            'email' => 'muhamadkece12aaaaa@Gmail.com',
            'degree' => 'S2',
        ]);

        $siswa2 = Siswa::create([
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'degree' => 'Bachelor',
        ]);
        $siswa1->hobi()->attach([$hobi1->id, $hobi2->id]);
        $siswa2->hobi()->attach([$hobi2->id, $hobi3->id]);
    }
}

