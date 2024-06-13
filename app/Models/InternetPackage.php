<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function customer()
    {
        return $this->hasMany(Customer::class, 'internet_package_id');
    }
}
