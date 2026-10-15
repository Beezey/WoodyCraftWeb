<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Computer;

class CartController extends Controller
{
    /**
     * Ajoute un ordinateur au panier du visiteur.
     * S'il y est déjà, sa quantité augmente de 1.
     */
    public function add(Computer $computer)
    {
        $cart = Cart::currentOrCreate();

        $item = $cart->items()->firstOrNew(['computer_id' => $computer->id]);
        $item->quantity = $item->exists ? $item->quantity + 1 : 1;
        $item->save();

        return back()->with('message', 'Ordinateur ajouté au panier.');
    }
}
