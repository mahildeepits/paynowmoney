<div class="jOrgChart">
    @if ($previousUser != false)
        <p style="text-align:center;cursor:pointer;">
            <img src="{{ asset('images/up.png') }}" style="margin:auto" id="up-link" class="load-tree"
                 data-id="{{ $previousUser }}" onclick="getTree('{{ $previousUser }}')">
        </p>
    @endif
    <div id="TreeView_ContainerDiv_0" align="center">
        <div id="TreeView_ContainerDiv_0_Inner" align="center">
            <div class="user1" style="background-color: white;" id="Tree0_1">
                <a href="javascript:void(0)">
                    <div class="con">
                        @if ($username->position_rel->status == 1)
                            <img src="{{ asset('images/'.$username->user_icon) }}" class="user-img load-tree"
                                 data-left="{{ $username->left_count }}"
                                 onclick="getTree('{{ $username->user_id }}');"
                                 data-right="{{ $username->right_count }}"
                                 data-id="{{ $username->member_id }}" data-name="{{ $username->name }}"
                                 data-joindate="{{ $username->created_at->format('d-m-Y h:i A') }}" />
                        @else
                            <img src="{{ asset('images/userfree.png') }}" class="user-img load-tree"
                                 data-left="{{ $username->left_count }}"
                                 onclick="getTree('{{ $username->user_id }}');"
                                 onclick="getTree('{{ $username->user_id }}');"
                                 data-right="{{ $username->right_count }}"
                                 data-id="{{ $username->member_id }}" data-name="{{ $username->name }}"
                                 data-joindate="{{ $username->created_at->format('d-m-Y h:i A') }}" />
                        @endif
                        <div class="line down"></div>
                        <div class="username">{{ $username->member_id }}</div>
                        <div class="line down"></div>
                    </div>
                    <table>
                        <tbody>
                        <tr>
                            <td class="line left">&nbsp;</td>
                            <td class="line right top">&nbsp;</td>
                            <td class="line left top">&nbsp;</td>
                            <td class="line right">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                </a>
                <div class="user1" style="background-color: white;" id="Tree0_2">
                    <a href="javascript:void(0)"></a>
                    <a href="javascript:void(0)">
                        @php
                            $username11 = get_user_by_position($username->member_id, 'left');
                        @endphp
                        <div class="con">
                            @if ($username11 == false)
                                <img src="{{ asset('images/unnamed.png') }}"
                                     onclick="handleEmptyNode('left','{{   @$username->member_id }}', '{{ auth()->guard('member')->user()->member_id }}','{{ route('register') }}')"
                                     title="" />
                            @else
                                @if ($username11->status == 1)
                                    <img src="{{ asset('images/'.$username11->user->user_icon) }}" class="user-img load-tree"
                                         data-left="{{ $username11->user->left_count }}"
                                         data-right="{{ $username11->user->right_count }}" title=""
                                         onclick="getTree('{{ $username11->user_id }}');"
                                         data-id="{{ $username11->user_id }}"
                                         data-name="{{ $username11->user->name }}"
                                         data-sponsor="{{ $username11->user->sponsor_id }}"
                                         data-joindate="{{ $username11->user->created_at->format('d-m-Y h:i A') }}" />
                                @else
                                    <img src="{{ asset('images/userfree.png') }}" class="user-img load-tree"
                                         data-left="{{ $username11->user->left_count }}"
                                         data-right="{{ $username11->user->right_count }}" title=""
                                         onclick="getTree('{{ $username11->user_id }}');"
                                         data-id="{{ $username11->user_id }}"
                                         data-name="{{ $username11->user->name }}"
                                         data-sponsor="{{ $username11->user->sponsor_id }}"
                                         data-joindate="{{ $username11->user->created_at->format('d-m-Y h:i A') }}" />
                                @endif
                            @endif
                            <div class="line down"></div>
                            <div class="username">
                                {{ $username11 == false ? 'Blank' : $username11->user_id }}
                            </div>
                            <div class="line down"></div>
                        </div>
                        <table>
                            <tbody>
                            <tr>
                                <td class="line left">&nbsp;</td>
                                <td class="line right top">&nbsp;</td>
                                <td class="line left top">&nbsp;</td>
                                <td class="line right">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>

                    <div class="user1" style="background-color: white;" id="Tree0_3">
                        <a href="javascript:void(0)"></a>
                        <a href="javascript:void(0)">
                            @php
                                $username111 = get_user_by_position(@$username11->user_id, 'left');
                            @endphp
                            <div class="con">
                                @if ($username111 == false)
                                    <img src="{{ asset('images/unnamed.png') }}"
                                         onclick="handleEmptyNode('left','{{   @$username11->member_id }}', '{{ auth()->guard('member')->user()->member_id }}','{{ route('register') }}')"
                                         title="" />
                                @else
                                    @if ($username111->status == 1)
                                        <img src="{{ asset('images/'.$username111->user->user_icon) }}" class="user-img load-tree"
                                             data-left="{{ $username111->user->left_count }}"
                                             data-right="{{ $username111->user->right_count }}" title=""
                                             onclick="getTree('{{ $username111->user_id }}');"
                                             data-id="{{ $username111->user_id }}"
                                             data-name="{{ $username111->user->name }}"
                                             data-sponsor="{{ $username111->user->sponsor_id }}"
                                             data-joindate="{{ $username111->user->created_at->format('d-m-Y h:i A') }}" />
                                    @else
                                        <img src="{{ asset('images/userfree.png') }}" class="user-img load-tree"
                                             data-left="{{ $username111->user->left_count }}"
                                             data-right="{{ $username111->user->right_count }}" title=""
                                             onclick="getTree('{{ $username111->user_id }}');"
                                             data-id="{{ $username111->user_id }}"
                                             data-name="{{ $username111->user->name }}"
                                             data-sponsor="{{ $username111->user->sponsor_id }}"
                                             data-joindate="{{ $username111->user->created_at->format('d-m-Y h:i A') }}" />
                                    @endif
                                @endif
                                <div class="line down"></div>
                                <div class="username">
                                    {{ $username111 == false ? 'Blank' : $username111->user_id }}
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user1" style="background-color: white;" id="Tree0_4">
                        <a href="javascript:void(0)">
                            @php
                                $username112 = get_user_by_position(@$username11->user_id, 'right');
                            @endphp
                            <div class="con">
                                @if ($username112 == false)
                                    <img src="{{ asset('images/unnamed.png') }}"
                                         onclick="handleEmptyNode('right','{{   @$username11->user_id }}', '{{ auth()->guard('member')->user()->member_id }}','{{ route('register') }}')"
                                         title="" />
                                @else
                                    @if ($username112->status == 1)
                                        <img src="{{ asset('images/'.$username112->user->user_icon) }}" class="user-img load-tree"
                                             onclick="getTree('{{ $username112->user_id }}');" title=""
                                             data-left="{{ $username112->user->left_count }}"
                                            data-id="{{ $username112->user_id }}"
                                            data-name="{{ $username112->user->name }}"
                                            data-sponsor="{{ $username112->user->sponsor_id }}"
                                            data-joindate="{{ $username112->user->created_at->format('d-m-Y h:i A') }}" />
                                    @else
                                        <img src="{{ asset('images/userfree.png') }}" class="user-img load-tree"
                                             onclick="getTree('{{ $username112->user_id }}');" title=""
                                             data-left="{{ $username112->user->left_count }}"
                                        data-id="{{ $username112->user_id }}"
                                        data-name="{{ $username112->user->name }}"
                                        data-sponsor="{{ $username112->user->sponsor_id }}"
                                        data-joindate="{{ $username112->user->created_at->format('d-m-Y h:i A') }}" />
                                    @endif
                                @endif
                                <div class="line down"></div>
                                <div class="username">
                                    {{ $username112 == false ? 'Blank' : $username112->user_id }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="user1" style="background-color: white;" id="Tree0_5">
                    <a href="javascript:void(0)">
                        <div class="con">
                            @php
                                $username12 = get_user_by_position($username->member_id, 'right');
                            @endphp
                            @if ($username12 == false)
                                <img src="{{ asset('images/unnamed.png') }}"
                                     onclick="handleEmptyNode('right','{{  $username->member_id }}', '{{ auth()->guard('member')->user()->member_id }}','{{ route('register') }}')"
                                     title="" />
                            @else
                                @if ($username12->status == 1)
                                    <img src="{{ asset('images/'.$username12->user->user_icon) }}" class="user-img load-tree"
                                         data-left="{{ $username12->user->left_count }}"
                                         data-right="{{ $username12->user->right_count }}" title=""
                                         data-id="{{ $username12->user_id }}"
                                         onclick="getTree('{{ $username12->user_id }}');"
                                         data-name="{{ $username12->user->name }}"
                                         data-sponsor="{{ $username12->user->sponsor_id }}"
                                         data-joindate="{{ $username12->user->created_at->format('d-m-Y h:i A') }}" />
                                @else
                                    <img src="{{ asset('images/userfree.png') }}" class="user-img load-tree"
                                         data-left="{{ $username12->user->left_count }}"
                                         data-right="{{ $username12->user->right_count }}" title=""
                                         data-id="{{ $username12->user_id }}"
                                         onclick="getTree('{{ $username12->user_id }}');"
                                         data-name="{{ $username12->user->name }}"
                                         data-sponsor="{{ $username12->user->sponsor_id }}"
                                         data-joindate="{{ $username12->user->created_at->format('d-m-Y h:i A') }}" />
                                @endif
                            @endif
                            <div class="line down"></div>
                            <div class="username">
                                {{ $username12 == false ? 'Blank' : $username12->user_id }}
                            </div>
                            <div class="line down"></div>
                        </div>
                        <table>
                            <tbody>
                            <tr>
                                <td class="line left">&nbsp;</td>
                                <td class="line right top">&nbsp;</td>
                                <td class="line left top">&nbsp;</td>
                                <td class="line right">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>
                    <div class="user1" style="background-color: white;" id="Tree0_6">
                        <a href="javascript:void(0)"></a>
                        <a href="javascript:void(0)">
                            <div class="con">
                                @php
                                    $username121 = get_user_by_position(@$username12->user_id, 'left');
                                @endphp
                                @if ($username121 == false)
                                    <img src="{{ asset('images/unnamed.png') }}"
                                         onclick="handleEmptyNode('left','{{  @$username12->user_id }}', '{{ auth()->guard('member')->user()->member_id }}','{{ route('register') }}')"
                                         title="" title="" />
                                @else
                                    <img src="{{ asset('images/userpaid.png') }}" class="user-img load-tree"
                                         data-left="{{ $username121->user->left_count }}"
                                         data-right="{{ $username121->user->right_count }}" title=""
                                         data-id="{{ $username121->user_id }}"
                                         onclick="getTree('{{ $username121->user_id }}');"
                                         data-name="{{ $username121->user->name }}"
                                         data-sponsor="{{ $username121->user->sponsor_id }}"
                                         data-joindate="{{ $username121->user->created_at->format('d-m-Y h:i A') }}" />
                                @endif
                                <div class="line down"></div>
                                <div class="username">
                                    {{ $username121 == false ? 'Blank' : $username121->user_id }}
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user1" style="background-color: white;" id="Tree0_7">
                        <a href="javascript:void(0)">
                            <div class="con">
                                @php
                                    $username122 = get_user_by_position(@$username12->user_id, 'right');
                                @endphp
                                @if ($username122 == false)
                                    <img src="{{ asset('images/unnamed.png') }}"
                                         onclick="handleEmptyNode('right','{{ @$username12->user_id }}', '{{ auth()->guard('member')->user()->member_id }}','{{ route('register') }}')"
                                         title="" />
                                @else
                                    @if ($username122->status == 1)
                                        <img src="{{ asset('images/'.$username122->user->user_icon) }}" class="user-img load-tree"
                                             data-left="{{ $username122->user->left_count }}"
                                             data-right="{{ $username122->user->right_count }}" title=""
                                             data-id="{{ $username122->user_id }}"
                                             data-name="{{ $username122->user->name }}"
                                             onclick="getTree('{{ $username122->user_id }}');"
                                             data-sponsor="{{ $username122->user->sponsor_id }}"
                                             data-joindate="{{ $username122->user->created_at->format('d-m-Y h:i A') }}" />
                                    @else
                                        <img src="{{ asset('images/userfree.png') }}" class="user-img load-tree"
                                             data-left="{{ $username122->user->left_count }}"
                                             data-right="{{ $username122->user->right_count }}" title=""
                                             data-id="{{ $username122->user_id }}"
                                             onclick="getTree('{{ $username122->user_id }}');"
                                             data-name="{{ $username122->user->name }}"
                                             data-sponsor="{{ $username122->user->sponsor_id }}"
                                             data-joindate="{{ $username122->user->created_at->format('d-m-Y h:i A') }}" />
                                    @endif
                                @endif
                                <div class="line down"></div>
                                <div class="username">
                                    {{ $username122 == false ? 'Blank' : $username122->user_id }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                        <td><b style="margin-right: 10px;" >Package :</b><span class="joining_kit">Package 1</span></td>
                    </tr>
                    <tr>
                        <td><b style="margin-right: 10px;">Left Count :</b><span class="left_count"></span></td>
                    </tr>
                    <tr>
                        <td><b style="margin-right: 10px;">Right Count :</b><span class="right_count"></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
