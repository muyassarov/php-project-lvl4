<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Tests\TestCase;

class TaskTest extends TestCase
{
    private $user;
    private $task;
    private $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user       = User::factory()->make();
        $this->task       = Task::factory()->make();
        $this->taskStatus = TaskStatus::factory()->newest()->make();
        $this->task->save();
        $this->taskStatus->save();
        $this->user->save();
    }

    public function testIndexAction()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.index'));
        $response->assertSee($this->task->name);
        $response->assertStatus(200);
    }

    public function testCreateAction()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertViewIs('tasks.create');
        $response->assertStatus(200);
    }

    public function testStore()
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

    public function testEditAction()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task->id));
        $response->assertViewIs('tasks.edit');
        $response->assertStatus(200);
    }

    public function testUpdate()
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
        $response = $this->actingAs($this->user)->put(route('tasks.update', $this->task->id), $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy()
    {
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task->id));
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $response->assertDontSee($this->task->name);
    }
}
