<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::insert('INSERT INTO professions (title) VALUES (:title)', ['title' => 'Back-end developer']);

    	/*DB::table('professions')->insert([
        	'title' => 'Back-end developer'
        ]);

        DB::table('professions')->insert([
            'title' => 'Front-end developer'
        ]);

        DB::table('professions')->insert([
            'title' => 'Web designer'
        ]);*/

        Profession::create([
            'title' => 'Back-end developer'
        ]);

        Profession::create([
            'title' => 'Front-end developer'
        ]);

        Profession::create([
            'title' => 'Web designer'
        ]);

        factory(Profession::class, 17)->create();
    }
}
