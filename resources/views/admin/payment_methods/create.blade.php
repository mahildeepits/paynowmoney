@extends('admin.layouts.admin')

@section('content')
<div id="main-wrapper">
    <div class="content-header">
        <h1 class="page-title">Add Payment Method</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Type (e.g. Bank, UPI, QR)</label>
                        <input type="text" name="type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Details</label>
                        <textarea name="details" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>QR Image (Optional)</label>
                        <input type="file" name="qr_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" checked> Active
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
