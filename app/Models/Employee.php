<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function jobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class,'job_role_id');
    }
}
