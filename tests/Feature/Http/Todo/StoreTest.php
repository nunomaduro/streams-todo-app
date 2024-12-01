<?php

declare(strict_types=1);

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;

it('may create a todo', function () {
    // Prepare...
    $user = User::factory()->create();

    // Act...
    $response = $this->actingAs($user)
        ->from(route('todos.index'))
        ->post(route('todos.store'), [
            'description' => 'My first todo',
        ]);

    // Assert...
    $response->assertRedirectToRoute('todos.index')
        ->assertSessionHasNoErrors();

    $todos = Todo::all();

    expect($todos)->toHaveCount(1)
        ->and($todos->first()->user_id)->toBe($user->id)
        ->and($todos->first()->description)->toBe('My first todo');
});

it('todos are pending by default', function () {
    // Prepare...
    $user = User::factory()->create();

    // Act...
    $response = $this->actingAs($user)
        ->from(route('todos.index'))
        ->post(route('todos.store'), [
            'description' => 'My first todo',
        ]);

    // Assert...
    $response->assertRedirectToRoute('todos.index')
        ->assertSessionHasNoErrors();

    expect(Todo::first()->status)->toBe(TodoStatus::Pending);
});
