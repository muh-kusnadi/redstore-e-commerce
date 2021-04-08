@if (isset($headerColor) && $headerColor == true) <div class="header"> @endif
   <div class="container">
      <div class="navbar">
         <div class="logo">
            <a href="{{ route('front.index') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="125px"></a>
         </div>
         <nav>
            <ul id="MenuItems">
               <li><a href="{{ route('front.index') }}">Home</a></li>
               <li><a href="{{ route('products.index') }}">Products</a></li>
               @if (isset($landing) && $landing == true)
                  <li><a href="#testimonial">Testimonial</a></li>
               @endif
               <li><a href="#footer">Contact</a></li>
               @if (!Auth::check())
                  <li><a href="{{ route('auth.index') }}">Login/Register</a></li>
               @else
                  <li><a href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                  <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
               @endif
            </ul>
         </nav>
         @if (Auth::check())
            <a href="{{ route('cart.index') }}"><img src="{{ asset('assets/images/cart.png') }}" alt="cart" width="30px" height="30px"></a>
         @endif
         <img src="{{ asset('assets/images/menu.png') }}" alt="menu" class="menu-icon" onclick="menuToggle()">
      </div>
      @if (isset($landing) && $landing == true)
      <div class="row">
         <div class="col-2">
            <h1>Give Your Workout<br>A New Style!</h1>
            <p>Success isn't always about greatness. It's about consistency. Consistent<br>hard work gain success. Greatness will come.</p>
            <a href="{{ route('products.index') }}" class="btn">Explore Now &#8594;</a>
         </div>
         <div class="col-2">
            <img src="{{ asset('assets/images/image1.png') }}" alt="image1">
         </div>
      </div>
      @endif
   </div>
@if (isset($headerColor) && $headerColor == true) </div> @endif