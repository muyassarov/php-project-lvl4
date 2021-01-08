<?php

namespace Tests\Feature;

use App\Models\{TaskStatus, User};
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    private $user;
    private $taskStatus;

    const STATUS_NAME = 'Test status';

    protected function setUp(): void
    {
        parent::setUp();
        $this->user       = User::factory()->make();
        $this->taskStatus = new TaskStatus([
            'name' => self::STATUS_NAME,
        ]);
        $this->taskStatus->save();
    }

    public function testIndexAction()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.index'));
        $response->assertSee($this->taskStatus->name);
        $response->assertStatus(200);
    }

    public function testCreateAction()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));
        $response->assertViewIs('task_statuses.create');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data     = [
            'name' => 'In Progress',
        ];
        $response = $this->actingAs($this->user)
            ->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEditAction()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.edit', $this->taskStatus->id));
        $response->assertViewIs('task_statuses.edit');
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $data     = [
            'name' => 'Updated status',
        ];
        $response = $this->actingAs($this->user)
            ->put(route('task_statuses.update', $this->taskStatus->id), $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testShow()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.show', $this->taskStatus->id));
        $response->assertSessionDoesntHaveErrors();
        $response->assertSee($this->taskStatus->name);
    }

    public function testDestroy()
    {
        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $this->taskStatus->id));
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $response->assertDontSee($this->taskStatus->name);
    }
}
