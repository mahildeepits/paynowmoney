@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel | Add Loan Type')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Add Loan Type</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.loan_types.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Loan Name</label>
                                    <input type="text" name="name" class="form-control" required placeholder="e.g. Level 1 Loan">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="required_direct_users">Required Active Direct Users</label>
                                    <input type="number" name="required_direct_users" class="form-control" required min="0" placeholder="e.g. 5">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="loan_amount">Loan Amount (₹)</label>
                                    <input type="number" step="0.01" name="loan_amount" class="form-control" required min="0">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="emi_amount">EMI Amount (₹)</label>
                                    <input type="number" step="0.01" name="emi_amount" class="form-control" required min="0">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="total_emis">Total EMIs</label>
                                    <input type="number" name="total_emis" class="form-control" required min="1">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                                        <label class="custom-control-label" for="status">Active (Visible to Users)</label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('admin.loan_types.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Loan Type</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
