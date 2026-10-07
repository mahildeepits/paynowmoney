@extends('admin.layouts.admin')
@section('title','Edit Showcase Product')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Edit Showcase Product</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.showcase-products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="mrp">MRP <span class="text-danger">*</span></label>
                                    <input type="number" name="mrp" id="mrp" class="form-control" value="{{ old('mrp', $product->mrp) }}" step="0.01" min="0" required>
                                    @error('mrp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small class="text-muted">Leave blank if you do not want to change the image.</small>
                                    @if($product->image)
                                        <div class="mt-2">
                                            <img src="{{ $product->image_url }}" width="100" alt="Current Image">
                                        </div>
                                    @endif
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="status">Status</label>
                                    <div>
                                        <label class="switch">
                                            <input type="checkbox" name="status" id="status" value="1" {{ $product->status ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <span class="ml-2">Active</span>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                                <a href="{{ route('admin.showcase-products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
