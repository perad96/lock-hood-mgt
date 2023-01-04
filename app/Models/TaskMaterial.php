<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskMaterial extends Model
{
    use HasFactory;

    protected $table = 'task_materials';
    protected $guarded = [];


    public function rawMaterial(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class,'material_id');
    }
}
