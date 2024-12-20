@extends('Front.frontIndex')
@section('frontSection')

<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5" style="margin: 80px; padding: 10px;">>
    <h1 class="mb-4">Fresh fruits shop</h1>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="row g-4">
                <div class="col-xl-3">
                   
                </div>
                <div class="col-6"></div>
                <div class="col-xl-3">

                </div>
            </div>
            <div class="row g-4">
                <div style="width: 300px;">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    @foreach($categories as $categorie)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            @if($categorie->produits_count > 0)
                                            <a href="{{ route('produits.indexFront', ['category_id' => $categorie->id]) }}"
                                                @if(request('category_id')==$categorie->id)
                                                style="color: orange; font-weight: bold;"
                                                @endif>
                                                <i class="fas fa-lemon me-2"></i>{{ $categorie->nom }}
                                                <span>({{ $categorie->produits_count }})</span>
                                            </a>
                                            @else
                                            <span class="text-muted">
                                                <i class="fas fa-lemon me-2"></i>{{ $categorie->nom }}
                                                <span>({{ $categorie->produits_count }})</span>

                                            </span>
                                            @endif
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <h4 class="mb-2">Price</h4>
                                <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="{{ request('max_price', 500) }}" oninput="updatePriceFilter()">
                                <output id="amount" name="amount" for="rangeInput">{{ request('max_price', 500) }}</output> DT
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-9">


                    <div class="row g-4 justify-content-center">
                        <!-- Affiche le message si aucun produit n'est disponible -->
                        @if($produits->isEmpty())
                        <div class="col-12 text-center">
                            <p class="text-muted fs-4">Aucun produit n'est disponible pour cette prix !</p>
                            <i class="fas fa-frown"></i>

                        </div>
                        @else
                        @foreach($produits as $produit)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="rounded position-relative fruite-item" style="height: 450px; overflow: hidden;">
                                <div class="fruite-img">
                                    <img src="{{ $produit->image ? asset($produit->image) : asset('img/default-image.jpg') }}" class="img-fluid w-100 rounded-top" alt="{{ $produit->nom }}" style="height: 250px; object-fit: cover;">
                                </div>

                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                    <td>
                                        @if ($produit->categorie)
                                        {{ $produit->categorie->nom }}
                                        @else
                                        <span class="text-muted">No Category</span>
                                        @endif
                                    </td>
                                </div>

                                <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column justify-content-between" style="height: 200px; overflow: hidden;">
                                    <div>
                                        <h4>{{ $produit->nom }}</h4>
                                        <p style="flex-grow: 1;">{{ $produit->description }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-dark fs-5 fw-bold mb-0">{{ $produit->prix }} DT / {{ $produit->quantite }}&nbsp;&nbsp;&nbsp;<i class="fas fa-box"></i></p>
                                            <a
                                                href="#"
                                                class="btn border border-secondary rounded-pill px-3 text-primary {{ $produit->quantite == 0 ? 'disabled' : '' }} add-to-cart"
                                                data-id="{{ $produit->id }}"
                                            >
                                                <i
                                                    class="fa fa-shopping-bag me-2 text-primary"
                                                ></i>
                                                Add to cart
                                            </a>
                                            </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-12">
                            @include('vendor.pagination.custom-pagination', ['paginator' => $produits])
                        </div>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Fruits Shop End-->
<script>
     function updatePriceFilter() {
        const price = document.getElementById('rangeInput').value;
        window.location.href = `?max_price=${price}`;
    }

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const productId = this.getAttribute('data-id');
        const quantity = 1;  

        fetch('/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity }),
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: data.message,
                text: "Do you want to add more products or go to the cart?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Go to Cart',
                cancelButtonText: 'Continue Shopping'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/cart'; 
                }
 
            });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Could not add product to cart.',
                icon: 'error'
            });
        });
    });
});
</script>

@endsection