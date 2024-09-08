<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property mixed $name
 * @property mixed|string $identity_img_path
 */
class Customer extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = [
        'name',
        'identity',
        'identity_image_path',
        'phone',
        'address',
        'location_image_path',
        'last_payment',
        'due_date',
        'status',
        'paid',
        'in_arrears',
        'acc',
    ];

    protected $casts = [
        'given_id' => 'integer',
        'name' => 'string',
        'identity' => 'string',
        'identity_image_path' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'location_image_path' => 'string',
        'last_payment' => 'datetime',
        'due_date' => 'string',
        'status' => 'integer',
        'paid' => 'boolean',
        'in_arrears' => 'boolean',
        'acc' => 'boolean',
    ];

    public function user() : MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function problem() : HasMany
    {
        return $this->hasMany(Problem::class, 'installation_id');
    }

    public function invoice() : HasMany
    {
        return $this->hasMany(Invoice::class, 'installation_id');
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    public function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with(['product', 'user']);
    }
}
