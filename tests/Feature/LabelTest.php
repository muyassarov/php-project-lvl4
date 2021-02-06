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

    public function testIndexActionAsUser()
    {
        $response = $this->actingAs($this->user)->get(route('labels.index'));
        $response->assertStatus(200);
        $response->assertSee($this->label->name);
    }

    public function testIndexActionAsGuest()
    {
        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);
        $response->assertSee($this->label->name);
    }

    public function testCreateActionAsUser()
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertStatus(200);
        $response->assertViewIs('labels.create');
    }

    public function testCreateActionAsGuest()
    {
        $response = $this->get(route('labels.create'));
        $response->assertStatus(403);
    }

    public function testStoreAsUser()
    {
        $data     = [
            'name' => 'test.label',
        ];
        $response = $this->actingAs($this->user)->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testStoreAsGuest()
    {
        $response = $this->post(route('labels.store'), [
            'name' => 'private',
        ]);
        $response->assertStatus(403);
    }

    public function testEditActionAsUser()
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));
        $response->assertStatus(200);
        $response->assertViewIs('labels.edit');
    }

    public function testEditActionAsGuest()
    {
        $response = $this->get(route('labels.edit', $this->label));
        $response->assertStatus(403);
    }

    public function testUpdateAsUser()
    {
        $data     = [
            'name' => 'updated',
        ];
        $response = $this->actingAs($this->user)->put(route('labels.update', $this->label), $data);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdateAsGuest()
    {
        $response = $this->put(route('labels.update', $this->label), [
            'name' => 'updated',
        ]);
        $response->assertStatus(403);
    }

    public function testDestroyAsUser()
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label));
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', $this->label->only(['name', 'id']));
    }

    public function testDestroyAsGuest()
    {
        $response = $this->delete(route('labels.destroy', $this->label));
        $response->assertStatus(403);
        $this->assertDatabaseHas('labels', $this->label->only(['name', 'id']));
    }
}
