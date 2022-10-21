<?php

namespace Tests\Feature\Function;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class indexVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_screen_can_be_rendered()
    {
        $response = $this->get('/todo');

        $response->assertStatus(200);
    }

    public function test_todo_can_be_edited()
    {
     
    }

    public function test_todo_can_be_deleted()
    {
        
    }
}
