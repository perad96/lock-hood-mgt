<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $guarded = [];

    public function jobRoles(): HasMany
    {
        return $this->hasMany(JobRole::class,'section_id');
    }

}
