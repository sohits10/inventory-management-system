
@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/><br/><br/>

<style>
    .card-header h3, .form-label, h4 {
    color: #212529; /* Default Bootstrap dark color */
    }
</style>


<div class="container">
    <h1>{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h1>

    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    

        <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update' : 'Create' }}</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
