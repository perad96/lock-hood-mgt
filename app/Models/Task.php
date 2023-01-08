<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $guarded = [];


    public function reporter(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'reporter_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'assignee_id');
    }

    public function masterTask(): BelongsTo
    {
        return $this->belongsTo(ListedTask::class,'master_task_id');
    }

    public function taskMaterials(): HasMany
    {
        return $this->hasMany(TaskMaterial::class,'task_id');
    }




}
