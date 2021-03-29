@extends('layouts.master_front')
@section('content')

<!-- start single product details -->
<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img src="{{ asset('storage/assets/images/gallery/600x600').'/'.$product->imageUploaded[0]->name }}" alt="{{ $product->slug }}" width="100%" id="productImg">

            <div class="small-img-row">
                @foreach ($product->imageUploaded as $item)
                    <div class="small-img-col">
                        <img src="{{ asset('storage/assets/images/gallery/600x600').'/'.$item->name }}" alt="{{ $item->name }}" width="100%" class="small-img">
                    </div>
                @endforeach
            </div>

        </div>
        <div class="col-2">
            <p>Home / T-Shirt</p>
            <h1>{{ $product->title }}</h1>
            <h4>$50.00</h4>
            <select>
                <option>Select Size</option>
                <option>XXL</option>
                <option>XL</option>
                <option>Large</option>
                <option>Medium</option>
                <option>Small</option>
            </select>
            <input type="number" value="1">
            <a href="" class="btn">Add To Cart</a>
            
            <h3>Product Details <i class="fa fa-indent"></i></h3>
            <br>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>
<!-- end single product details -->

<!-- start title -->
<div class="small-container">
    <div class="row row-2">
        <h2>Related Products</h2>
        <p>View More</p>
    </div>
</div>
<!-- end title -->

<div class="small-container">
   <!-- start all products products -->
   <div class="row">
     <div class="col-4">
         <img src="{{ asset('assets/images/product-1.jpg') }}" alt="product-1">
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
   </div>
   <!-- end all products products -->
</div>

@endsection

@push('scripts')
<!-- js for product details gallery -->
<script>
    var productImg = document.getElementById("productImg");
    var smallImg = document.getElementsByClassName("small-img");

    smallImg[0].onclick = function () {
        productImg.src = smallImg[0].src;
    }
    smallImg[1].onclick = function () {
        productImg.src = smallImg[1].src;
    }
    smallImg[2].onclick = function () {
        productImg.src = smallImg[2].src;
    }
    smallImg[3].onclick = function () {
        productImg.src = smallImg[3].src;
    }
</script>
@endpush