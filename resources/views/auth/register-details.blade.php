@extends('layout.auth')

@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{ asset('images/54.png') }}" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Registration Details</h3>
                                        <p>Welcome to {{ config('app.name') }}</p>
                                    </div>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 text-left">
                                                <table class="table table-striped">
                                                    <tbody>
                                                    <tr>
                                                        <th width="200">User ID</th>
                                                        <td>{{ @$tempArray['user_id'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Password</th>
                                                        <td>{{ @$tempArray['password'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email ID</th>
                                                        <td>{{ @$tempArray['email'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sponsor</th>
                                                        <td>{{ @$tempArray['sponsor'] }} ({{ @$tempArray['sponsor_name'] }})</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <a href="{{ route('login') }}" class="btn btn-success">Login Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
