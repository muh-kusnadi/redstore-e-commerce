@extends('layouts.master_front')
@section('content')

<!-- start cart items details -->
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <tr>
            @forelse ($cart as $item)
            @php $isCartEmpty = false; @endphp
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="{{ asset('assets/images/buy-1.jpg') }}" alt="buy-1">
                        <div>
                            <p>Red Printed T-Shirt</p>
                            <small>Price: $50.00</small>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$50.00</td>
            </tr>
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
                <td>$200.00</td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>$20.00</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>$220.00</td>
            </tr>
            @endif
        </table>
    </div>

    @if (!$isCartEmpty)
    <div class="checkout">
         <a href="" class="btn">Checkout &#8594;</a>
    </div>
    @endif
</div>
<!-- end cart items details -->

@endsection