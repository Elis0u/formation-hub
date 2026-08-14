<?php

use App\Models\FormationSession;
use App\Models\Registration;
use App\Models\User;

test('admin can register a contact to a session with available capacity', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $session = FormationSession::factory()->create(['max_capacity' => 5]);

    $response = $this->actingAs($user)->post('/registrations', [
        'session_id' => $session->id,
        'external_contact_id' => 2,
        'external_contact_name' => 'Another Contact',
    ]);

    $response->assertRedirect(route('contacts.index'));

    $this->assertDatabaseHas('registrations', [
        'session_id' => $session->id,
        'external_contact_id' => 2,
        'status' => 'registered',
    ]);
});

test('cannot register a contact when the session is full', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $session = FormationSession::factory()->create(['max_capacity' => 1]);

    Registration::create(['session_id' => $session->id, 'external_contact_id' => 1, 'external_contact_name' => 'Test Contact', 'status' => 'registered']);

    $response = $this->actingAs($user)->post('/registrations', [
        'session_id' => $session->id,
        'external_contact_id' => 2,
        'external_contact_name' => 'Another Contact',
    ]);

    $response->assertSessionHasErrors();

    $this->assertDatabaseCount('registrations', 1);
});

test('cannot register a contact when is already register', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $session = FormationSession::factory()->create(['max_capacity' => 5]);

    Registration::create(['session_id' => $session->id, 'external_contact_id' => 1, 'external_contact_name' => 'Test Contact', 'status' => 'registered']);

    $response = $this->actingAs($user)->post('/registrations', [
        'session_id' => $session->id,
        'external_contact_id' => 1,
        'external_contact_name' => 'Test Contact',
    ]);

    $response->assertSessionHasErrors();

    $this->assertDatabaseCount('registrations', 1);
});

test('trainers cannot create a registration', function () {
    $trainer = User::factory()->create(['role' => 'trainer']);
    $session = FormationSession::factory()->create(['max_capacity' => 5]);

    $response = $this->actingAs($trainer)->post('/registrations', [
        'session_id' => $session->id,
        'external_contact_id' => 1,
        'external_contact_name' => 'Another Contact',
    ]);

    $response->assertForbidden();

    $this->assertDatabaseCount('registrations', 0);
});
