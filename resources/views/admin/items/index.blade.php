@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/><br/><br/>

<style>
  .about-table {
    border-radius: 20px;
    color: white;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    margin-top: 20px;
  }

  .about-table th {
    text-align: center;
    background-color: #343a40;
    color: #ffffff;
    font-weight: bold;
    padding: 1rem;
  }

  .about-table td {
    color: #f1f1f1;
    background-color: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    text-align: center;
    font-size: 0.95rem;
  }

  .about-table td img {
    border-radius: 10px;
    max-height: 80px;
  }

  .about-table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }
</style>


<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Menu Items</h1>
        <a href="{{ route('items.create') }}" class="btn btn-primary">Add New Item</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped about-table" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>
                            <span class="badge {{ $item->is_available ? 'bg-success' : 'bg-danger' }}">
                                {{ $item->is_available ? 'Available' : 'Not Available' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
