<?php

declare(strict_types=1);

namespace App\Enums;

enum TodoStatus: string
{
    case Pending = 'pending';
    case Completed = 'completed';
}
