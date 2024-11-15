@extends('Front.frontIndex')
@section('frontSection')

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>
        <form id="checkoutForm" action="{{ route('order.store') }}" method="POST">
            @csrf  
            <div class="row g-5">
                <div class="col-md-12 col-lg-6">
                    <div class="form-item">
                        <label class="form-label my-3">Address<sup>*</sup></label>
                        <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control" placeholder="House Number and Street Name" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Phone Number<sup>*</sup></label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
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
                                    $cartTotal = 0;  
                                @endphp

                                @foreach(session('cart', []) as $id => $item)  
                                    <tr>
                                        <td>
                                            <img src="{{ isset($item['image']) ? asset($item['image']) : asset('img/default-image.jpg') }}" class="img-fluid rounded-circle" style="width: 80px; height: 80px;" alt="{{ isset($item['name']) ? $item['name'] : 'Product' }}">
                                            <p class="mb-0">{{ isset($item['name']) ? $item['name'] : 'Unknown' }}</p>
                                        </td>
                                        <td>
                                            @php
                                                $itemTotal = (isset($item['total_price']) && isset($item['quantite'])) ? $item['total_price'] : 0;
                                                $cartTotal  = $itemTotal + 7; // Add item total to cart total
                                            @endphp
                                            <p class="mb-0" id="item-total-{{ $id }}">{{ number_format($itemTotal, 2) }} DT</p>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="1" class="text-end"><strong>Subtotal</strong></td>
                                    <td>{{ number_format($cartTotal, 2) }} DT</td>  
                                </tr>
                                <tr>
                                    <td colspan="1" class="text-end"><strong>TOTAL</strong></td>
                                    <td>{{ number_format($cartTotal, 2) }} DT</td>  
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

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Please enter valid address and phone number.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            
            const phone = document.getElementById('phone').value.trim();
            const address = document.getElementById('adresse_livraison').value.trim();

       
            const phonePattern = /^[0-9]{8}$/;
            const addressPattern = /^.{5,}$/; 
            if (!phonePattern.test(phone) || !addressPattern.test(address)) {
                event.preventDefault(); 

                const toastElement = document.getElementById('errorToast');
                const bootstrapToast = new bootstrap.Toast(toastElement);
                bootstrapToast.show();
            }
        });
    });
</script>

@endsection