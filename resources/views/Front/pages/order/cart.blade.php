@extends('Front.frontIndex')

@section('frontSection')

<div class="container-fluid py-1"> <br><br><br><br><br>
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @php $cartTotal = 0; @endphp <!-- Initialize cart total -->
                @foreach(session('cart', []) as $id => $item) <!-- Use $id as the key -->
                    <tr>
                        <td>
                            <img src="{{ isset($item['image']) ? asset($item['image']) : asset('img/default-image.jpg') }}" class="img-fluid rounded-circle" style="width: 80px; height: 80px;" alt="{{ isset($item['name']) ? $item['name'] : 'Product' }}">
                        </td>
                        <td>
                            <p class="mb-0">{{ isset($item['name']) ? $item['name'] : 'Unknown' }}</p>
                        </td>
                        <td>
                            <p class="mb-0">{{ isset($item['prix']) ? number_format($item['prix'], 2) : 'N/A' }} DT</p>
                        </td>
                     <td>
                     
    <div class="input-group quantity" style="width: 100px;">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" onclick="updateQuantity('{{ $id }}', {{ isset($item['quantite']) ? $item['quantite'] - 1 : 0 }})">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="number" class="form-control form-control-sm text-center border" value="{{ isset($item['quantite']) ? $item['quantite'] : 0 }}" min="1" id="quantity-{{ $id }}" onchange="updateQuantity('{{ $id }}', this.value)">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" onclick="updateQuantity('{{ $id }}', {{ isset($item['quantite']) ? $item['quantite'] + 1 : 1 }})">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</td>

 
<td>
    @php
        $itemTotal = (isset($item['total_price']) && isset($item['quantite'])) ? $item['total_price'] : 0;
        $cartTotal += $itemTotal;  
    @endphp
    <p class="mb-0" id="item-total-{{ $id }}">{{ number_format($itemTotal, 2) }} DT</p>
</td>

                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST"> <!-- Use $id here -->
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <div class="input-group mb-3">
                <input type="text" class="form-control border-0" placeholder="Coupon Code" aria-label="Coupon Code">
                <button class="btn btn-secondary" type="button">Apply Coupon</button>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="bg-light rounded p-4">
                    <h2 class="mb-4">Cart Total</h2>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal:</span>
                        <span id="cart-subtotal">DT{{ number_format($cartTotal, 2) }}</span> <!-- Display subtotal -->
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping:</span>
                        <span>Flat rate: DT 7.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 border-top pt-3">
                        <h5>Total:</h5>
                        <h5 id="cart-total">DT{{ number_format($cartTotal + 7.00, 2) }}</h5>
                    </div>
                    <button class="btn btn-primary w-100 text-uppercase" type="button">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
<script>
function updateQuantity(productId, quantity) {
    // Make an AJAX call to update the quantity
    fetch(`/cart/update-quantity/${productId}`, { // Use the productId in the URL
        method: 'PATCH', // Change to PATCH
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF token is sent
        },
        body: JSON.stringify({ quantity: quantity }) // Send only quantity
    })
    .then(response => response.json())
    .then(data => {
        if (data.cart) {
            // Update the total price in the UI
            const itemTotal = data.cart[productId].total_price; // Get the total price from the updated cart
            document.getElementById('item-total-' + productId).innerText = itemTotal.toFixed(2) + ' $';

            // Calculate and update grand total
            const grandTotal = Object.values(data.cart).reduce((sum, item) => sum + item.total_price, 0);
            document.getElementById('grand-total').innerText = grandTotal.toFixed(2) + ' $';
        }
    })
    .catch(error => {
        console.error('Error updating quantity:', error);
    });
}


function updateCartView(cart, subtotal, itemId, itemTotal) {
    // Update individual item total
    document.getElementById(`item-total-${itemId}`).innerText = parseFloat(itemTotal).toFixed(2) + ' $'; // Update the specific item's total

    // Update subtotal
    document.getElementById('cart-subtotal').innerText = parseFloat(subtotal).toFixed(2) + ' $'; // Update subtotal
    document.getElementById('cart-total').innerText = parseFloat(subtotal + 3.00).toFixed(2) + ' $'; // Update total (including shipping)
}
</script>

@endsection
