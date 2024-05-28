<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case Completed = 'completed';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Progressing = 'progressing';
}

