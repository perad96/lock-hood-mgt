<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListedTaskMaterial extends Model
{
    use HasFactory;

    protected $table = 'listed_task_materials';
    protected $guarded = [];

}
