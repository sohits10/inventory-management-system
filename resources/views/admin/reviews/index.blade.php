@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/><br/><br/>

<style>
    table {
        border-radius: 20px; /* Add rounded corners to the table */
        overflow: hidden;    /* Prevent content from overflowing outside the rounded corners */
    }

    th, td {
        padding: 1rem;
    }

    th {
        background-color: #343a40;
        color: white;
    }

    td {
        background-color: #444;
        color: white;
    }

    /* Optional: Add borders to the cells if you need them */
    table, th, td {
        border: 1px solid #ddd; /* Light border color */
    }

    tr:nth-child(even) {
        background-color: #555; /* Lighter background for even rows */
    }

    tr:nth-child(odd) {
        background-color: #444; /* Darker background for odd rows */
    }
</style>




<div class="container">
    <a href="{{ route('reviews.create') }}" class="btn btn-primary mb-3">Add New Review</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Rating</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->remarks }}</td>
                    <td>
                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No reviews found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
