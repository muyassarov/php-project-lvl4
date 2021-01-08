<?php

namespace Tests\Feature;

use App\Models\{Label, User};
use Tests\TestCase;

class LabelTest extends TestCase
{
    private $user;
    private $label;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user  = User::factory()->make();
        $this->label = Label::factory()->make();
        $this->user->save();
        $this->label->save();
    }

    public function testIndexAction()
    {
        $response = $this->actingAs($this->user)->get(route('labels.index'));
        $response->assertSee($this->label->name);
        $response->assertStatus(200);
    }

    public function testCreateAction()
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertViewIs('labels.create');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data     = [
            'name' => 'test.label',
        ];
        $response = $this->actingAs($this->user)->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testEditAction()
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label->id));
        $response->assertViewIs('labels.edit');
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $data     = [
            'name' => 'updated',
        ];
        $response = $this->actingAs($this->user)->put(route('labels.update', $this->label->id), $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label->id));
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $response->assertDontSee($this->label->name);
    }
}
