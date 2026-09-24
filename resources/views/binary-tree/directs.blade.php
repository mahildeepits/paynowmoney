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
                        <li class="breadcrumb-item active" aria-current="page">Directs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5>My Directs</h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>UserID</th>
                                    <th>Is Paid ?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($directs as $key => $user)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->member_id }}</td>
                                        <td>
                                            @if ($user->is_paid)
                                                <span class="bg-success text-white px-3 py-1 rounded">Yes</span>
                                            @else
                                                <span class="bg-danger text-white px-3 py-1 rounded">No</span>
                                            @endif
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
@section('css')
    @parent
    <style type="text/css">

    </style>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        f
    </script>
@endsection
