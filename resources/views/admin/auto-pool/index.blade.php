@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <style>
        .over-flow-scroll{
            overflow-x: scroll;
        }
    </style>
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Autopool List</h1>
            <a href="{{route('auto-pool.create')}}" class="float-end btn btn-primary btn-sm"> Create Autopool</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-nowrap">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    {!! $dataTable->scripts() !!}
    <script>
        const autopoolDataTable = $('#autopool-table');
        $(document).ready(function(){
            autopoolDataTable.parent().addClass('over-flow-scroll');
        });
    </script>
@endsection
