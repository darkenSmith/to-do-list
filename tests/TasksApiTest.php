<?php

namespace Tests;

use App\Models\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TasksApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_loads_the_tasks_index_page()
    {
        // Arrange: Create fake tasks
        $tasks = Tasks::factory()->count(3)->create();

        // Act: Visit the index route
        $response = $this->get(route('tasks.index'));

        // Assert: Page loads with expected content
        $response->assertStatus(200);
        $response->assertViewIs('tasks');
        $response->assertViewHas('tasks');

        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }
    }

    /**
     * @test
     */
    public function test_create_a_task(): void
    {
        $this->postJson('/api/tasks', [
            'name' => 'This the latest Task',
        ]);

        $this->assertDatabaseCount('tasks', 1);

        // Optional: assert content
        $this->assertDatabaseHas('tasks', [
            'name' => 'This the latest Task',
            'completed' => false,
        ]);
    }

    /**
     * @test
     */
    public function complete_a_task(): void
    {
        $task = Tasks::factory()->create();

        $this->patchJson("/api/tasks/{$task}");

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true,
        ]);
    }

}
