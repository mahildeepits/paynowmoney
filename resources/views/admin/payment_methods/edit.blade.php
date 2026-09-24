@extends('admin.layouts.admin')

@section('content')
<div id="main-wrapper">
    <div class="content-header">
        <h1 class="page-title">Edit Payment Method</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <form action="{{ route('admin.payment-methods.update', $method->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Type (e.g. Bank, UPI, QR)</label>
                        <input type="text" name="type" class="form-control" value="{{ $method->type }}" required>
                    </div>
                    <div class="form-group">
                        <label>Details</label>
                        <textarea name="details" class="form-control" rows="4">{{ $method->details }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>QR Image (Optional)</label>
                        <input type="file" name="qr_image" class="form-control">
                        @if($method->qr_image)
                            <img src="{{ asset('storage/payment_qrs/' . $method->qr_image) }}" width="100" class="mt-2">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" {{ $method->is_active ? 'checked' : '' }}> Active
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
