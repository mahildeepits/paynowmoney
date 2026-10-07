@extends('admin.layouts.admin')
@section('title','Showcase Products')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Showcase Products</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <h4>View Showcase Products</h4>
                                <a href="{{ route('admin.showcase-products.create') }}" class="btn btn-primary">Add New Product</a>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <table class="table table-striped table-bordered static-datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>MRP</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key => $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($product->image)
                                                        <img src="{{ $product->image_url }}" width="80" alt="{{ $product->name }}" />
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>₹{{ number_format($product->mrp, 2) }}</td>
                                                <td>
                                                    @if($product->status)
                                                        <span class="badge badge-success" style="background-color: green">Active</span>
                                                    @else
                                                        <span class="badge badge-danger" style="background-color: red">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.showcase-products.edit', $product->id) }}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Edit</a>
                                                    <form action="{{ route('admin.showcase-products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
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
    </div><!-- Main Wrapper -->
@endsection
