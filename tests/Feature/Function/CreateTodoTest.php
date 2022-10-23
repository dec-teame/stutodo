<?php

namespace Tests\Feature\Function;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTodoTest extends TestCase
{
    public function test_CreateTodo_screen_can_be_rendered()
    {
        $response = $this->get('/todo/create');

        $response->assertStatus(302);
    }

    public function test_inputValue_can_be_confirmed()
    {
     
    }

    public function test_inputValue_is_not_confirmed_with_invalid_letter()
    {
        
    }
}