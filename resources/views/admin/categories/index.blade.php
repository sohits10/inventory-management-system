@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/>

<style>
  .category-table {
    border-radius: 20px;
    color: white;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    margin-top: 20px;
  }

  .category-table th {
    text-align: center;
    background-color: #343a40;
    color: #ffffff;
    font-weight: bold;
    padding: 1rem;
  }

  .category-table td {
    color: #f1f1f1;
    background-color: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    text-align: center;
    font-size: 0.95rem;
  }

  .category-table td img {
    border-radius: 10px;
    max-height: 80px;
  }

  .category-table tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }

  .btn-custom {
    margin: 0 5px;
  }

  .section-title {
    text-align: center;
    color: #fff;
    padding: 10px 0;
  }
</style>

<section id="categories" class="categories">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Categories</h2>
    </div>

    <div class="d-flex justify-content-between mb-3">
      <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
    </div>

    @if ($categories->count() > 0)
      <table class="table table-bordered category-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $index => $category)
            <tr>
              <td>{{ $index + 1 }}</td>

              <td>{{ $category->name }}</td>

              <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning btn-custom"><i class="bx bx-edit"></i> Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger btn-custom"><i class="bx bx-trash"></i> Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="text-center text-light">No categories found.</p>
    @endif

  </div>
</section>

@endsection
