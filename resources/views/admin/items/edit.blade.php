@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/><br/><br/>

<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .form-label, .btn, .form-check-label {
        color: #f8f9fa; /* Light color for labels, buttons, and checkboxes */
    }

    .form-control {
        background-color: #333;
        color: #fff;
        border: 1px solid #444;
    }

    .form-control:focus {
        border-color: #007bff;
        background-color: #555;
    }

    .invalid-feedback {
        color: #dc3545;
    }

    .btn {
        background-color: #007bff;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .mb-3 {
        margin-bottom: 1rem; /* Standard margin between form elements */
    }

    .row {
        margin-bottom: 1.5rem; /* Spacing between rows */
    }

    .container {
        max-width: 900px; /* Control the form width */
        margin: 0 auto;
        padding: 0 15px;
    }
</style>

<div class="container">

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        
    @csrf
    @method('PUT')

<!-- {{    dump($item->id);}}   -->

        <div class="row">
            <div class="col-md-4">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="{{ old('item_name', $item->item_name) }}" required>
                @error('item_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-8">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $item->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $item->price) }}" required min="0">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}" {{ $item->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_available" name="is_available" value="1"
                {{ old('is_available', $item->is_available) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_available">Available</label>
        </div>

        <div class="mb-3">
            <label for="special_instruction" class="form-label">Special Instructions</label>
            <textarea class="form-control" id="special_instruction" name="special_instruction">{{ old('special_instruction', $item->special_instruction) }}</textarea>
            @error('special_instruction')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('items.index') }}" class="btn btn-danger">Back to List</a>
    </form>
</div>

@endsection
