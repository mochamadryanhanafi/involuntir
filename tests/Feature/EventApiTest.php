<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create(), ['*']);
    }

    public function test_authenticated_user_can_get_a_list_of_events()
    {
        Event::factory(5)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    public function test_authenticated_user_can_create_an_event_with_valid_data()
    {
        $eventData = [
            'title' => 'My Awesome Event',
            'description' => 'This is a description of my awesome event.',
            'event_date' => '2026-03-15',
        ];

        $response = $this->postJson('/api/events', $eventData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('events', ['title' => 'My Awesome Event']);
    }

    public function test_authenticated_user_can_get_an_event_by_its_id()
    {
        $event = Event::factory()->create();

        $response = $this->getJson('/api/events/' . $event->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => $event->title]);
    }

    public function test_authenticated_user_can_update_their_own_event()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $event = Event::factory()->create(['user_id' => $user->id]);

        $updateData = ['title' => 'My Updated Event Title'];

        $response = $this->putJson('/api/events/' . $event->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('events', ['title' => 'My Updated Event Title']);
    }

    public function test_authenticated_user_cannot_update_an_event_owned_by_another_user()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Sanctum::actingAs($user1);
        $event = Event::factory()->create(['user_id' => $user2->id]);

        $updateData = ['title' => 'My Updated Event Title'];

        $response = $this->putJson('/api/events/' . $event->id, $updateData);

        $response->assertStatus(403);
    }

    public function test_authenticated_user_can_delete_their_own_event()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $event = Event::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson('/api/events/' . $event->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    public function test_authenticated_user_cannot_delete_an_event_owned_by_another_user()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Sanctum::actingAs($user1);
        $event = Event::factory()->create(['user_id' => $user2->id]);

        $response = $this->deleteJson('/api/events/' . $event->id);

        $response->assertStatus(403);
    }

    public function test_authenticated_user_can_join_an_event()
    {
        $event = Event::factory()->create();

        $response = $this->postJson('/api/events/' . $event->id . '/join');

        $response->assertStatus(200);
        $this->assertDatabaseHas('event_user', [
            'event_id' => $event->id,
            'user_id' => auth()->id(),
        ]);
    }
}
