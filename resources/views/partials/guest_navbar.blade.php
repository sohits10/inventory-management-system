<nav id="navbar" class="navbar order-last order-lg-0">
    <ul>

        <li class="dropdown">
            <a href="{{ route('reservations')}}"><span>Reservation</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Pending</a></li>
                <!-- <li class="dropdown">
                    <a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                      
                    </ul>
                </li> -->
                <li><a href="#">Approved</a></li>
                <li><a href="#">Canceled </a></li>
                <li><a href="#">Completed</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href=""><span>LookUp tables </span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="{{ route('about-us.index') }}">About Us</a></li>
                <li><a href="{{ route('categories.index')}}">Categories </a></li>
                <li><a href="{{ route('reviews.index')}}">Reviews </a></li>

            </ul>
        </li>
     
                <li><a class="nav-link scrollto" href="{{ route('items.index')}}">Menus</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
           


    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav>
