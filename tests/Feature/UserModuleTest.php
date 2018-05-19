<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_loads_the_users_list_page(){
        factory(User::class)->create([
            'name' => 'Nombre 1'
        ]);

        factory(User::class)->create([
            'name' => 'Nombre 2'
        ]);

        $this->get('/usuarios')
        	 ->assertStatus(200)
        	 ->assertSee('Listado de usuarios')
        	 ->assertSee('Nombre 1')
        	 ->assertSee('Nombre 2');
    }

    /** @test */
    function it_shows_a_default_message_if_there_are_no_users(){
        $this->get('/usuarios')
        	 ->assertStatus(200)
        	 ->assertSee('Listado de usuarios')
        	 ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_displays_the_user_details(){
        $user = factory(User::class)->create([
            'name' => 'Enrique Aguilar'
        ]);

    	$this->get('/usuarios/'.$user->id)
        	 ->assertStatus(200)
        	 ->assertSee('Enrique Aguilar');	
    }

    /** @test */
    function it_loads_the_new_users_page(){
    	$this->get('/usuarios/nuevo')
        	 ->assertStatus(200)
        	 ->assertSee('Creando usuario nuevo');	
    }
}
