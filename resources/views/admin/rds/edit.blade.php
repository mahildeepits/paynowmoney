@extends('admin.layouts.admin')
@section('title', 'Edit RD Master')
@section('content')
<div id="main-wrapper">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit RD Master: {{ $rd->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.rds.update', $rd->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>RD Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $rd->name }}" required placeholder="Enter RD Name">
                        </div>
                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $rd->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $rd->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <hr>
                    <h5>RD Details Configurations</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamicTable">
                            <thead>
                                <tr>
                                    <th>EMI/Deposit Amount (Monthly)</th>
                                    <th>Months (Count)</th>
                                    <th>Total Return Percentage (%)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rd->details as $index => $detail)
                                <tr id="row{{ $index }}">
                                    <td><input type="number" step="0.01" name="emi_amount[]" value="{{ $detail->emi_amount }}" placeholder="Enter EMI Amount" class="form-control" required /></td>
                                    <td><input type="number" name="months[]" value="{{ $detail->months }}" placeholder="Enter Months" class="form-control" required /></td>
                                    <td><input type="number" step="0.01" name="return_percentage[]" value="{{ $detail->return_percentage }}" placeholder="Enter Return %" class="form-control" required /></td>
                                    <td>
                                        @if($index == 0)
                                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                        @else
                                            <button type="button" name="remove" id="{{ $index }}" class="btn btn-danger btn_remove">X</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Update RD Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    @parent
<script>
    $(document).ready(function(){
        var i = {{ count($rd->details) }};
        $('#add').click(function(){
            i++;
            $('#dynamicTable').append('<tr id="row'+i+'"><td><input type="number" step="0.01" name="emi_amount[]" placeholder="Enter EMI Amount" class="form-control" required /></td><td><input type="number" name="months[]" placeholder="Enter Months" class="form-control" required /></td><td><input type="number" step="0.01" name="return_percentage[]" placeholder="Enter Return %" class="form-control" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
        });
    });
</script>
@endsection
