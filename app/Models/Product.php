<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'decimal:2',
    ];

    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class, 'product_id');
    }

    public function invoice(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'product_invoice_pivot')->withPivot('paid', 'created_at');
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }
}
