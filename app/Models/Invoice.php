<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'product_list',
        'gateway_ref',
        'merchant_ref',
        'month',
        'status',
    ];

    protected $casts = [
        'product_list' => 'json',
        'gateway_ref' => 'string',
        'merchant_ref' => 'string',
        'month' => 'date',
        'status' => 'string',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_invoice_pivot')->withPivot('paid', 'created_at');
    }
}
