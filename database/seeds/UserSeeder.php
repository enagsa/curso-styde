<?php

use App\Models\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profession_id = Profession::whereTitle('Back-end developer')->value('id');

        User::create([
        	'name' => 'Enrique Aguilar',
        	'email' => 'enriqueaguilar@expacioweb.com',
        	'password' => bcrypt('1234aA@'),
            'profession_id' => $profession_id,
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Jesús Guerrero',
            'email' => 'jesusguerrero@expacioweb.com',
            'password' => bcrypt('1234aA@'),
            'profession_id' => $profession_id
        ]);

        User::create([
            'name' => 'Manu Páez',
            'email' => 'mauelpaez@expacioweb.com',
            'password' => bcrypt('1234aA@'),
            'profession_id' => null
        ]);

        /*DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('professions')->whereTitle('Web designer')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');*/
    }
}
