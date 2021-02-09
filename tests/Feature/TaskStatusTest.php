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

    public function testIndexActionAsUser()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSee($this->taskStatus->name);
    }

    public function testIndexActionAsGuest()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
    }

    public function testCreateActionAsUser()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));
        $response->assertStatus(200);
        $response->assertViewIs('task_statuses.create');
    }

    public function testCreateActionAsGuest()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(403);
    }

    public function testStoreActionAsUser()
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

    public function testStoreActionAsGuest()
    {
        $response = $this->post(route('task_statuses.store'), [
            'name' => 'In Progress',
        ]);
        $response->assertStatus(403);
    }

    public function testEditActionAsUser()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.edit', $this->taskStatus));
        $response->assertStatus(200);
        $response->assertViewIs('task_statuses.edit');
    }

    public function testEditActionAsGuest()
    {
        $response = $this->get(route('task_statuses.edit', $this->taskStatus));
        $response->assertStatus(403);
    }

    public function testUpdateActionAsUser()
    {
        $data     = [
            'name' => 'Updated status',
        ];
        $response = $this->actingAs($this->user)
            ->put(route('task_statuses.update', $this->taskStatus), $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdateActionAsGuest()
    {
        $response = $this->put(route('task_statuses.update', $this->taskStatus), [
                'name' => 'Updated status',
            ]);
        $response->assertStatus(403);
    }

    public function testShowActionAsUser()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.show', $this->taskStatus));
        $response->assertSessionDoesntHaveErrors();
        $response->assertStatus(200);
        $response->assertSee($this->taskStatus->name);
    }

    public function testShowActionAsGuest()
    {
        $response = $this->get(route('task_statuses.show', $this->taskStatus));
        $response->assertStatus(200);
        $response->assertSee($this->taskStatus->name);
    }

    public function testDestroyActionAsUser()
    {
        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $this->taskStatus));
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->only(['name', 'id']));
    }

    public function testDestroyActionAsGuest()
    {
        $response = $this->delete(route('task_statuses.destroy', $this->taskStatus));
        $response->assertStatus(403);
        $this->assertDatabaseHas('task_statuses', $this->taskStatus->only(['name', 'id']));
    }
}
