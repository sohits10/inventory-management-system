@extends('layouts.app')

@section('content')



<section id="hero" class="d-flex align-items-center">
  <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
    <!-- Login Form (Hidden by Default) -->
    <div id="loginFormContainer" style="display: none; margin-top: 20px;">
        <div class="container">
            <h3>Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>

            </form>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <h1>Welcome to <span>BistroBoard</span></h1>
        <h2>Delivering great food ...!</h2>

        <div class="btns">
          <a href="#menu" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
          <a href="#book-an-order" class="btn-book animated fadeInUp scrollto">Book an Order</a>
        </div>
      </div>
      <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative" data-aos="zoom-in" data-aos-delay="200">
        <a href="https://www.youtube.com/watch?v=GlrxcuEDyF8" class="glightbox play-btn"></a>
      </div>
    </div>
  </div>
</section>



<main id="main">

    @include('partials.about-us')
   
    @include('partials.why_us')

    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">

          <div class="section-title">
              <h2>Menu</h2>
              <p>Check Our Tasty Menu</p>
          </div>
          
          <div class="d-flex justify-content-end mb-3">
              <!-- <button class="btn btn-warning" id="viewCartBtn">
                  <i class="bi bi-cart"></i> View Cart (<span id="cartItemCount">0</span> items)
              </button> -->

              <button class="btn btn-warning" id="viewCartBtn" data-bs-toggle="modal" data-bs-target="#cartModal">
    <i class="bi bi-cart"></i> View Cart (<span id="cartItemCount">0</span> items)
</button>


            
          </div>
          
          <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-lg-12 d-flex justify-content-center">
                  <ul id="menu-flters">
                      <li data-filter="*" class="filter-active">All</li>
                      @foreach($categories as $category)
                          <li data-filter=".filter-{{ strtolower($category->name) }}">
                              {{ $category->name }}
                          </li>
                      @endforeach
                  </ul>
              </div>
          </div>

          <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
              @forelse($items as $item)
                  @php
                      $filterClass = $item->category ? 'filter-' . strtolower($item->category->name) : '';
                      $imagePath = $item->image_path ? asset($item->image_path) : asset('assets/img/default-image.jpg');
                  @endphp
                  <div class="col-lg-4 menu-item {{ $filterClass }}">
                      <div class="card menu-card shadow-lg rounded-3 position-relative">
                          <!-- Badge for Special Items -->
                          @if($item->is_new)
                              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">New</span>
                          @endif

                           <!-- Subtle light gray background -->

                          <div class="card-body p-3" style="background-color:rgb(220, 205, 184);">
                              <h5 class="card-title text-center text-dark font-weight-bold">{{ $item->item_name }}</h5>
                              <p class="card-text text-muted text-center">{{ $item->description ?? 'No description available' }}</p>
                              
                              <div class="d-flex justify-content-between align-items-center mt-3">
                                  <span class="text-success font-weight-bold">${{ number_format($item->price, 2) }}</span>
                                  
                                  <!-- Add to Cart Button -->
                                  <button class="btn btn-warning add-to-cart-btn"
                                          data-item-id="{{ $item->id }}"
                                          data-item-name="{{ $item->item_name }}"
                                          data-item-image="{{ $item->image_path }}"
                                          data-item-price="{{ $item->price }}"
                                          data-item-description="{{ $item->description }}"
                                          data-bs-toggle="modal" data-bs-target="#cartModal">
                                      Add to Cart
                                  </button>
                              </div>
                          </div>

                      </div>
                  </div>
              @empty
                  <div class="col-12 text-center">
                      <p>No menu items available.</p>
                  </div>
              @endforelse
          </div>

      </div>
    </section>

    @include('partials.specials')

    @include('partials.testimonials')

    @include('partials.gallery')

    @include('partials.orders')

    @include('partials.chefs')

    @include('partials.contact')

    @include('partials.reservations')

    @include('partials.cart_model')


    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="cartItemsContainer">
                    <!-- Cart Items will be dynamically inserted here -->
                    <p>No items in the cart.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>

</main>


    

    <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>BistroBoard</h3>
              <p>
                LU1 2EP <br>
                Luton, UK<br><br>
                <strong>Phone:</strong> +44 7887 2315 99<br>
                <strong>Email:</strong> rahimraihan18@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links</h4>
            <!-- <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('login') }}">Login</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('orders')}}">My Orders</a></li>
            </ul> -->

            <ul class="navbar-nav ms-auto">
            <button id="footer-login-button" class="btn btn-primary mt-2">Login</button>
            <li class="nav-item"><a class="nav-link" href="{{ route('orders') }}">My Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reservations') }}">Reservations</a></li>
           
        </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>???</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Raihan</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Rahimullah Raihan</a>
      </div>
    </div>
    </footer>





    
@endsection


@push('scripts')

    <script>
        document.getElementById('footer-login-button').addEventListener('click', function () {
        const loginForm = document.getElementById('loginFormContainer');
        loginForm.style.display = 'block';

        const heroSection = document.getElementById('hero');
        heroSection.scrollIntoView({ behavior: 'smooth' });
      });

    </script>




    <script>
      document.addEventListener('DOMContentLoaded', function() {
         const tabs = document.querySelectorAll('#special-tabs .nav-link');
         const contentDiv = document.querySelector('#specials-content .tab-pane');

         tabs.forEach(tab => {
             tab.addEventListener('click', function(e) {
                 // Prevent default link behavior
                 e.preventDefault();

                 // Get the related special's data from the clicked tab
                 const specialName = this.getAttribute('data-name');
                 const specialDescription = this.getAttribute('data-description');
                 const specialDetails = this.getAttribute('data-details');

                 // Replace the current content with the new special's data
                 contentDiv.querySelector('h3').textContent = specialName;
                 contentDiv.querySelector('.fst-italic').textContent = specialDescription;
                 contentDiv.querySelector('p').textContent = specialDetails;
                 
                 // Optionally, update the image if you have dynamic images
                 // contentDiv.querySelector('img').src = specialImageUrl;

                 // Add active class to the clicked tab and remove from others
                 tabs.forEach(tab => tab.classList.remove('active', 'show'));
                 this.classList.add('active', 'show');
                });
            });
          });
    </script>



  <script>
    // View Cart Button Click Handler
    document.getElementById('viewCartBtn').addEventListener('click', function () {
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || []; // Retrieve items from localStorage

        let cartItemsContainer = document.getElementById('cartItemsContainer');
        cartItemsContainer.innerHTML = ''; // Clear the cart items container before inserting new items

        if (cartItems.length > 0) {
            cartItems.forEach(item => {
                let itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');
                itemElement.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${item.name}</strong><br>
                            <small>${item.size} (${item.crust})</small>
                        </div>
                        <div>
                            <span>${item.quantity} x $${item.price}</span><br>
                            <span>Total: $${(item.quantity * item.price).toFixed(2)}</span>
                        </div>
                    </div>
                `;
                cartItemsContainer.appendChild(itemElement);
            });
        } else {
            cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
        }
    });

  </script>





    


@endpush