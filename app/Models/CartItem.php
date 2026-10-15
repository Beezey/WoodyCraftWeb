<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cart_id',
        'computer_id',
        'quantity',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function computer(): BelongsTo
    {
        return $this->belongsTo(Computer::class);
    }

    /**
     * Total de la ligne : prix de l'ordinateur multiplié par la quantité.
     */
    public function total(): float
    {
        return round($this->computer->price * $this->quantity, 2);
    }
}
