@extends('admin.layouts.admin')
@section('title','Admin Panel | Create FD Plan')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Create Fixed Deposit Plan</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.fds.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Plan Name</label>
                                    <input type="text" name="name" class="form-control" required placeholder="e.g., Secure Plus 66">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <hr>
                            <h5>Plan Options</h5>
                            <table class="table table-bordered" id="options_table">
                                <thead>
                                    <tr>
                                        <th>Investment Amount</th>
                                        <th>Duration (Months)</th>
                                        <th>Return Percentage (%)</th>
                                        <th><button type="button" class="btn btn-sm btn-success" id="add_row">+</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" step="0.01" name="amount[]" class="form-control" required placeholder="5000"></td>
                                        <td><input type="number" name="months[]" class="form-control" required value="66"></td>
                                        <td><input type="number" step="0.01" name="return_percentage[]" class="form-control" required placeholder="10"></td>
                                        <td><button type="button" class="btn btn-sm btn-danger remove_row">X</button></td>
                                    </tr>
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary mt-3">Save Plan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.getElementById('add_row').addEventListener('click', function() {
        let tbody = document.querySelector('#options_table tbody');
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="number" step="0.01" name="amount[]" class="form-control" required></td>
            <td><input type="number" name="months[]" class="form-control" required value="66"></td>
            <td><input type="number" step="0.01" name="return_percentage[]" class="form-control" required></td>
            <td><button type="button" class="btn btn-sm btn-danger remove_row">X</button></td>
        `;
        tbody.appendChild(tr);
    });
    
    document.querySelector('#options_table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove_row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
