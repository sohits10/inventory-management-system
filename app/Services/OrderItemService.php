<?php

namespace App\Services;

use App\Models\OrderItem;

class OrderItemService
{
    public function store(array $data)
    {
        return OrderItem::create($data);
    }

    public function update(OrderItem $orderItem, array $data)
    {
        $orderItem->update($data);
        return $orderItem;
    }

    public function delete(OrderItem $orderItem)
    {
        $orderItem->delete();
    }
}
