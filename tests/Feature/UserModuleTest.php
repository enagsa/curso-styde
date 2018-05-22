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

        $this->get(route('users'))
        	 ->assertStatus(200)
        	 ->assertSee('Listado de usuarios')
        	 ->assertSee('Nombre 1')
        	 ->assertSee('Nombre 2');
    }

    /** @test */
    function it_shows_a_default_message_if_there_are_no_users(){
        $this->get(route('users'))
        	 ->assertStatus(200)
        	 ->assertSee('Listado de usuarios')
        	 ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_displays_the_user_details(){
        $user = factory(User::class)->create([
            'name' => 'Enrique Aguilar'
        ]);

    	$this->get(route('users.show', $user->id))
        	 ->assertStatus(200)
        	 ->assertSee('Enrique Aguilar');	
    }

    /** @test */
    function it_loads_the_new_users_page(){
    	$this->get(route('users.create'))
        	 ->assertStatus(200)
        	 ->assertSee('Crear usuario');	
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found(){
        $this->get(route('users.show', '999'))
             ->assertStatus(404)
             ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_creates_a_new_user(){
        $this->post(route('users.store'), [
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com',
            'password' => '12345'
        ])->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function the_name_is_required(){
        $this->from(route('users.create'))->post(route('users.store'), [
                'name' => '',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }
}
