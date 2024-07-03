<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'address',
        'location_name',
        'status',
        'acc',
        'due_date',
        'paid',
        'last_payment',
        'internet_package_id',
    ];

    protected $dates = ['due_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function problem()
    {
        return $this->hasOne(Problem::class, 'customer_id');
    }

    public function internetPackage()
    {
        return $this->belongsTo(InternetPackage::class, 'internet_package_id');
    }

    public function toSearchableArray()
    {
        return [
            'users.name' => '',
            'users.account' => '',
            'address' => '',
            'customer_id' => '',
            'identity' => '',
            'phone' => '',
            'due_date' => '',
            'paid' => '',
            'last_payment' => '',
            'location_name' => '',
            'internet_packages.name' => '',
            'status' => '',
        ];
    }
}
