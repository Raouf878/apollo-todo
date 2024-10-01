<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\todos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use RefreshDatabase;

    
    public function a_user_can_create_a_todo()
    {
        
        $user = User::factory()->create();

        
        $this->actingAs($user);

        
        $response = $this->post(route('todo.store'), [
            'name' => 'Test Todo',
            'work' => 'Work on project',
            'duedate' => '2024-12-31',
        ]);

        
        $this->assertDatabaseHas('todos', [
            'name' => 'Test Todo',
            'work' => 'Work on project',
            'duedate' => '2024-12-31',
            'user_id' => $user->id,
        ]);

        
        $response->assertRedirect(route('todo.home'));
    }

   
    public function a_user_can_only_view_their_own_todos()
    {
        
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        
        $todo1 = todos::factory()->create(['user_id' => $user1->id, 'name' => 'User1 Todo']);
        $todo2 = todos::factory()->create(['user_id' => $user2->id, 'name' => 'User2 Todo']);

        
        $this->actingAs($user1);

        
        $response = $this->get(route('todo.home'));

        
        $response->assertSee($todo1->name);
        $response->assertDontSee($todo2->name);
    }

    
    public function a_user_can_update_their_todo()
    {
        
        $user = User::factory()->create();
        $todo = todos::factory()->create(['user_id' => $user->id, 'name' => 'Old Todo']);

        
        $this->actingAs($user);

        
        $response = $this->post(route('todo.updateData'), [
            'id' => $todo->id,
            'name' => 'Updated Todo',
            'work' => 'Updated work',
            'duedate' => '2024-12-31',
        ]);

        
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'name' => 'Updated Todo',
            'work' => 'Updated work',
            'duedate' => '2024-12-31',
        ]);

        
        $response->assertRedirect(route('todo.home'));
    }

    
    public function a_user_can_delete_their_todo()
    {
        
        $user = User::factory()->create();
        $todo = todos::factory()->create(['user_id' => $user->id]);

        
        $this->actingAs($user);

        
        $response = $this->get(route('todo.delete', $todo->id));

        
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);

        
        $response->assertRedirect(route('todo.home'));
    }
}
