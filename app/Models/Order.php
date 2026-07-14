<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['user_id', 'invoice', 'total', 'status', 'shipping_address', 'city', 'postal_code', 'phone', 'notes'];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->invoice = 'INV/' . date('Ymd') . '/' . str_pad((static::max('id') ?? 0) + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
