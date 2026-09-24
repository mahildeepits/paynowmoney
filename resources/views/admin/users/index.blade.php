@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    @if(request()->has('kyc_details'))
        <div class="modal fade" id="kyc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">KYC Details</h5>
                        <button type="button" onclick="window.location.href='{{ route('admin.users') }}'" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($kycDetails != null)
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>KYC Type</label>
                                    @switch($kycDetails->kyc_type)
                                        @case('1')
                                            <h6>Adhaar Card</h6>
                                        @break
                                        @case('2')
                                            <h6>Voter ID</h6>
                                        @break
                                        @case('3')
                                            <h6>Driving License</h6>
                                        @break
                                    @endswitch
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Detail</label>
                                    <h6>{{ $kycDetails->card_no }}</h6>
                                </div>
                                @if($kycDetails->card_front != '')
                                    <div class="col-md-6 form-group">
                                        <label>Card Front</label>
                                        <img src="{{ asset('images/kyc_docs/'.$kycDetails->card_front) }}" width="150" />
                                    </div>
                                @endif
                                @if($kycDetails->card_back != '')
                                    <div class="col-md-6 form-group">
                                        <label>Card Front</label>
                                        <img src="{{ asset('images/kyc_docs/'.$kycDetails->card_back) }}" width="150s" />
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <i>No details found</i>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($kycDetails != null)
                        <div class="modal-footer">
                            <a href="{{ route('admin.edit.kyc',['user_id'=>$kycDetails->user_id]) }}" class="btn btn-info">Edit Details</a>
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Close</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Users</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped static-datatable-users">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Sponsor</th>
                                    <th>Used Pin</th>
                                    <th>Mobile</th>
                                    <th width="200">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->member_id }}</td>
                                        <td title="{{ \Illuminate\Support\Facades\Crypt::decrypt($user->enc_password) }}">{{ \Illuminate\Support\Facades\Crypt::decrypt($user->enc_password) }}</td>
                                        <td>{{ $user->sponsor_id }}</td>
                                        <td>{{ $user->epin }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>
                                            <a target="_blank" href="{{ route('admin.edit.user',['member_id'=>$user->member_id]) }}" class="btn btn-info btn-xs">Edit</a>
                                            <a href="{{ route('admin.users',['kyc_details'=>$user->id]) }}" class="btn btn-danger btn-xs">KYC</a>
                                            <button class="btn btn-primary btn-xs view-emis-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}">Installments</button>
                                            @if($user->is_blocked)
                                                <a href="{{ route('admin.users',['unblock_user'=>$user->id]) }}" class="btn btn-danger btn-xs">Un-Block</a>
                                            @else
                                                <a href="{{ route('admin.users',['block_user'=>$user->id]) }}" class="btn btn-warning btn-xs">Block</a>
                                            @endif
                                            @if($user->is_paid == 0 && $user->user_icon == 'golden.png')
                                                <a href="{{ route('set-user-to-paid',$user->id) }}" onclick="return confirm('Are you sure to set as paid user ?')" class="btn btn-dark btn-xs">Paid</a>
                                            @endif

{{--                                            @if($user->is_franchise)--}}
{{--                                                <a href="{{ route('admin.franchise.user',['user_id' => $user->id, 'type' => 'remove']) }}" class="btn btn-danger btn-xs mt-1s" title="Remove as a Franchise user"><i class="fa fa-user-times" aria-hidden="true"></i></a>--}}
{{--                                            @else--}}
{{--                                                <a href="{{ route('admin.franchise.user',['user_id' => $user->id, 'type' => 'make']) }}" class="btn btn-info btn-xs mt-1s" title="Make as a Franchise user"><i class="fa fa-user-plus" aria-hidden="true"></i></a>--}}
{{--                                            @endif--}}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->

    <!-- Installments Modal -->
    <div class="modal fade" id="emis-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Installments for <span id="modal-user-name"></span></h5>
                    <button type="button" class="close close-emis-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="emis-modal-body">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-emis-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Notification Overlay -->
    <div id="welcomeHasModal" class="welcome-overlay" style="display: none;">
        <canvas id="confetti-canvas"></canvas>
        <button type="button" class="close-overlay-btn" onclick="closeWelcomeModal()">&times;</button>
        <div class="welcome-content">
            <div class="welcome-header">
                <div class="celebration-icon">🎉</div>
                <h2 class="animate-shine">Congratulations!</h2>
            </div>
            <div class="welcome-body">
                <h3 class="welcome-username" id="welcomeUserName">User Name</h3>
                <p class="welcome-text">
                    A warm welcome to the <span class="brand-name">SonaxMultitrade</span> Family!<br>
                    We are thrilled to have you with us on this journey.
                </p>
                <div class="member-badge-container">
                    <div class="member-badge">
                        <span class="badge-label">Member ID</span>
                        <span class="badge-value" id="welcomeMemberId">12345</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .welcome-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        background: rgba(10, 10, 20, 0.95); /* Deep dark blue-black */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100000;
        backdrop-filter: blur(10px);
        overflow: hidden;
    }
    #confetti-canvas {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        pointer-events: none;
        z-index: 100000;
    }
    .close-overlay-btn {
        position: absolute;
        top: 30px;
        right: 30px;
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(255,255,255,0.5);
        color: #fff;
        font-size: 32px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        line-height: 44px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 100002;
        outline: none;
    }
    .close-overlay-btn:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(90deg);
        border-color: #fff;
    }
    .welcome-content {
        background: linear-gradient(145deg, #ffffff, #f0f0f0);
        padding: 60px 40px;
        border-radius: 40px;
        text-align: center;
        box-shadow: 
            0 20px 60px rgba(0,0,0,0.5),
            0 0 0 10px rgba(255, 255, 255, 0.1); /* Glass border effect */
        max-width: 650px;
        width: 90%;
        position: relative;
        z-index: 100001;
        animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @keyframes popIn {
        from { transform: scale(0.8) translateY(20px); opacity: 0; }
        to { transform: scale(1) translateY(0); opacity: 1; }
    }
    .celebration-icon {
        font-size: 80px;
        margin-bottom: 10px;
        animation: shake 2s infinite;
        display: inline-block;
    }
    @keyframes shake {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        75% { transform: rotate(10deg); }
    }
    .welcome-header h2 {
        font-family: 'Poppins', sans-serif; /* Assuming font availability or fallback */
        font-size: 50px;
        font-weight: 900;
        margin-bottom: 20px;
        text-transform: uppercase;
        background: linear-gradient(to right, #CFB53B, #E6D27A, #D4AF37); /* Gold Gradient */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 2px;
        filter: drop-shadow(0 2px 2px rgba(0,0,0,0.1));
    }
    .welcome-username {
        font-size: 42px;
        font-weight: 800;
        color: #333;
        margin: 10px 0 20px 0;
        text-transform: capitalize;
    }
    .welcome-text {
        font-size: 20px;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.6;
        font-weight: 500;
    }
    .brand-name {
        color: #d35400;
        font-weight: bold;
    }
    .member-badge-container {
        display: flex;
        justify-content: center;
    }
    .member-badge {
        background: linear-gradient(135deg, #FF6B6B, #EE5253);
        color: white;
        padding: 15px 50px;
        border-radius: 60px;
        box-shadow: 0 10px 25px rgba(238, 82, 83, 0.4);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 250px;
        transition: transform 0.3s;
    }
    .member-badge:hover {
        transform: translateY(-5px);
    }
    .badge-label {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
        margin-bottom: 5px;
    }
    .badge-value {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* Shine Animation for Text */
    .animate-shine {
        background-size: 200% auto;
        animation: shine 3s linear infinite;
    }
    @keyframes shine {
        to {
            background-position: 200% center;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-content {
            padding: 30px 20px;
            width: 90%;
            border-radius: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }
        .celebration-icon {
            font-size: 50px;
            margin-bottom: 5px;
        }
        .welcome-header h2 {
            font-size: 24px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .welcome-username {
            font-size: 24px;
            margin: 5px 0 15px 0;
        }
        .welcome-text {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .member-badge {
            padding: 10px 30px;
            min-width: 200px;
        }
        .badge-value {
            font-size: 20px;
        }
        .close-overlay-btn {
            top: 15px;
            right: 15px;
            width: 35px;
            height: 35px;
            font-size: 20px;
            line-height: 30px;
        }
    }
    </style>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){
            @if(request()->q)
                setTimeout(function(){
                    $('input[type=search]').val('{{ request()->q }}').trigger('keyup');
                },500);
            @endif
            @if(request()->has('kyc_details'))
                $('#kyc-modal').modal('show');
            @endif

            var currentUserId = null;

            function loadUserEmis(userId) {
                $('#emis-modal-body').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
                $.get("{{ url('admin/user') }}/" + userId + "/emis", function(data) {
                    $('#emis-modal-body').html(data);
                });
            }

            $(document).on('click', '.view-emis-btn', function() {
                var btn = $(this);
                currentUserId = btn.data('id');
                var userName = btn.data('name');
                $('#modal-user-name').text(userName);
                $('#emis-modal').modal('show');
                loadUserEmis(currentUserId);
            });

            $(document).on('click', '.modal-verify-btn', function() {
                if(!confirm('Are you sure you want to verify this installment?')) return;
                var id = $(this).data('id');
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                
                $.ajax({
                    url: "{{ route('admin.emi.verify') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(res) {
                        if(res.success) {
                            // Reload data behind the scenes
                            loadUserEmis(currentUserId);
                            
                            if(res.first_emi) {
                                // Show Welcome Overlay
                                $('#welcomeUserName').text(res.user_name);
                                $('#welcomeMemberId').text(res.member_id);
                                $('#welcomeHasModal').css('display', 'flex').hide().fadeIn();
                                startConfetti(); // Trigger Confetti
                            } else {
                                if(typeof toastr !== 'undefined') toastr.success(res.message); else alert(res.message);
                            }
                        } else {
                            if(typeof toastr !== 'undefined') toastr.error(res.message); else alert(res.message);
                            btn.prop('disabled', false).text('Verify');
                        }
                    },
                    error: function() {
                        alert('Something went wrong!');
                        btn.prop('disabled', false).text('Verify');
                    }
                });
            });

            window.closeWelcomeModal = function() {
                $('#welcomeHasModal').fadeOut();
            };

            // Confetti Logic
            function startConfetti() {
                const canvas = document.getElementById('confetti-canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;

                const pieces = [];
                const numberOfPieces = 200;
                const colors = ['#f1c40f', '#e74c3c', '#3498db', '#9b59b6', '#2ecc71', '#e67e22'];

                function random(min, max) {
                    return Math.random() * (max - min) + min;
                }

                for (let i = 0; i < numberOfPieces; i++) {
                    pieces.push({
                        x: random(0, canvas.width),
                        y: random(-canvas.height, 0),
                        w: random(5, 15),
                        h: random(5, 15),
                        color: colors[Math.floor(random(0, colors.length))],
                        speed: random(2, 6),
                        rotation: random(0, 360),
                        rotationSpeed: random(-5, 5)
                    });
                }

                function draw() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    pieces.forEach((p) => {
                        ctx.fillStyle = p.color;
                        ctx.save();
                        ctx.translate(p.x + p.w / 2, p.y + p.h / 2);
                        ctx.rotate(p.rotation * Math.PI / 180);
                        ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
                        ctx.restore();

                        p.y += p.speed;
                        p.rotation += p.rotationSpeed;

                        if (p.y > canvas.height) {
                            p.y = -20;
                            p.x = random(0, canvas.width);
                        }
                    });

                    if ($('#welcomeHasModal').is(':visible')) {
                        requestAnimationFrame(draw);
                    }
                }
                draw();
            }

            $(document).on('click', '.modal-reject-btn', function() {
                if(!confirm('Are you sure you want to REJECT this installment?')) return;
                var id = $(this).data('id');
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    url: "{{ route('admin.emi.reject') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(res) {
                        if(res.success) {
                            if(typeof toastr !== 'undefined') toastr.success(res.message); else alert(res.message);
                            loadUserEmis(currentUserId);
                        } else {
                            if(typeof toastr !== 'undefined') toastr.error(res.message); else alert(res.message);
                            btn.prop('disabled', false).text('Reject');
                        }
                    },
                    error: function() {
                        alert('Something went wrong!');
                        btn.prop('disabled', false).text('Reject');
                    }
                });
            });

            $(document).on('click', '.close-emis-modal', function() {
                $('#emis-modal').modal('hide');
            });
        });
    </script>
@endsection
