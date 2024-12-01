<?php

declare(strict_types=1);

use App\Models\Todo;
use App\Models\User;

it('lists the user todos', function () {
    $user = User::factory()->create();

    $todos = Todo::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('todos.index'));

    $response->assertStatus(200);

    $response->assertJson($todos->toArray());
});
