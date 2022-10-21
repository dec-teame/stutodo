<?php

namespace Tests\Feature\Function;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinisedTodoTest extends TestCase
{
    public function test_finishedList_screen_can_be_rendered()
    {
        $response = $this->get('/todo/finishedList');

        $response->assertStatus(200);
    }

    public function test_finishedTodo_can_be_edited()
    {
     
    }

    public function test_finishedTodo_can_be_deleted()
    {
        
    }
}