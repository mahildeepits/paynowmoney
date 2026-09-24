@extends('admin.layouts.admin')
@section('title', 'Installment Requests')
@section('content')
<div id="main-wrapper">
    <div class="content-header">
        <h1 class="page-title">Installment Requests</h1>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.emis.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search User Name/ID" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted (Pending)</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Month</th>
                            <th>Status</th>
                            <th>Screenshot</th>
                            <th>Paid At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($emis as $index => $emi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $emi->user->name }}<br>
                                <small>ID: {{ $emi->user->member_id }}</small>
                            </td>
                            <td>{{ number_format($emi->amount, 0) }}</td>
                            <td>{{ $emi->month }}</td>
                            <td>
                                @if($emi->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($emi->status == 'submitted')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($emi->status == 'rejected' || $emi->status == 'Rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @else
                                    <span class="badge badge-secondary">Unpaid</span>
                                @endif
                            </td>
                            <td>
                                @if($emi->screenshot)
                                    <a href="{{ asset('storage/'.$emi->screenshot) }}" target="_blank">View Proof</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $emi->paid_at ? \Carbon\Carbon::parse($emi->paid_at)->format('d M Y h:i A') : '-' }}</td>
                            <td>
                                @if($emi->status == 'submitted')
                                    <button class="btn btn-success btn-sm verify-btn" data-id="{{ $emi->id }}">Verify</button>
                                    <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $emi->id }}">Reject</button>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No Records Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $emis->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Welcome Notification Modal -->
<div id="welcomeHasModal" class="welcome-modal-overlay" style="display: none;">
    <div class="welcome-modal-content">
        <div class="welcome-modal-header">
            <h2 class="animate-pop">🎉 Congratulations 🎉</h2>
        </div>
        <div class="welcome-modal-body">
            <h3 class="welcome-username" id="welcomeUserName">User Name</h3>
            <p class="welcome-text">Welcome to our <span class="brand-name">SonaxMultitrade</span> Family.</p>
            <div class="member-badge">
                Member ID: <span id="welcomeMemberId">12345</span>
            </div>
        </div>
        <div class="welcome-modal-footer">
            <button type="button" class="btn btn-welcome-close" onclick="closeWelcomeModal()">Close & Continue</button>
        </div>
    </div>
</div>

<style>
.welcome-modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.85); /* Darker overlay for focus */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
    backdrop-filter: blur(5px);
}
.welcome-modal-content {
    background: #fff;
    padding: 40px; /* More padding */
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0,0,0,0.5);
    max-width: 550px;
    width: 90%;
    position: relative;
    border: 4px solid #fff;
    background-clip: padding-box;
    animation: zoomIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.welcome-modal-content::before {
    content: '';
    position: absolute;
    top: -4px; bottom: -4px;
    left: -4px; right: -4px;
    background: linear-gradient(45deg, #ff00cc, #333399, #ff00cc);
    z-index: -1;
    border-radius: 28px;
    filter: blur(10px);
    opacity: 0.5;
}
@keyframes zoomIn {
    from { transform: scale(0.5); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.welcome-modal-header h2 {
    background: -webkit-linear-gradient(#f1c40f, #d35400);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-family: 'Arial Black', sans-serif;
    font-size: 36px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.welcome-username {
    font-size: 32px;
    font-weight: 800;
    color: #2c3e50;
    margin: 20px 0;
    text-transform: capitalize;
}
.welcome-text {
    font-size: 20px;
    color: #555;
    margin-bottom: 25px;
    font-weight: 500;
}
.brand-name {
    color: #e84393;
    font-weight: bold;
    font-style: italic;
}
.member-badge {
    background: linear-gradient(to right, #00b09b, #96c93d);
    color: #fff;
    padding: 12px 30px;
    border-radius: 50px;
    display: inline-block;
    font-weight: bold;
    font-size: 18px;
    box-shadow: 0 10px 20px rgba(0, 176, 155, 0.3);
}
.btn-welcome-close {
    background: #34495e;
    color: white;
    padding: 12px 40px;
    border-radius: 30px;
    font-size: 16px;
    border: none;
    transition: all 0.3s;
    font-weight: 600;
}
.btn-welcome-close:hover {
    background: #2c3e50;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>
@endsection

@section('scripts')
@parent
<script>
    $('.verify-btn').click(function(){
        if(!confirm('Are you sure you want to verify this payment?')) return;
        var id = $(this).data('id');
        var btn = $(this);
        $.ajax({
            url: "{{ route('admin.emi.verify') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(res){
                if(res.success){
                    if(res.first_emi) {
                        // Show popup
                        $('#welcomeUserName').text(res.user_name);
                        $('#welcomeMemberId').text(res.member_id);
                        $('#welcomeHasModal').css('display', 'flex').hide().fadeIn();
                    } else {
                        if(typeof toastr !== 'undefined') toastr.success(res.message); else alert(res.message);
                        location.reload();
                    }
                } else {
                    if(typeof toastr !== 'undefined') toastr.error(res.message); else alert(res.message);
                }
            }
        });
    });

    $('.reject-btn').click(function(){
        if(!confirm('Are you sure you want to REJECT this payment?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('admin.emi.reject') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(res){
                if(res.success){
                    if(typeof toastr !== 'undefined') toastr.success(res.message); else alert(res.message);
                    location.reload();
                } else {
                    if(typeof toastr !== 'undefined') toastr.error(res.message); else alert(res.message);
                }
            }
        });
    });

    function closeWelcomeModal() {
        $('#welcomeHasModal').fadeOut(function() {
            location.reload();
        });
    }
</script>
@endsection
