<style>
/* Positioning the toast at the top center of the form */
#toast-container {
    position: fixed;
    top: 1%; /* Position the toast 10% from the top of the viewport */
    left: 50%; /* Position the toast in the center horizontally */
    transform: translateX(-50%); /* Center the toast perfectly */
    z-index: 1050; /* Ensure it's above other content */
    display: none; /* Hidden by default */
    transition: opacity 0.5s ease;
}

/* Toast Styling */
#toast {
    background-color: #cda45e; /* Soft orange background */
    color: white;
    border-radius: 12px;
    padding: 15px 30px;
    font-size: 18px;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    opacity: 0; /* Toast is initially hidden */
    transform: translateY(-20px); /* Starts slightly above */
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.toast-body {
    font-size: 16px;
    text-align: center; /* Center the message */
}

/* Animation for showing and hiding the toast */
#toast.show {
    opacity: 1; /* Make toast visible */
    transform: translateY(0); /* Move into place */
}


</style>


<section id="book-an-order" class="book-a-table">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Orders</h2>
            <p>Book an Order</p>
        </div>
     

        <div id="toast-container" class="toast-container">
            <div id="toast" class="toast">
                <div class="toast-body">
                    <!-- Message will be dynamically inserted here -->
                </div>
            </div>
        </div>

        <form action="{{ route('orders.store') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="100" style="background-color: #333; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label text-light">Select Category</label>
                    <select id="category" class="form-select" style="background-color: #444; color: #fff; border: 1px solid #555;" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="items" class="form-label text-light">Select Item</label>
                    <select id="items" class="form-select" style="background-color: #444; color: #fff; border: 1px solid #555;" required>
                        <option value="">Select Item</option>
                    </select>
                </div>
            </div>

            <div class="row" style="margin-top:15px;">
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label text-light">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1" class="form-control" style="background-color: #444; color: #fff; border: 1px solid #555;" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="order_type" class="form-label text-light">Order Type</label>
                    <select name="order_type" id="order_type" class="form-select" style="background-color: #444; color: #fff; border: 1px solid #555;" required>
                        <option value="delivery">Delivery</option>
                        <option value="collection">Collection</option>
                    </select>
                </div>
            </div>

            <div class="row" style="margin-top:15px;">
                <div class="col-md-6 mb-3">
                    <label for="item_price" class="form-label text-light">Price</label>
                    <input type="text" id="item_price" class="form-control" readonly style="background-color: #444; color: #fff; border: 1px solid #555;">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="total_price" class="form-label text-light">Total Price</label>
                    <input type="text" id="total_price" class="form-control" readonly style="background-color: #444; color: #fff; border: 1px solid #555;">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn w-100 py-3 mt-3" style="background-color: ##cda4; border-color: #FF6F1F; font-weight: bold;">Place Order</button>
            </div>
        </form>



        <!-- Toast Container -->
<!-- Toast Container -->





    </div>
</section>





@push('scripts')
<script>
    $(document).ready(function() {
        $('#category').change(function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: '{{ route('getItemsByCategory') }}',
                    type: 'GET',
                    data: { category_id: category_id },
                    success: function(response) {
                        $('#items').empty();
                        $('#items').append('<option value="">Select Item</option>');
                        $.each(response.items, function(index, item) {
                            $('#items').append('<option value="' + item.id + '" data-price="' + item.price + '">' + item.item_name + ' - $' + item.price + '</option>');
                        });
                    }
                });
            } else {
                $('#items').empty();
                $('#items').append('<option value="">Select Item</option>');
            }
        });

        $('#items').change(function() {
            var price = $('option:selected', this).data('price');
            var quantity = $('#quantity').val();
            var total_price = price * quantity;

            $('#item_price').val(price);
            $('#total_price').val(total_price);
        });

        $('#quantity').keyup(function() {
            var price = $('#item_price').val();
            var quantity = $(this).val();
            var total_price = price * quantity;

            $('#total_price').val(total_price);
        });
    });



   



    $(document).ready(function() {
        // Event listener for order type selection
        $('#order_type').change(function() {
            var orderType = $(this).val();
            var toastMessage = '';

            // Set message based on order type
            if (orderType === 'delivery') {
                toastMessage = 'Your delivery will take approximately 45-60 minutes.';
            } else if (orderType === 'collection') {
                toastMessage = 'Your order will be ready for collection in 15-20 minutes.';
            }

            // If we have a message, show the toast
            if (toastMessage) {
                // Set the toast message dynamically
                $('#toast .toast-body').text(toastMessage);

                // Show the toast container
                $('#toast-container').show();

                // Create and show the toast using Bootstrap's Toast class
                var toast = new bootstrap.Toast($('#toast')[0]);
                toast.show();

                // Hide the toast after 10 seconds
                setTimeout(function() {
                    $('#toast-container').hide();
                }, 10000); // Stay visible for 10 seconds
            }
        });
    });

</script>

@endpush