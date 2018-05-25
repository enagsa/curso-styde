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

    	$this->get(route('users.show', compact('user')))
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
        $this->get(route('users.show', ['user' => 2]))
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

        $this->assertCredentials([
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com',
            'password' => '12345'
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

    /** @test */
    function the_email_is_required(){
        $this->from(route('users.create'))->post(route('users.store'), [
                'name' => 'Enrique Aguilar',
                'email' => '',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function the_email_must_be_valid(){
        $this->from(route('users.create'))->post(route('users.store'), [
                'name' => 'Enrique Aguilar',
                'email' => 'enriqueaguilar',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email' => 'El campo email no es válido']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function the_email_must_be_unique(){
        $user = factory(User::class)->create([
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);

        $this->from(route('users.create'))->post(route('users.store'), [
                'name' => 'Tipo de Incóginto',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email' => 'Email ya registrado']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Tipo de Incóginto'
        ]);
    }

    /** @test */
    function the_password_is_required(){
        $this->from(route('users.create'))->post(route('users.store'), [
                'name' => 'Enrique Aguilar',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => ''
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password' => 'El campo contraseña es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function the_password_is_too_short(){
        $this->from(route('users.create'))->post(route('users.store'), [
                'name' => 'Enrique Aguilar',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => '1234'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['password' => 'La contraseña es demasiado corta']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function it_loads_the_edit_user_page(){
        $user = factory(User::class)->create();

        $this->get(route('users.edit', $user))
             ->assertStatus(200)
             ->assertViewIs('users.edit')
             ->assertSee('Editar usuario')
             ->assertViewHas('user');  
    }

    /** @test */
    function it_updates_a_user(){        
        $user = factory(User::class)->create();

        $this->put(route('users.update', compact('user')), [
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com',
            'password' => '12345'
        ])->assertRedirect(route('users.show', compact('user')));

        $this->assertDatabaseHas('users', [
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user(){
        $user = factory(User::class)->create();

        $this->from(route('users.edit', compact('user')))
            ->put(route('users.update', compact('user')), [
                'name' => '',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.edit', compact('user')))
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);
    }

    /** @test */
    function the_email_is_required_when_updating_a_user(){
        $user = factory(User::class)->create();

        $this->from(route('users.edit', compact('user')))
            ->put(route('users.update', compact('user')), [
                'name' => 'Enrique Aguilar',
                'email' => '',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.edit', compact('user')))
            ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Enrique Aguilar'
        ]);
    }

    /** @test */
    function the_email_must_be_valid_when_updating_a_user(){
        $user = factory(User::class)->create();

        $this->from(route('users.edit', compact('user')))
            ->put(route('users.update', compact('user')), [
                'name' => 'Enrique Aguilar',
                'email' => 'enriqueaguilar',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.edit', compact('user')))
            ->assertSessionHasErrors(['email' => 'El campo email no es válido']);

        $this->assertDatabaseMissing('users', [
            'email' => 'enriqueaguilar'
        ]);
    }

    /** @test */
    function the_email_must_be_unique_when_updating_a_user(){
        $this->markTestIncomplete();
        return;

        $previous_user = factory(User::class)->create([
            'name' => 'Enrique Aguilar',
            'email' => 'enriqueaguilar@expacioweb.com'
        ]);

        $user = factory(User::class)->create();

        $this->from(route('users.edit', compact('user')))
            ->put(route('users.update', compact('user')), [
                'name' => 'Tipo de Incognito',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => '12345'
            ])
            ->assertRedirect(route('users.edit', compact('user')))
            ->assertSessionHasErrors(['email' => 'Email ya registrado']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Tipo de Incóginto'
        ]);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user(){
        $oldPassword = 'CLAVE_ANTERIOR';
        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from(route('users.edit', compact('user')))
            ->put(route('users.update', compact('user')), [
                'name' => 'Enrique',
                'email' => 'enriqueaguilar@expacioweb.com',
                'password' => ''
            ])
            ->assertRedirect(route('users.show', compact('user')));

        $this->assertCredentials([
            'name' => 'Enrique',
            'email' => 'enriqueaguilar@expacioweb.com',
            'password' => $oldPassword
        ]);
    }
}
