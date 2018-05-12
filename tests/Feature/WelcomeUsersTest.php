<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_welcomes_users_with_nickname()
    {
        $this->get('/saludo/enrique/gaurhoth')
        	 ->assertStatus(200)
        	 ->assertSee('Bienvenido Enrique, tu apodo es gaurhoth');
    }

    /** @test */
    function it_welcomes_users_without_nickname()
    {
        $this->get('/saludo/enrique')
        	 ->assertStatus(200)
        	 ->assertSee('Bienvenido Enrique');
    }
}
