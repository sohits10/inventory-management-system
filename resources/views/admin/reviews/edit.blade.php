@extends('layouts.guest')

@section('content')

<br/><br/><br/><br/><br/><br/>

<div class="container">

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select name="rating" id="rating" class="form-select">
                @foreach(range(1, 5) as $rating)
                    <option value="{{ $rating }}" {{ $review->rating == $rating ? 'selected' : '' }}>{{ $rating }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control" rows="4">{{ $review->remarks }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
