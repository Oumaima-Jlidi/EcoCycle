@extends('Front.frontIndex')
@section('frontSection')

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>
        <form action="{{ route('order.store') }}" method="POST">
            @csrf <!-- Add CSRF token for security -->
            <div class="row g-5">
                <div class="col-md-12 col-lg-6">
                    <div class="form-item">
                        <label class="form-label my-3">Address<sup>*</sup></label>
                        <input type="text" name="adresse_livraison" class="form-control" placeholder="House Number and Street Name" required>
                        </div>
                    
                </div>

                <div class="col-md-12 col-lg-6">
                    <h4 class="mb-4">Your Cart</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cartTotal = 0; // Initialize total for the cart
                                @endphp

                                @foreach(session('cart', []) as $id => $item) <!-- Loop through cart items -->
                                    <tr>
                                        <td>
                                            <img src="{{ isset($item['image']) ? asset($item['image']) : asset('img/default-image.jpg') }}" class="img-fluid rounded-circle" style="width: 80px; height: 80px;" alt="{{ isset($item['name']) ? $item['name'] : 'Product' }}">
                                            <p class="mb-0">{{ isset($item['name']) ? $item['name'] : 'Unknown' }}</p>
                                        </td>
                                        <td>
                                            @php
                                                $itemTotal = (isset($item['total_price']) && isset($item['quantite'])) ? $item['total_price'] : 0;
                                                $cartTotal += $itemTotal; // Add item total to cart total
                                            @endphp
                                            <p class="mb-0" id="item-total-{{ $id }}">{{ number_format($itemTotal, 2) }} DT</p>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="1" class="text-end"><strong>Subtotal</strong></td>
                                    <td>{{ number_format($cartTotal, 2) }} DT</td> <!-- Subtotal display -->
                                </tr>
                                <tr>
                                    <td colspan="1" class="text-end"><strong>TOTAL</strong></td>
                                    <td>{{ number_format($cartTotal, 2) }} DT</td> <!-- Total display -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary py-3 px-5 mt-4">Place Order</button>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->

@endsection
