<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListedTaskMaterial extends Model
{
    use HasFactory;

    protected $table = 'listed_task_materials';
    protected $guarded = [];

    public function rawMaterial(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class,'material_id');
    }
}
