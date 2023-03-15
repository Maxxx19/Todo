<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['id', 'title', 'term', 'status'];

    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtask::class, 'task_id', 'id');
    }
}
