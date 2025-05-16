<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Category;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;



class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        $items = Item::with('category')->paginate(10);
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    // public function store(StoreItemRequest $request)
    // {
    //     $this->itemService->store($request->validated());
    //     return redirect()->route('items.index')->with('success', 'Item created successfully.');
    // }










    public function store(StoreItemRequest $request)
    {
        // Use the service to handle image upload
        $imagePath = $this->itemService->handleImageUpload($request);
    
        // Create the item record in the database
        $item = Item::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $imagePath, // Save the image path
            'special_instruction' => $request->special_instruction,
        ]);
    
        // dd($item);
        // Redirect to the item list with a success message
        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }
    

  

    public function edit(Item $item): View
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(StoreItemRequest $request, Item $item): RedirectResponse
    {
        $data = $request->validated();
        $this->itemService->update($item, $data);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }



    

    // public function update(StoreItemRequest $request, $id)
    // {   
    //     $item = Item::findOrFail($id);

    //     $item->update($request->validated());

    //     return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    // }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
