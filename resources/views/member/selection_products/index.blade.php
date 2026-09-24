@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-4">My Product Selection</h3>
            </div>
        </div>


        @if($selectedProduct)
            <!-- Display Selected Product -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card radius-10 shadow-lg border-top border-0 border-4 border-primary">
                        <div class="card-body text-center p-5">
                            <h2 class="mb-4 text-primary font-weight-bold">Your Selected Product</h2>
                            <div class="product-display mb-4">
                                <img src="{{ asset($selectedProduct->image) }}" alt="{{ $selectedProduct->name }}" 
                                     class="img-fluid rounded shadow" style="max-height: 400px; width: auto; transition: transform 0.3s ease;">
                            </div>
                            <h3 class="mt-3 text-dark">{{ $selectedProduct->name }}</h3>
                            <div class="mt-4">
                                <span class="badge bg-success px-4 py-2 fs-6">Selection Confirmed</span>
                            </div>
                            <p class="text-muted mt-3 italic small">Note: You cannot change your selection once confirmed.</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Selection Grid -->
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <p class="text-secondary fs-5">Please select any one product from the list below. This choice is permanent.</p>
                </div>
            </div>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        <div class="card h-100 radius-10 shadow-sm hover-shadow transition-all">
                            <div class="product-img-wrapper text-center p-3" style="background: #f8f9fa;">
                                <img src="{{ asset($product->image) }}" class="card-img-top rounded" alt="{{ $product->name }}" 
                                     style="height: 200px; object-fit: contain;">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark mb-3">{{ $product->name }}</h5>
                                <form action="{{ route('member.select_product') }}" method="POST" class="select-product-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary w-100 py-2 radius-10 select-btn" 
                                            data-name="{{ $product->name }}">
                                        Select This Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-info">No products available for selection yet. Please check back later.</div>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
@endsection

@section('css')
<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .product-display img:hover {
        transform: scale(1.02);
    }
    .select-btn {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select-product-form').on('submit', function(e) {
            e.preventDefault();
            var productName = $(this).find('.select-btn').data('name');
            
            if (confirm('Are you sure you want to select "' + productName + '"? This action cannot be undone!')) {
                this.submit();
            }
        });
    });
</script>
@endsection
