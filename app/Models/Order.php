<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dateFormat = 'Y-m-d';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
