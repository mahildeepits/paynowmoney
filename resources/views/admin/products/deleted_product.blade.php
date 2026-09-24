@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Deleted Product</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered static-datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>quantity</th>
                                            <th>sizes</th>
                                            <th width="160">Created At</th>
                                            <th width="160">Deleted_At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deleted_lists as $key => $deleted_list)
                                            <tr>
                                                <td>{{ $deleted_list->id}}</td>
                                                <td>{{$deleted_list->name}}</td>
                                                <td>{{$deleted_list->price}}</td>
                                                <td>{{$deleted_list->description}}</td>
                                                <td>{{$deleted_list->quantity}}</td>
                                                <td>{{ $deleted_list->sizes }}</td>
                                                <td>{{ $deleted_list->created_at->format('d-m-Y') }}</td>
                                                <td>{{$deleted_list->deleted_at->format('d-m-Y')}}</td>
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

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#category_list').on('change',function(){
                        $value=$(this).val();
            });
        });
    </script>
@endsection















