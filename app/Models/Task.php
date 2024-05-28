<?php

namespace App\Models;

use App\Enums\TaskPpriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'comment',
        'status',
        'priority',
        'deadline_at',
        'reminder_at'
    ];

    protected $casts = [
        'deadline_at' => 'datetime',
        'published_at' => 'datetime',
        'status' => TaskStatusEnum::class,
        'priority' => TaskPpriorityEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
