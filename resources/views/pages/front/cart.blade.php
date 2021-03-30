@extends('layouts.master_front')
@section('content')

<!-- start cart items details -->
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Product</th>
            <th style="text-align: center;">Quantity</th>
            <th>Subtotal</th>
        </tr>
        <tr>
            @php $subTotal = 0; @endphp
            @forelse ($cart as $item)
            @php $isCartEmpty = false; @endphp
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="{{ asset('storage/assets/images/gallery/200x200').'/'.$item->product->imageUploaded[0]->name }}" alt="buy-1">
                        <div>
                            <p>{{ $item->product->title }}</p>
                            <small>Price: ${{ $item->product->price }}.00</small>
                            <br>
                            <a href="#" class="removeFromCart" data-id="{{ $item->id }}">Remove</a>
                        </div>
                    </div>
                </td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td>${{ $item->total }}.00</td>
            </tr>
            @php $subTotal = $subTotal + $item->total; @endphp
            @empty
            @php $isCartEmpty = true; @endphp
            <tr><td></td></tr>
            <tr>
                <td colspan="3" style="text-align: center">Oops! Your cart is empty! Looks like you haven't made your choise yet...</td>
            </tr>
            <tr><td></td></tr>
            @endforelse
        </tr>
    </table>

    <div class="total-price">
        <table>
            @if ($isCartEmpty)
            <tr>
                <td>Subtotal</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>-</td>
            </tr>
            @else
            <tr>
                <td>Subtotal</td>
                <td>${{ $subTotal }}.00</td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>10%</td>
            </tr>
            <tr>
                <td>Total</td>
                @php 
                    $tax = (10 / 100) * $subTotal;
                    $total = $subTotal + $tax;
                @endphp
                <td>${{ str_replace('.', ',', $total) }}.00</td>
            </tr>
            @endif
        </table>
    </div>

    @if (!$isCartEmpty)
    <div class="checkout">
         <a href="#" class="btn" id="checkoutOrder">Checkout &#8594;</a>
    </div>
    @endif
</div>
<!-- end cart items details -->

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function() {
    //using class selector instead id because id can refer to only one element in DOM
    //strongly recommended using this if the element is coming from loop
    $('.removeFromCart').on('click', function(e) {  
        e.preventDefault();

        let id  = $(this).attr("data-id");
        let url = "{{ route('cart.remove', ':id') }}";
            url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                let response = JSON.parse(res)

                toastr.success(response.message)

                location.reload();
            },
            error : function(err) {
                if(Array.isArray(err.responseJSON.message)){
                    err.responseJSON.message.forEach(function(v) {
                        toastr.error(v)
                    })
                } else {
                    toastr.error(err.responseJSON.message)
                }
            }
        })
    })

    $('#checkoutOrder').on('click', function(e) {
        e.preventDefault();
        
        let uuid = "{{ $isCartEmpty ? '' : $item->uuid }}";

        $.ajax({
            url: "{{ route('cart.checkout') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                uuid: uuid
            },
            success: function(res) {
                let response = JSON.parse(res)

                toastr.success(response.message)

                location.reload();
            },
            error : function(err) {
                if(Array.isArray(err.responseJSON.message)){
                    err.responseJSON.message.forEach(function(v) {
                        toastr.error(v)
                    })
                } else {
                    toastr.error(err.responseJSON.message)
                }
            }
        })

    })
})   
</script>
@endpush