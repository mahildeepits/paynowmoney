@extends('admin.layouts.admin')
@section('title', 'Admin - Selection Products')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Selection Products</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Add New Selection Product</h4>
                        <form action="{{ route('admin.selection_products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name">Product Name*</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Product Image*</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Selection Products List</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered static-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: auto; border-radius: 5px;">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.selection_products.delete', $product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
