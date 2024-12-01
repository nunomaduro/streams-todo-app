<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class CreateTodo
{
    /**
     * Execute the action.
     *
     * @param  array{description: string}  $attributes
     */
    public function handle(User $user, array $attributes): Todo
    {
        $todo = DB::transaction(function () use ($user, $attributes) {
            return Todo::create([
                'user_id' => $user->id,
                'status' => TodoStatus::Pending,
                'description' => $attributes['description'],
            ]);
        });

        broadcast(new TodoCreated($todo))->toOthers();

        return $todo;
    }
}
