<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Models\OrderItem;
use App\Services\OrderItemService;

class OrderItemController extends Controller
{
    protected $orderItemService;

    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }

    public function index()
    {
        $orderItems = OrderItem::with(['order', 'item'])->get();
        return view('admin.order_items.index', compact('orderItems'));
    }

    public function create()
    {
        return view('admin.order_items.create');
    }

    public function store(OrderItemRequest $request)
    {
        $this->orderItemService->store($request->validated());
        return redirect()->route('order_items.index')->with('success', 'Order item created successfully.');
    }

    public function edit(OrderItem $orderItem)
    {
        return view('order_items.edit', compact('orderItem'));
    }

    public function update(OrderItemRequest $request, OrderItem $orderItem)
    {
        $this->orderItemService->update($orderItem, $request->validated());
        return redirect()->route('order_items.index')->with('success', 'Order item updated successfully.');
    }

    public function destroy(OrderItem $orderItem)
    {
        $this->orderItemService->delete($orderItem);
        return redirect()->route('order_items.index')->with('success', 'Order item deleted successfully.');
    }
}
