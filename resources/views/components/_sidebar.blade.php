<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('images/long-logo.png') }}" class="" style="width: 180px" alt="logo icon">
        </div>
        <!-- <div>
            <h5 class="logo-text">{{ config('app.name') }}</h5>
        </div> -->
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">General</div>
            </a>
            <ul>
                <li> <a href="{{ route('member.dashboard') }}"><i class="bx bx-right-arrow-alt"></i>Member Home</a></li>
                @if (!in_array(authUser('member')->member_id,['CH0001','CH0002']))
                    <li> <a href="{{ route('register',['sponsor'=>auth('member')->user()->member_id]) }}" target="_blank"><i class="bx bx-right-arrow-alt"></i>Join Now</a></li>
                @endif
            </ul>
        </li>

            {{-- <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-file"></i>
                    </div>
                    <div class="menu-title">Record</div>
                </a>
                <ul>
                    <li> <a href="{{ route('receipt') }}"><i class="bx bx-right-arrow-alt"></i>My Receipt</a>
                    </li>
                    <li> <a href="{{ route('invoice') }}"><i class="bx bx-right-arrow-alt"></i>My Invoice</a>
                    </li>
                    <li> <a href="{{ route('id-card') }}"><i class="bx bx-right-arrow-alt"></i>ID Card</a>
                    </li>
                </ul>
            </li> --}}

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-desktop'></i>
                    </div>
                    <div class="menu-title">My Information</div>
                </a>
                <ul>
                    <li> <a href="{{ route('account.profile') }}"><i class="bx bx-right-arrow-alt"></i>My Profile</a></li>
                    <li> <a href="{{ route('account.kyc-details') }}"><i class="bx bx-right-arrow-alt"></i>Upload KYC Doc</a></li>
                    <li> <a href="{{ route('edit-bank-details') }}"><i class="bx bx-right-arrow-alt"></i>Edit Bank A/C</a></li>
                    <li> <a href="{{ route('account.change-password') }}"><i class="bx bx-right-arrow-alt"></i>Change Password</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bxs-tree'></i>
                    </div>
                    <div class="menu-title">Network</div>
                </a>
                <ul>
                    <li> <a href="{{ route('member.tree',1) }}"><i class="bx bx-right-arrow-alt"></i>View Tree</a></li>
                    <li> <a href="{{ route('my-directs') }}"><i class="bx bx-right-arrow-alt"></i>My Directs</a></li>
                    <li> <a href="{{ route('my-downline') }}"><i class="bx bx-right-arrow-alt"></i>My Downline</a></li>
                </ul>
            </li>

            {{-- <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-money'></i>
                    </div>
                    <div class="menu-title">My Topup</div>
                </a>
                <ul>
                    <li> <a href="{{ route('joining-pins') }}"><i class="bx bx-right-arrow-alt"></i>Join Form Pins</a></li>
                    <li> <a href="{{ route('transfer-pins') }}"><i class="bx bx-right-arrow-alt"></i>Transfer Pins</a></li>
                    <li> <a href="{{ route('member.pins.history') }}"><i class="bx bx-right-arrow-alt"></i>Pin History</a></li>
                    <li> <a href="{{ route('member.joining-packages') }}"><i class="bx bx-right-arrow-alt"></i>Joining Packages</a></li>
                </ul>
            </li> --}}
            <li>
                <a href="{{ route('id-card') }}">
                    <div class="paren-icon"><i class="bx bx-id-card bx-sm"></i></div><div class="menu-title">ID Card</div>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('member.joining-packages') }}">
                    <div class="parent-icon"><i class="bx bx-money"></i>
                    </div>
                    <div class="menu-title">Topup Now</div>
                </a>
            </li> -->
            <li>
                <a href="{{ route('member.emis.index') }}">
                     <div class="parent-icon"><i class="bx bx-rupee"></i>
                     </div>
                     <div class="menu-title">Installments</div>
                </a>
            </li>
            <li>
                <a href="{{ route('member.my_product') }}">
                    <div class="parent-icon"><i class="bx bx-shopping-bag"></i>
                    </div>
                    <div class="menu-title">My Product</div>
                </a>
            </li>
            <li>
                <a href="{{ route('member.user.payouts') }}">
                    <div class="parent-icon"><i class="bx bx-award"></i>
                    </div>
                    <div class="menu-title">My Payouts</div>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('member.user.payouts',['type' => 'requested']) }}">
                    <div class="parent-icon"><i class="bx bx-award"></i>
                    </div>
                    <div class="menu-title">Requests</div>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('member.wallet') }}">
                    <div class="parent-icon"><i class="bx bx-wallet"></i>
                    </div>
                    <div class="menu-title">My Wallet</div>
                </a>
            </li>
            <li>
                <a href="{{ route('wallet.withdrawl') }}">
                    <div class="parent-icon"><i class="bx bx-money"></i>
                    </div>
                    <div class="menu-title">Withdrawal</div>
                </a>
            </li>
            <li>
                <a href="{{ route('wallet.pin') }}">
                    <div class="parent-icon"><i class="bx bx-key"></i>
                    </div>
                    <div class="menu-title">Withdrawal PIN</div>
                </a>
            </li>
        <li>
            <a href="{{ route('logout') }}">
                <div class="parent-icon"><i class="bx bx-log-out"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
