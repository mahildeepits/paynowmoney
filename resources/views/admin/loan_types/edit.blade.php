@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel | Edit Loan Type')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Edit Loan Type</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.loan_types.update', $loanType->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Loan Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $loanType->name }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="required_direct_users">Required Active Direct Users</label>
                                    <input type="number" name="required_direct_users" class="form-control" value="{{ $loanType->required_direct_users }}" required min="0">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="loan_amount">Loan Amount (₹)</label>
                                    <input type="number" step="0.01" name="loan_amount" class="form-control" value="{{ $loanType->loan_amount }}" required min="0">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="emi_amount">EMI Amount (₹)</label>
                                    <input type="number" step="0.01" name="emi_amount" class="form-control" value="{{ $loanType->emi_amount }}" required min="0">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="total_emis">Total EMIs</label>
                                    <input type="number" name="total_emis" class="form-control" value="{{ $loanType->total_emis }}" required min="1">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" {{ $loanType->status == 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Active (Visible to Users)</label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('admin.loan_types.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Loan Type</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
