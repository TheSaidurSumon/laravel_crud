@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h2 class="mb-0 text-center">Add New Product</h2>
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

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control form-control-lg" id="price" value="{{ old('price') }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control form-control-lg" id="description" rows="4" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control form-control-lg" id="image">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
