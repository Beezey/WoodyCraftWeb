<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Panier du visiteur courant : par user_id s'il est connecté, par session_id sinon.
     */
    public static function current(): ?self
    {
        return Auth::check()
            ? self::where('user_id', Auth::id())->first()
            : self::where('session_id', session()->getId())->first();
    }

    /**
     * Retrouve le panier du visiteur courant, ou le crée s'il n'en a pas encore.
     */
    public static function currentOrCreate(): self
    {
        return Auth::check()
            ? self::firstOrCreate(['user_id' => Auth::id()])
            : self::firstOrCreate(['session_id' => session()->getId()]);
    }
}
