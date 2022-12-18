<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawMaterial extends Model
{
    use HasFactory;

    protected $table = 'raw_materials';
    protected $guarded = [];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(MaterialBrand::class,'brand_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MaterialCategory::class,'category_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }

}
