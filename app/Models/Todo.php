<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TodoStatus;
use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Todo extends Model
{
    /** @use HasFactory<TodoFactory> */
    use HasFactory;

    public function casts(): array
    {
        return [
            'status' => TodoStatus::class,
        ];
    }

    /**
     * The user that owns the todo.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
