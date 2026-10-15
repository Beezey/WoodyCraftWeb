<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Computer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Page du panier : lignes avec leur total, et total du panier.
     */
    public function index()
    {
        $cart = Cart::current();
        $cart?->load('items.computer');

        $items = $cart ? $cart->items : collect();
        $total = $cart ? $cart->total() : 0;

        return view('cart.index', compact('items', 'total'));
    }

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

    /**
     * Modifie la quantité d'une ligne du panier.
     */
    public function update(Request $request, CartItem $item)
    {
        $this->checkOwner($item);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update($validated);

        return redirect()->route('cart.index')
            ->with('message', 'Quantité mise à jour.');
    }

    /**
     * Refuse l'accès à une ligne qui n'est pas dans le panier du visiteur.
     */
    private function checkOwner(CartItem $item): void
    {
        abort_if($item->cart_id !== Cart::current()?->id, 403);
    }
}
