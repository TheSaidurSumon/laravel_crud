@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h2 class="mb-0 text-center">{{ $product->name }}</h2>
        </div>
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm" style="height: 300px;width:500px">
                </div>
                <div class="col-md-6">
                    <p class="mb-3"><strong class="text-muted">Product ID:</strong> <span class="text-primary">{{ $product->product_id }}</span></p>
                    <p class="mb-3"><strong class="text-muted">Price:</strong> <span class="text-success">$ {{ number_format($product->price, 2) }}</span></p>
                    <p class="mb-3"><strong class="text-muted">Description:</strong></p>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg rounded-pill">Back to Products</a>
        </div>
    </div>
</div>
@endsection
