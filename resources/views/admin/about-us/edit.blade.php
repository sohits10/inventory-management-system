@extends('layouts.guest')

@section('content')
<style>

    /* Add this to your CSS file or within a <style> block */
.spacing-top {
    margin-top: 100px; /* Adjust as necessary */
}

.spacing-bottom {
    margin-bottom: 50px; /* Adjust as necessary */
}

</style>
    <div class="container spacing-top">
        <h1>Edit About Us</h1>

        <!-- Check if there's any error message -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('about-us.update', $aboutUs->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <input type="hidden" class="form-control" name="uuid" id="uuid" value="{{ $aboutUs->uuid }}" >
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $aboutUs->title) }}">
            </div>

            <!-- Handling the content field (array) -->
            <div class="form-group">
<br/>
                @foreach($aboutUs->content['paragraphs'] as $index => $paragraph)
                    <div class="paragraph">
                        <div class="form-group">
                            <label for="paragraph_text_{{ $index }}">Paragraph Text</label>
                            <textarea class="form-control" name="content[paragraphs][{{ $index }}][text]" id="paragraph_text_{{ $index }}">{{ old('content.paragraphs.' . $index . '.text', $paragraph['text']) }}</textarea>
                        </div>

                        <div class="form-group">
                          <br/>
                            <label for="paragraph_points_{{ $index }}">Bullet Points</label>
                            <ul>
                                @foreach($paragraph['points'] as $pointIndex => $point)
                                <br/>
                                    <li>
                                        <input type="text" class="form-control" name="content[paragraphs][{{ $index }}][points][{{ $pointIndex }}]" value="{{ old('content.paragraphs.' . $index . '.points.' . $pointIndex, $point) }}">
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn btn-sm btn-primary add-point" data-index="{{ $index }}">Add Point</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <!-- Script to handle adding new bullet points dynamically -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.add-point').forEach(button => {
                button.addEventListener('click', function () {
                    const index = button.getAttribute('data-index');
                    const pointsList = button.closest('.paragraph').querySelector('ul');

                    // Create a new input field for a new point
                    const newPointInput = document.createElement('li');
                    newPointInput.innerHTML = `
                        <input type="text" class="form-control" name="content[paragraphs][${index}][points][]" value="">
                    `;
                    pointsList.appendChild(newPointInput);
                });
            });
        });
    </script>
@endsection
