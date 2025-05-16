<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Special;

class HomeController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::latest()->first();

        if ($aboutUs) {
            $aboutUs->content = json_decode($aboutUs->content, true);
        } else {
            $aboutUs = null;
        }

        $categories = Category::with(['items' => function ($query) {
            $query->where('is_available', true);
        }])->get();

        $items = Item::with('category')->where('is_available', true)->get();
        // dd($items);
        // dd($items->pluck('image_path'));

        $specials = Special::where('is_active', 1)
        ->whereNull('deleted_at')
        // ->where('start_date', '<=', now())
        // ->where('end_date', '>=', now())
        ->orderBy('created_at', 'desc')
        ->get();
        
        // dd($specials);


        return view('home', compact('aboutUs', 'categories', 'items','specials'));
    }

    public function getItemsByCategory(Request $request)
    {
        if ($request->ajax()) {
            $items = Item::where('category_id', $request->category_id)
                        ->where('is_available', true)
                        ->get(['id', 'item_name','price']);
        
            return response()->json(['items' => $items]);
        }

        return response()->json(['message' => 'Invalid Request'], 400);
    }
        
    
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'item_ids' => 'required|array',
            'item_ids.*' => 'exists:items,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        // Create Order
        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
        ]);

        // Create Order Items
        foreach ($validated['item_ids'] as $index => $itemId) {
            $quantity = $validated['quantities'][$index];
            $item = Item::findOrFail($itemId);

            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $itemId,
                'quantity' => $quantity,
                'sub_total' => $item->price * $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
