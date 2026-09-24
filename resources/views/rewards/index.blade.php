@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Record</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Rewards</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <!--end breadcrumb-->
        @if($rewards->isEmpty())
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>No reward archived yet!</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(!$rewards->isEmpty())
            @php
                $latestReward = $rewards->last()->reward;
            @endphp
            <div class="card">
                <div class="card-body reward-bg">
                    <div class="row">
                        <div class="col-md-12 text-center pt-5">
                            <h2>Reward Achievement</h2>
                            <p>Hurry! You have Achieved the {{ $latestReward->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{ asset('rewards/'.$latestReward->image) }}" class="reward-image" style="width: 500px" alt="logo icon">
                            <h6 class="mt-3">{{ $latestReward->name }}</h6>
                            <h4>Current Rank: {{ $latestReward->rank }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5>Previously Achieved Rewards</h5>
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Rank</th>
                                        <th>Achieved at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rewards as $key => $reward)
                                        @if($latestReward->id != $reward->reward_id)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td><img src="{{ asset('rewards/'.$reward->reward->image) }}" style="width: 80px; border-radius: 8px;" /> </td>
                                                <td>{{ $reward->reward->name }}</td>
                                                <td>{{ $reward->reward->rank }}</td>
                                                <td>{{ $reward->created_at->format('d M, Y') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('css')
    @parent
    <style>
        .reward-bg{
            background: url("../images/reward-bg.png") no-repeat;
            background-size: cover;
            height: 700px;
        }
        .reward-image{
            border-radius: 8px;
            box-shadow: 3px 3px 12px 8px #d3d3d3;
        }
    </style>
@endsection
@section('scripts')
    @parent

@endsection
