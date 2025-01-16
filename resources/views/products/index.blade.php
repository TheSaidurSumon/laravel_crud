@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h2 class="mb-0 text-center">Product Management</h2>
        </div>
        <div class="card-body p-5">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Search and Sort Form -->
            <form method="GET" action="{{ route('products.index') }}" class="mb-5">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Search by ID, name, price, or description" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <select name="sort_by" class="form-select form-select-lg">
                            <option value="">Sort By</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select name="sort_direction" class="form-select form-select-lg">
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg w-100">Apply</button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button  type="submit" class="btn btn-dark btn-lg w-100"><a style="text-decoration:none;color:#fff" href="http://127.0.0.1:8000/products/create">Add New Product</a></button>
                    </div>
                </div>
            </form>

            <!-- Product Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                <td>{{ $product->product_id }}</td>
                                <td><img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="80" height="80" class="rounded"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm ">View</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm ">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
