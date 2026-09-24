@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel | Loan Masters')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Loan Masters</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <a href="{{ route('admin.loan_types.create') }}" class="btn btn-primary float-right">Add New Loan</a>
                        <h4 class="card-title">All Loan Types</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped static-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Req. Directs</th>
                                    <th>Loan Amount</th>
                                    <th>EMI Amount</th>
                                    <th>Total EMIs</th>
                                    <th>Payable Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loanTypes as $key => $loanType)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $loanType->name }}</td>
                                        <td>{{ $loanType->required_direct_users }}</td>
                                        <td>₹{{ number_format($loanType->loan_amount, 2) }}</td>
                                        <td>₹{{ number_format($loanType->emi_amount, 2) }}</td>
                                        <td>{{ $loanType->total_emis }}</td>
                                        <td>₹{{ number_format($loanType->payable_amount, 2) }}</td>
                                        <td>
                                            @if($loanType->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.loan_types.edit', $loanType->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('admin.loan_types.destroy', $loanType->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this loan type?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
@endsection
