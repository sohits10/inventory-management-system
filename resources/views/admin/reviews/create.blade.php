@extends('layouts.guest')

@section('content')


<br/><br/><br/><br/><br/><br/>


<div class="container">
    <h2>Add Review</h2>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select name="rating" id="rating" class="form-select">
                <option value="">Select Rating</option>
                @foreach(range(1, 5) as $rating)
                    <option value="{{ $rating }}">{{ $rating }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
