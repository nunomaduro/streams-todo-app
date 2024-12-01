<?php

declare(strict_types=1);

use App\Models\Todo;
use App\Models\User;

test('to array', function () {
    $user = Todo::factory()->create()->fresh();

    expect(array_keys($user->toArray()))
        ->toEqual([
            'id',
            'user_id',
            'status',
            'description',
            'created_at',
            'updated_at',
        ]);
});

it('belongs to a user', function () {
    $todo = Todo::factory()->create();

    expect($todo->user)->toBeInstanceOf(User::class);
});
