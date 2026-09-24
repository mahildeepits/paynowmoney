@extends('admin.layouts.admin')
@section('title','MLM Software - Welcome Letter')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Welcome Letter</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open() !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>User welcome letter</h5>
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('member_id','Member ID') !!}
                                    {!! Form::text('member_id',request()->member_id,['class'=>'form-control']) !!}
                                </div>
                                <div class="col-md-4 pt-4">
                                    {!! Form::submit('View Welcome Letter',['class'=>'btn btn-primary mt-3']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        @if($user != null)
                            <div class="row" id="printArea">
                                <div class="col-md-12 welcome-letter-bg">
                                    <div class="row welcome-letter-content">
                                        <div class="col-md-7 offset-2 letter-layout">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <table class="table-borderless full-width mt-1">
                                                        <tr>
                                                            <th width="150px">Customer ID</th>
                                                            <td>:</td>
                                                            <td>{{ $user->member_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>:</td>
                                                            <td>{{ $user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>:</td>
                                                            <td>{{ $user->profile_rel->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>City</th>
                                                            <td>:</td>
                                                            <td>{{ $user->profile_rel->city }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mobile</th>
                                                            <td>:</td>
                                                            <td>$user->mobile</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Joining Amount</th>
                                                            <td>:</td>
                                                            <td>{{ $user->used_pin_rel->joining_kit_rel->amount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Date of Joining</th>
                                                            <td>:</td>
                                                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-5 text-right pt-2">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" class="mt-1" width="150" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 offset-2 pl-4 mt-3">
                                            <h3 class="ml-3 text-danger">Dear Rahul Sharma</h3>
                                            <p class="ml-3">Congratulations on Your Decision with Us!</p>
                                            <p class="ml-3 text-justify" style="font-size: 14px; line-height: 25px;">You are now a part of the opportunity of the millennium.Company is an exciting "People Business". A business that has the potential to turn your dreams into reality. As you build your business, you will establish lifelong friendships and develop support systems unparalleled in any other business. Everyone(at) Company Name is here to H.E.L.P.(High Energy Level Participation) you thrive to Prosperity. We pledge our best efforts to provide the levels of continuing support necessary to ensure that your business is a total success. You are in this business for yourself, not by yourself. We have developed an effective and proven progress plan to help you launch a profitable business of your own. With YOU in control, you determine your own level of commitment in order to adapt and benefit your lifestyle and personal goals. We are confident that you will receive gratification from your involvement with Company Name and we wish you every Success! Please note we are providing you an opportunity to earn money which is optional,your earnings will depend directly in the amount of efforts you put to develop your business etc.</p>
                                        </div>
                                        <div class="col-md-7 offset-2 pl-4">
                                            <h3 class="ml-3">THE DESK OF THE DIRECTORS</h3>
                                            <h5 class="ml-3 text-danger">Minimartgrocery</h5>
                                            <h5 class="ml-3 text-danger">http://www.Minimartgrocery.com</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="javascript:void(0)" class="btn btn-danger btn-lg" onclick="printDiv('printArea')">Print Now</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
