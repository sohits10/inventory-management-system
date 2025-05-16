@extends('layouts.app')

@section('content')

<br/><br/><br/><br/><br/><br/>

<style>
    .card-header h3, .form-label, h4 {
        color: #212529; /* Default Bootstrap dark color */
    }

    .image-preview {
        max-width: 300px;
        max-height: 200px;
        margin-top: 10px;
        display: none;
        border-radius: 8px;
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Create About Us Section</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('about-us.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <!-- Dynamic Content Section -->
                <div id="content-section">
                    <h4>Content Paragraphs</h4>
                    <div id="paragraphs-container">
                        <div class="paragraph-item mb-4">
                            <div class="mb-2">
                                <label class="form-label">Paragraph Text</label>
                                <textarea name="content[paragraphs][0][text]" class="form-control" rows="2" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-2 points-container">
                                <label class="form-label">Bullet Points</label>
                                <div class="points-list">
                                    <input type="text" name="content[paragraphs][0][points][]" class="form-control mb-1">
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary add-point">Add Point</button>
                                <button type="button" class="btn btn-danger d-none cancel-point">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-paragraph" class="btn btn-secondary mt-3">Add Paragraph</button>
                    <button type="button" class="btn btn-sm btn-danger d-none" id="cancel-paragraph">Cancel Paragraph</button>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-4">Save</button>
                <a href="{{ route('about-us.index') }}" class="btn btn-warning">Back to List</a>

            </form>
        </div>
    </div>
</div>

<script>
    let paragraphCount = 1;

    // Function to add a new point input field
    // Function to add a new point input field
    function addPointHandler(event) {
        const pointsContainer = event.target.closest('.points-container');
        const pointsList = pointsContainer.querySelector('.points-list');

        // Creating a new point input field with a remove button
        const pointItem = document.createElement('div');
        pointItem.classList.add('point-item', 'mb-2', 'd-flex', 'align-items-center');

        pointItem.innerHTML = `
            <input type="text" name="content[paragraphs][${paragraphCount - 1}][points][]" 
                class="form-control me-2" placeholder="Enter a point">
            <button type="button" class="btn btn-sm btn-danger remove-point">Cancel</button>
        `;

        // Append the new point item to the list
        pointsList.appendChild(pointItem);

        // Add click event listener to the specific "Cancel" button for the new point input
        const removeButton = pointItem.querySelector('.remove-point');
        removeButton.addEventListener('click', () => {
            // Remove only the specific point item
            pointsList.removeChild(pointItem);
        });
    }

    // Adding click event listener for the Add Point button
    document.addEventListener('DOMContentLoaded', function () {
        const addPointButtons = document.querySelectorAll('.add-point');
        addPointButtons.forEach(button => {
            button.addEventListener('click', addPointHandler);
        });
    });

    // Adding click event listener for the Add Paragraph button
    document.getElementById('add-paragraph').addEventListener('click', () => {
        const paragraphsContainer = document.getElementById('paragraphs-container');
        const newParagraph = document.createElement('div');
        newParagraph.classList.add('paragraph-item', 'mb-4');

        newParagraph.innerHTML = `
            <h5>Paragraph ${paragraphCount + 1}</h5>
            <div class="mb-2">
                <label for="paragraph-text-${paragraphCount}">Paragraph Text</label>
                <textarea id="paragraph-text-${paragraphCount}" name="content[paragraphs][${paragraphCount}][text]" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-2">
                <label for="paragraph-image-${paragraphCount}">Image Path</label>
                <input id="paragraph-image-${paragraphCount}" type="text" name="content[paragraphs][${paragraphCount}][image]" class="form-control">
            </div>
            <div class="mb-2 points-container">
                <label>Bullet Points</label>
                <div class="points-list"></div>
                <button type="button" class="btn btn-sm btn-secondary add-point">Add Point</button>
                <button type="button" class="btn btn-sm btn-danger cancel-point d-none">Cancel</button>
            </div>
        `;

        // Append the new paragraph
        paragraphsContainer.appendChild(newParagraph);

        // Add click event listener to the new "Add Point" button
        const addPointButton = newParagraph.querySelector('.add-point');
        addPointButton.addEventListener('click', addPointHandler);

        // Show the cancel button for paragraphs
        const cancelParagraphButton = document.getElementById('cancel-paragraph');
        cancelParagraphButton.classList.remove('d-none');
        cancelParagraphButton.addEventListener('click', () => {
            newParagraph.remove();
            if (paragraphsContainer.children.length === 0) {
                cancelParagraphButton.classList.add('d-none');
            }
        });

        paragraphCount++;
    });
</script>

@endsection
