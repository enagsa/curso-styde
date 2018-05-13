<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    /** @test */
    function it_loads_the_users_list_page()
    {
        $this->get('/usuarios')
        	 ->assertStatus(200)
        	 ->assertSee('Listado de usuarios')
        	 ->assertSee('Nombre 1')
        	 ->assertSee('Nombre 2');
    }

    /** @test */
    function it_shows_a_default_message_if_there_are_no_users()
    {
        $this->get('/usuarios?empty')
        	 ->assertStatus(200)
        	 ->assertSee('Listado de usuarios')
        	 ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_loads_the_user_details_page(){
    	$this->get('/usuarios/5')
        	 ->assertStatus(200)
        	 ->assertSee('Monstrando detalle del usuario: 5');	
    }

    /** @test */
    function it_loads_the_new_users_page(){
    	$this->get('/usuarios/nuevo')
        	 ->assertStatus(200)
        	 ->assertSee('Creando usuario nuevo');	
    }
}
