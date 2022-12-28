<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'customer_order_details';
    protected $guarded = [];

}
