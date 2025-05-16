@extends('layouts.guest')

@section('content')
<br /><br/><br /><br />
<br />
<style>
  .special-table {
    border-radius: 20px;
    color: white;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    margin-top: 20px;
  }

  .special-table th {
    text-align: center;
    background-color: #343a40;
    color: #ffffff;
    font-weight: bold;
    padding: 1rem;
  }

  .special-table td {
    color: #f1f1f1;
    background-color: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    text-align: center;
    font-size: 0.95rem;
  }

  .special-table td img {
    border-radius: 10px;
    max-height: 80px;
  }

  .special-table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }
</style>

<div class="container">
    <h1>Specials</h1>
    <a href="{{ route('specials.create') }}" class="btn btn-primary mb-3">Add Special</a>
    <table class="special-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php $index = 1 ?>
        <tbody>
            @foreach($specials as $special)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $special->name ?? $special->menu->name }}</td>
                    <td>£{{ $special->price }}</td>
                    <td>{{ $special->description }}</td>
                    <td>{{ $special->start_date }}</td>
                    <td>{{ $special->end_date ?? 'Indefinite' }}</td>
                    <td>
                        <a href="{{ route('specials.edit', $special->uuid) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('specials.destroy', $special) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
