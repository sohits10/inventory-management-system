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
</style>

<div class="container">
    <h1>Add New Menu Item</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>

            <div class="col-md-8">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price"  required min="0">
            </div>

            <div class="col-md-4">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" name="image_path" class="form-control" accept="image/*">
                </div>
        </div>


        <div class="mb-3">
            <label for="special_instruction" class="form-label">Special Instructions</label>
            <textarea class="form-control" id="special_instruction" name="special_instruction">{{ old('special_instruction') }}</textarea>
           
        </div>

        <button type="submit" class="btn btn-primary">Add Item</button>
        <a href="{{ route('items.index') }}" class="btn btn-danger">Back to List</a>
    </form>
</div>

@endsection
