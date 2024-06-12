<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'customer_id',
        'identity',
        'phone',
        'address',
        'internet_package_id',
    ];
}
