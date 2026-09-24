@php
$childCount = $loggedInUser->allChildMembers->count();
$lineCount = $childCount  + $childCount;
@endphp
<style>

    .table1{
        width: 100%;
    }
    .td-all{
    border: 2px solid white;
    }
    /* .td-all:nth-child(@php echo ($childCount) @endphp){
        border-right: 2px solid black;
    } */
    .top-border{
        border-bottom: 2px solid black;
    }
    .line-v{
        border-left: 2px solid black;
        height:30px;
        margin-top: -2px;
    }
    .line-v-top{
        border-left: 2px solid black;
        height:30px;
        margin-top: -2px;
    }
    .child-row{
        overflow-x: auto;
        padding-bottom: 10px;
    }
    .child-member{
        padding: 0 10px;
    }
    .member-detail{
        padding: 2px 5px;
        background-color: grey;
        color: white;
        border-radius: 6px;
        width: fit-content;
        text-align: center;
    }
    .main-member{
        position: relative;
    }
    .main-member-box::after{
        <?php if($childCount > 0){ ?>
            content: '';
            height: 26px;
            width: 2px;
            background: black;
            position: absolute;
            top: 96px;
            left: 50%;
        <?php } ?>
    }

    .box {
        width: max-content;
        height: 25px;
        background-color: #0f761cc7;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        border-radius: 5px;
        padding: 0px 20px !important;
        font-size: 13px;
        }

        .arrow {
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid transparent;
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            border-top: 10px solid black;
        }

        .line {
            width: 2px;
            height: 40px;
            background-color: black;
            margin: 0 auto;
            position: relative;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
</style>
{{-- <div class="row">
    <div class="col-md-12">
        <div class="container my-5">
            <div class="box">
                {{ ucwords($parent_role) ?? '' }}
            </div>
            @if($childCount > 0)
            <div class="line"></div>
                <div class="box mt-2">
                    <div class="arrow arrow-left"></div>
                    {{ $child_role ?? '' }} -- {{ $childCount }}
                </div>
            @endif
        </div>
    </div>
</div> --}}
<div class="main-row mt-3">
    @if (isset($previousUser) && $previousUser != false)
        <p style="text-align:center;cursor:pointer;">
            <img src="{{ asset('images/up.png') }}" style="margin:auto" id="up-link" class="load-tree"
                data-id="{{ $previousUser }}" onclick="getTree('{{ $previousUser }}')">
        </p>
    @endif
    <div class="d-flex justify-content-center">
        <div class="main-member text-center">
            <div class="mb-2 main-member-box">
                <a href="javascript:void(0)">
                    <img src="{{ asset('images/'.$loggedInUser->user_icon) }}" alt="{{$loggedInUser->member_id}}" class="user-img"
                    data-id="{{ $loggedInUser->member_id }}" data-name="{{ $loggedInUser->name }}"
                    data-kit="{{ $loggedInUser?->latestJoiningKit?->name ?? '' }}"
                    data-joindate="{{ $loggedInUser->created_at->format('d-m-Y h:i A') }}" >
                </a>
            </div>
            <div class="member-detail">
                {{$loggedInUser->member_id}}
                <p class="m-0 p-0">{{$loggedInUser->name}}</p>
            </div>
        </div>
    </div>

    <table class="table1">
        <tbody>
            <tr>
                @for ($i=1; $i <= ($lineCount) ; $i++)
                    <td class=" td-all {{($i == 1 || $i == ($lineCount)) ? '' : 'top-border' }} ">&nbsp;</td>
                @endfor
            </tr>
        </tbody>
    </table>
    <div class="child-row d-flex justify-content-around">
        @foreach ($loggedInUser->allChildMembers as $child)
        <div class="child-member">
            <div class="d-flex justify-content-center">
                <div class="line-v"></div>
            </div>
            <a href="javascript:void(0)">
                <div class="main-member text-center mb-2">
                    @if(strtolower($child->userRole->name) == 'student')
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" class="user-img"
                    data-id="{{ $child->member_id }}" data-name="{{ $child->name }}"
                    data-kit="{{ $child?->latestJoiningKit?->name ?? '' }}"
                    data-joindate="{{ $child->created_at->format('d-m-Y h:i A') }}" >
                    @else
                    <img src="{{ asset('images/'.$child->user_icon) }}" alt="{{$child->member_id}}" class="user-img"
                    onclick="getTree('{{ $child->member_id }}');"
                    data-id="{{ $child->member_id }}" data-name="{{ $child->name }}"
                    data-kit="{{ $child?->latestJoiningKit?->name ?? '' }}"
                    data-joindate="{{ $child->created_at->format('d-m-Y h:i A') }}" >
                    @endif
                </div>
            </a>
            <div class="member-detail">
                {{$child->member_id}}
                <p class="m-0 p-0">{{$child->name}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div id="tooltip_div" style="display: none;">
    <div id="user_1" class="tooltip_div">
        <div class="img_bg" style="text-align: center;"><span class="span_username" style="margin-right: 10px; margin-top: 20px;">SSBADMIN</span></div>
        <div class="img_bg" style="text-align: center;"></div>
        <br clear="all" />
        <div class="tooltip_details">
            <table class="tooltip_table">
                <tbody>
                    <tr>
                        <td class="sponsor-details">Company</td>
                    </tr>
                    <tr>
                        <td>
                            <b style="margin-right: 10px;">Join Date :</b>
                            <span class="user_join_date">2020-04-20 05:32:07 pm</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b style="margin-right: 10px;">Kit / Level :</b>
                            <span class="user_join_kit">2020-04-20 05:32:07 pm</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

