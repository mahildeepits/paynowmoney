@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-sm">
                <div class="card colorfull-bg">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h4 class=""> <span id="ctl00_ContentPlaceHolder1_inc_ctl00_lbl8" class="currency">
                                        {{ \App\Models\User::where(\DB::raw('date(created_at)'),\Carbon\Carbon::now()->format('Y-m-d'))->count() }}
                                    </span>
                                </h4>
                                <span class=""><span id="ctl00_ContentPlaceHolder1_inc_ctl00_Label1">Joinings Today</span></span>
                            </div>
                            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                <i class="fas fa-globe  font-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm">
                <div class="card colorfull-bg">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h4 class=""> <span id="ctl00_ContentPlaceHolder1_inc_ctl00_lbl8" class="currency">
                                        {{ \App\Models\User::where('user_icon','golden.png')->count() }}
                                    </span>
                                </h4>
                                <span class=""><span id="ctl00_ContentPlaceHolder1_inc_ctl00_Label1">Total Golden</span></span>
                            </div>
                            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                <i class="fas fa-globe  font-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-sm">
                <div class="card colorfull-bg">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h4 class=""> <span id="ctl00_ContentPlaceHolder1_inc_ctl00_lbl8" class="currency">
                                        {{ \App\Models\User::where('role',2)->count() }}
                                    </span>
                                </h4>
                                <span class=""><span id="ctl00_ContentPlaceHolder1_inc_ctl00_Label1">Today Payout</span></span>
                            </div>
                            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                <i class="fas fa-globe  font-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md offset-2 offset-sm-0">
                <div class="card colorfull-bg">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h4 class=""> <span id="ctl00_ContentPlaceHolder1_inc_ctl00_lbl8" class="currency">
                                        {{ \App\Models\Epin::whereNull('transfer_to')->whereNull('used_by')->count() }}
                                    </span>
                                </h4>
                                <span class=""><span id="ctl00_ContentPlaceHolder1_inc_ctl00_Label1">Available Pins</span></span>
                            </div>
                            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                <i class="fas fa-globe  font-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-sm">
                <div class="card colorfull-bg">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body text-left">
                                <h4 class=""> <span id="ctl00_ContentPlaceHolder1_inc_ctl00_lbl8" class="currency">
                                        {{ \App\Models\Epin::whereNull('transfer_from')->whereNotNull('transfer_to')->count() }}
                                    </span>
                                </h4>
                                <span class=""><span id="ctl00_ContentPlaceHolder1_inc_ctl00_Label1">Transferred Pins</span></span>
                            </div>
                            <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                <i class="fas fa-globe  font-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div><!-- Main Wrapper -->
@endsection
