@extends('layouts.master_front')
@section('content')

<div class="small-container">
    <div class="row row-2">
        <h2>All Products</h2>
        <select>
            <option value="">Default Shorting</option>
            <option value="">Short by price</option>
            <option value="">Short by popularity</option>
            <option value="">Short by rating</option>
            <option value="">Short by sale</option>
        </select>
    </div>
   <!-- start all products products -->
   <div class="row">
      @foreach ($products as $item)
         <div class="col-4">
            <a href="{{ route('product.detail', $item->id) }}"><img src="{{ asset('storage/assets/images/gallery/1080x1440').'/'.$item->imageUploaded[0]->name }}" alt="{{ $item->slug }}"></a>
            <a href="{{ route('product.detail', $item->id) }}"><h4>{{ $item->title }}</h4></a>
            <div class="rating">
               @for ($i = 0; $i < 5; ++$i)
                  <i class="fa fa-star{{ $item->rating <= $i ? '-o' : '' }}"></i>
               @endfor
            </div>
            <p>${{ $item->price }}</p>
         </div>
      @endforeach
   </div>
   <!-- end all products products -->
</div>

@endsection