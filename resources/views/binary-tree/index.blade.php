@extends('layout.main')
@section('content')
    <style>
        .add-member-form{
            width: 50%;
            margin: 0 auto;
        }
        .custom-input{
            height: 30px;
            font-size: 13px;
        }
        .btn-green{
            background-color: #0f761cc7;
            color: white;
        }
    </style>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tree</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Tree</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <img src="{{ asset('images/btree.png') }}" width="20" />
                        <b>Left Count: {{ auth()->guard('member')->user()->left_count }}</b>
                    </li>
                    <li class="list-inline-item">
                        <img src="{{ asset('images/btree.png') }}" width="20" />
                        <b>Right Count: {{ auth()->guard('member')->user()->right_count }}</b>
                    </li>
                </ul>
            </div> --}}
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                {!! Form::hidden('tree_number',request()->number) !!}
                <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('search','Search') !!}
                        {!! Form::text('search',null,['class'=>'form-control custom-input userId']) !!}
                    </div>
                    <div class="col-md-2 mt-4">
                        <a href="javascript:void(0)" class="btn btn-green custom-input view-id">View ID</a>
                    </div>
                    @if (auth()->guard('member')->user()->userRole->for_admin)
                        <div class="col-md-8">
                            <a href="{{route('register')}}" class="btn btn-green custom-input btn-sm float-end" >Add Member</a>
                        </div>
                    @endif
                </div>
                <div id="tree">
                    {{-- @include('binary-tree.treeNew') --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            getTree(`{{auth()->guard('member')->user()->member_id }}`);
            $('.view-id').click(function(){
                var userid = $('.userId').val().trim();
                if(userid === ''){
                    alert('Please enter user id');
                }else{
                    getTree(userid);
                }
            });
        });
    </script>
@endsection
