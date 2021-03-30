@extends('layouts.master_front')
@section('content')

<!-- start featured categories -->
<div class="categories">
    <div class="small-container">
       <div class="row">
          <div class="col-3">
             <img src="{{ asset('assets/images/category-1.jpg') }}" alt="category-1">
          </div>
          <div class="col-3">
             <img src="{{ asset('assets/images/category-2.jpg') }}" alt="category-2">
          </div>
          <div class="col-3">
             <img src="{{ asset('assets/images/category-3.jpg') }}" alt="category-3">
          </div>
       </div>
    </div>
 </div>
 <!-- end featured categories -->

 <!-- start products -->
 <div class="small-container">
    <!-- start featured products -->
    <h2 class="title">Featured Products</h2>
    <div class="row">
       <div class="col-4">
          <img src="{{ asset('assets/images/product-2.jpg') }}" alt="product-2">
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i>
          </div>
          <p>$50.00</p>
       </div>
       <div class="col-4">
          <img src="{{ asset('assets/images/product-3.jpg') }}" alt="product-3">
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-half-o"></i>
          </div>
          <p>$50.00</p>
       </div>
       <div class="col-4">
          <img src="{{ asset('assets/images/product-4.jpg') }}" alt="product-4">
          <h4>Red Printed T-shirt</h4>
          <div class="rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i>
          </div>
          <p>$50.00</p>
       </div>
       <div class="col-4">
          <a href="{{ route('product.detail', [1]) }}"><img src="{{ asset('assets/images/product-1.jpg') }}" alt="product-1"></a>
          <a href="{{ route('product.detail', [1]) }}"><h4>Red Printed T-shirt</h4></a>
          <div class="rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i>
          </div>
          <p>$50.00</p>
       </div>
    </div>
    <!-- end featured products -->

    <!-- start latest products -->
    <h2 class="title">Latest Products</h2>
    <div class="row">
      @foreach ($lastestProduct as $item)
         <div class="col-4">
            <a href="{{ route('product.detail', $item->id) }}"><img src="{{ asset('storage/assets/images/gallery/1080x1440').'/'.$item->imageUploaded[0]->name }}" alt="{{ $item->slug }}"></a>
            <a href="{{ route('product.detail', $item->id) }}"><h4>{{ $item->title }}</h4></a>
            <div class="rating">
               @for ($i = 0; $i < 5; ++$i)
                  <i class="fa fa-star{{ $item->rating <= $i ? '-o' : '' }}"></i>
               @endfor
            </div>
            <p>${{ $item->price }}.00</p>
         </div>
       @endforeach
    </div>
    <!-- end latest products -->
 </div>
 <!-- end products -->

 <!-- start offer -->
 <div class="offer">
    <div class="small-container">
       <div class="row">
          <div class="col-2">
             <img src="{{ asset('assets/images/exclusive.png') }}" alt="exclusive" class="offer-img">
          </div>
          <div class="col-2">
             <p>Exclusively Available on RedStore</p>
             <h1>Smart Band 4</h1>
             <small>The Mi Smart Band 4 features a 39.9% larger (than Mi Band 3) AMOLED color full-touch display with adjustable brightness, so everything is clear as can be.</small><br>
             <a href="" class="btn">Buy Now &#8594;</a>
          </div>
       </div>
    </div>
 </div>
 <!-- end offer -->

 <!-- start testimonial -->
 <div class="testimonial" id="testimonial">
    <div class="small-container">
       <div class="row">
          <div class="col-3">
             <i class="fa fa-quote-left"></i>
             <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, error? Sequi, dolores, quisquam, cumque quam impedit voluptate assumenda natus dolor ab neque molestiae incidunt reprehenderit?</p>
             <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
             </div>
             <img src="{{ asset('assets/images/user-1.png') }}" alt="user-1">
             <h3>Sean Parker</h3>
          </div>
          <div class="col-3">
             <i class="fa fa-quote-left"></i>
             <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, error? Sequi, dolores, quisquam, cumque quam impedit voluptate assumenda natus dolor ab neque molestiae incidunt reprehenderit?</p>
             <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
             </div>
             <img src="{{ asset('assets/images/user-2.png') }}" alt="user-2">
             <h3>Mike Smith</h3>
          </div>
          <div class="col-3">
             <i class="fa fa-quote-left"></i>
             <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, error? Sequi, dolores, quisquam, cumque quam impedit voluptate assumenda natus dolor ab neque molestiae incidunt reprehenderit?</p>
             <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
             </div>
             <img src="{{ asset('assets/images/user-3.png') }}" alt="user-3">
             <h3>Mabel Joe</h3>
          </div>
       </div>
    </div>
 </div>
 <!-- end testimonial -->

 <!-- start brands -->
 <div class="brands">
    <div class="small-container">
       <div class="row">
          <div class="col-5">
             <img src="{{ asset('assets/images/logo-godrej.png') }}" alt="logo-godrej">
          </div>
          <div class="col-5">
             <img src="{{ asset('assets/images/logo-coca-cola.png') }}" alt="logo-coca-cola.png">
          </div>
          <div class="col-5">
             <img src="{{ asset('assets/images/logo-oppo.png') }}" alt="logo-oppo.png">
          </div>
          <div class="col-5">
             <img src="{{ asset('assets/images/logo-paypal.png') }}" alt="logo-paypal.png">
          </div>
          <div class="col-5">
             <img src="{{ asset('assets/images/logo-philips.png') }}" alt="logo-philips.png">
          </div>
       </div>
    </div>
 </div>
 <!-- end brands -->
    
@endsection