@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Network</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Levels</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5>All Levels</h5>
                    </div>
                    @for ($i=1; $i <= 10 ; $i++)
                        @if ($i <= 10)
                            @php
                                if($i > 1){
                                    $loopChilds = getSponsoredChilds($loopChilds->pluck('member_id')->toArray());
                                }else{
                                    $loopChilds = $childs;
                                }
                            @endphp
                            @if ($loopChilds->count() > 0)
                                <div class="col-md-12 mt-3">
                                    <h4>Level {{$i}}</h4>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>UserID</th>
                                                <th>Is Paid</th>
                                                {{-- <th>Position</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($loopChilds as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->member_id }}</td>
                                                    <td>
                                                        @if ($user->is_paid)
                                                            <span class="bg-success text-white px-3 py-1 rounded">Yes</span>
                                                        @else
                                                            <span class="bg-danger text-white px-3 py-1 rounded">No</span>
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ ucfirst($user->parent_leg) }}</td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    @parent
    <style type="text/css">

    </style>
@endsection
@section('scripts')
    @parent
@endsection
