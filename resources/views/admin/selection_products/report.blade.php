@extends('admin.layouts.admin')
@section('title', 'Admin - Products Report')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Products Report</h1>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.selection_products.report') }}" method="GET">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="product_id">Filter by Product</label>
                                    <select name="product_id" class="form-control">
                                        <option value="">All Products</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.selection_products.report') }}" class="btn btn-secondary">Reset</a>
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
                        <h4>Users Product Selection Report</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered static-datatable">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Member ID</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Selection Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->member_id }}</td>
                                            <td>{{ $user->selectionProduct->name ?? 'N/A' }}</td>
                                            <td>
                                                @if($user->selectionProduct)
                                                    <img src="{{ asset($user->selectionProduct->image) }}" alt="" style="width: 60px; height: auto; border-radius: 5px;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $user->updated_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
