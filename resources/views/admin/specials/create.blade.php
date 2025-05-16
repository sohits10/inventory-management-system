@extends('layouts.guest')

@section('content')
<br /><br /><br /><br /><br />
<div class="container">
    <h1>Create Special</h1>
    <form action="{{ route('specials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="item_id">Menu Item (Optional)</label>
            <select class="form-select" id="item_id" name="item_id" required>
                    <option value="">Select Menu</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->item_name }}
                        </option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $special->name ?? '') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $special->description ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $special->price ?? '') }}">
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $special->start_date ?? '') }}">
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $special->end_date ?? '') }}">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="is_active">Active</label>
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $special->is_active ?? true) ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:10px;">Save</button>
    </form>
</div>
@endsection
