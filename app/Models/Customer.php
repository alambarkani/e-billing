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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function internetPackage()
    {
        return $this->belongsTo(InternetPackage::class, 'internet_package_id');
    }

    public function toSearchableArray()
    {
        return [
            'identity' => $this->identity,
            'phone' => $this->phone,
            'address' => $this->address,
            'internet_package_id' => $this->internet_package_id,
        ];
    }
}
