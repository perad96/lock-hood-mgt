<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListedTask extends Model
{
    use HasFactory;

    protected $table = 'listed_tasks';
    protected $guarded = [];

}
