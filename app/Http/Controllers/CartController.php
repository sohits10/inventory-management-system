<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CartItem;
use App\Models\Cart;



class CartController extends Controller
{
    

    public function addToCart(Request $request)
    {

        try {
            $validated = $request->validate([
                'item_id' => 'required|exists:items,id',
                'size' => 'nullable|string',
                'crust' => 'nullable|string',
                'quantity' => 'required|integer|min:1',
            ]);
    
            // Authenticated or session-based cart logic
            // $cart = auth()->user()->cart ?? null;
    
            // if (!$cart) {
            //     $cart = Cart::create();  
            //     session(['cart_id' => $cart->id]);
            // }


            $user = Auth::user();
            
            $cart = null;
    
            if ($user) {
                // Logged-in user: get or create their cart
                $cart = Cart::firstOrCreate(
                    ['user_id' => $user->id, 'status' => 'active'], // Adjust status condition as needed
                    ['session_id' => null]
                );
            } else {
                // Guest user: use session_id
                $sessionId = session()->getId();
                $cart = Cart::firstOrCreate(
                    ['session_id' => $sessionId, 'status' => 'active'],
                    ['user_id' => null]
                );
            }

    
            CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $validated['item_id'],
                'size' => $validated['size'],
                'crust' => $validated['crust'],
                'quantity' => $validated['quantity'],
                'unit_price' => Item::find($validated['item_id'])->price,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Item added to cart']);
        } catch (\Exception $e) {
            \Log::error('Error adding item to cart: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error adding item to cart.'], 500);
        }
    }


    public function index()
    {
        $carts = Cart::with('items.item')->latest()->get(); // eager load items and their related item info
        return view('cart.index', compact('carts'));
    }

    
    
    

}
