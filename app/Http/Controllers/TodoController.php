<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTodo;
use App\Http\Requests\CreateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class TodoController
{
    /**
     * Display the list of todos.
     *
     * @return array<int, Todo>
     */
    public function index(Request $request): array
    {
        $user = $request->user();
        assert($user !== null);

        return $user->todos->values()->all();
    }

    /**
     * Store a new todo.
     */
    public function store(CreateTodoRequest $request, CreateTodo $action): RedirectResponse
    {
        /** @var array{description: string} $validated */
        $validated = $request->validated();

        $user = $request->user();
        assert($user !== null);

        $action->handle($user, $validated);

        return redirect()->back();
    }
}
