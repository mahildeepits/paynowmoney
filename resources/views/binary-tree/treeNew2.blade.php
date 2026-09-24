<style>
    .table1{
        width: 100%;
    }
    .main-member{
        position: relative;
    }
    .main-member-box::after{
        content: '';
        height: 30px;
        width: 2px;
        background: black;
        position: absolute;
        top: 42px;
        left: 786px;
        z-index: 99999;
    }
    a.child {
        position: relative;
    }
    div.child-box{
        padding: 12px;
    }
    a.child .child-box::before {
        content: '';
        height: 32px;
        width: 2px;
        background: black;
        position: absolute;
        top: -32px;
        left: 18px;
    }
    .hr-line{
        border-bottom: 2px solid black;
        margin: 0px 19px;
        margin-top: 29px;
    }
    .line-v{
        border-left: 2px solid black;
        height:30px;
        position: absolute;
    }
    .child-row > div{
        padding: 30px 0;
        border-top: 2px solid;
    }
    .main-row{
        overflow-x: auto;
    }
</style>
<div class="main-row mt-3">
    <div class="d-flex justify-content-center main-member">
       <div class="main-member-box text-center">
            <img src="{{ asset('images/'.$loggedInUser->user_icon) }}" alt="{{$loggedInUser->member_id}}" >
       </div>
    </div>
    {{-- <div class="hr-line"></div> --}}
    <div class="child-row d-flex justify-content-between">
        @foreach ($loggedInUser->allChildMembers as $child)
        <div>
            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        @endforeach
        <div>
            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$loggedInUser->user_icon) }}" alt="{{$loggedInUser->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>

        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
        <div>

            <a href="javascript:" class="child">
                <div class="child-box text-center">
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" >
                </div>
            </a>
        </div>
    </div>

</div>
