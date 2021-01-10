<?php

namespace Tests\Feature;

use App\Models\{Task, TaskStatus, User};
use Tests\TestCase;

class TaskTest extends TestCase
{
    private $user;
    private $task;
    private $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
        $this->user->save();

        $this->task       = Task::factory()->createdBy($this->user)->make();
        $this->taskStatus = TaskStatus::factory()->newest()->make();
        $this->task->save();
        $this->taskStatus->save();
    }

    public function testIndexActionAsUser()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.index'));
        $response->assertSee($this->task->name);
        $response->assertStatus(200);
    }

    public function testIndexActionAsGuest()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertSee($this->task->name);
    }

    public function testCreateActionAsUser()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(403);
    }

    public function testCreateActionAsGuest()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertViewIs('tasks.create');
    }

    public function testStoreActionAsUser()
    {
        $data     = [
            'name'          => 'Test task name',
            'description'   => 'Description',
            'status_id'     => $this->taskStatus->id,
            'created_by_id' => $this->user->id,
        ];
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testStoreActionAsGuest()
    {
        $response = $this->post(route('tasks.store'), [
            'name' => 'Task name'
        ]);
        $response->assertStatus(403);
    }

    public function testShowActionAsUser()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.show', $this->task));
        $response->assertStatus(200);
        $response->assertSee($this->task->name);
    }

    public function testShowActionAsGuest()
    {
        $response = $this->get(route('tasks.show', $this->task));
        $response->assertStatus(200);
        $response->assertSee($this->task->name);
    }

    public function testEditActionAsUser()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');
    }

    public function testEditActionAsGuest()
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertStatus(403);
    }

    public function testUpdateActionAsUser()
    {
        $newUser       = User::factory()->make();
        $newTaskStatus = TaskStatus::factory()->make();
        $newTaskStatus->save();
        $newUser->save();

        $data     = [
            'name'           => 'Updated task name',
            'description'    => 'Updated description',
            'status_id'      => $newTaskStatus->id,
            'assigned_to_id' => $newUser->id,
        ];
        $response = $this->actingAs($this->user)->put(route('tasks.update', $this->task), $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdateActionAsGuest()
    {
        $response = $this->put(route('tasks.update', $this->task), [
            'name' => 'Updated name'
        ]);
        $response->assertStatus(403);
    }

    public function testDestroyActionAsCreator()
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task));
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $response->assertDontSee($this->task->name);
    }

    public function testDestroyActionAsUser()
    {
        $anyUser = User::factory()->make();
        $anyUser->save();

        $response = $this->actingAs($anyUser)->delete(route('tasks.destroy', $this->task));
        $response->assertStatus(403);
    }

    public function testDestroyActionAsGuest()
    {
        $response = $this->delete(route('tasks.destroy', $this->task));
        $response->assertStatus(403);
    }
}
