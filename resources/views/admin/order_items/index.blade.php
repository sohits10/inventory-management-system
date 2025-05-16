@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/><br/>


<style>
  .table-dark {
    border-radius: 20px;
    color: white;
    overflow: hidden; 
  }
</style>

<h1>Ordered Items List</h1>
<!-- <a href="{{ route('order_items.create') }}" class="btn btn-primary">Add Order Item</a> -->
<table class="table table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Sub Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItems as $orderItem)
            <tr>
                <td>{{ $orderItem->id }}</td>
                <td>{{ $orderItem->order->id }}</td>
                <td>{{ $orderItem->item->name }}</td>
                <td>{{ $orderItem->quantity }}</td>
                <td>{{ $orderItem->sub_total }}</td>
                <td>
                    <a href="{{ route('order_items.edit', $orderItem) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('order_items.destroy', $orderItem) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
