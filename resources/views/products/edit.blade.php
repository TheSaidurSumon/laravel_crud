@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h2 class="mb-0 text-center">Edit Product</h2>
        </div>
        <div class="card-body p-5">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name" value="{{ $product->name }}" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control form-control-lg" id="price" value="{{ $product->price }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control form-control-lg" id="description" rows="4" required>{{ $product->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control form-control-lg" id="image">
                    @if($product->image)
                        <small class="d-block mt-2">Current Image: <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" width="150"></small>
                    @endif
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-4">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
