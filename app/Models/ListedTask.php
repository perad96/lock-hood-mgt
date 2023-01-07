<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListedTask extends Model
{
    use HasFactory;

    protected $table = 'listed_tasks';
    protected $guarded = [];

    public function taskMaterials(): HasMany
    {
        return $this->hasMany(ListedTaskMaterial::class,'listed_task_id');
    }

}
