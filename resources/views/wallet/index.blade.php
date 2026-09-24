@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">My Wallet</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Wallet</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header bg-gradient-sitecolor text-center shadow">
                                <div class="row d-flex align-items-center justify-content-center">
                                    <div class="col-md-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="110" width="110" viewBox="0 0 88 88">
                                            <path d="M73.999 58V46a8.926 8.926 0 0 0-1.23-4.53l-6.25 6.25a7.003 7.003 0 0 1 1.48 4.28v6zM67.999 79h3a3.009 3.009 0 0 0 3-3v-2h-6z" style="fill:#fff"/>
                                            <path d="M76.999 60h-20a6.005 6.005 0 0 0-6 6 6.009 6.009 0 0 0 6 6h20a5.002 5.002 0 0 0 5-5V55a4.985 4.985 0 0 1-5 5zm-20 8a2 2 0 1 1 2-2 2.006 2.006 0 0 1-2 2z" style="fill:#fff"/>
                                            <path d="M75.999 58a4 4 0 1 0 0-8zM34.999 1h-19a1.003 1.003 0 0 0-1 1v40.76l20-20zm-8 12a4 4 0 1 1-7.46-2 4 4 0 1 1 6.92 0 3.971 3.971 0 0 1 .54 2z" style="fill:#fff"/>
                                            <path d="M23.59 12.953c-.038.005-.077.007-.115.01-.093.012-.188.017-.283.022a4.567 4.567 0 0 1-2.133-.485 2.074 2.074 0 0 0-.06.5 2 2 0 1 0 4 0 2.074 2.074 0 0 0-.06-.5 3.658 3.658 0 0 1-1.35.453zM22.999 7a2.006 2.006 0 0 0-2 2 2 2 0 0 0 4 0 2.006 2.006 0 0 0-2-2zM40.999 1h-4v19.76l4-4V1zM48.999 2a1.003 1.003 0 0 0-1-1h-5v13.76l6-6z" style="fill:#fff"/>
                                            <circle cx="56.999" cy="29" r="1" style="fill:#fff"/><path d="m21.245 45 31.507-31.507a1 1 0 0 1 1.41-.004 4.12 4.12 0 0 0 5.673 0 1 1 0 0 1 1.41.004l11.26 11.26a1 1 0 0 1 .004 1.41 4.022 4.022 0 0 0 0 5.674 1 1 0 0 1-.004 1.41L60.753 45h.246a6.898 6.898 0 0 1 1.97.28 7.005 7.005 0 0 1 2.12 1.05l16.62-16.62a1.008 1.008 0 0 0 0-1.42l-24-24a1.008 1.008 0 0 0-1.42 0L15.579 45z" style="fill:#fff"/>
                                            <path d="M60.478 15.553a6.15 6.15 0 0 1-6.959 0L24.073 45h33.852l12.52-12.521a6.022 6.022 0 0 1 0-6.958zm-7.772 27.154a1 1 0 0 1-1.414 0l-.814-.814a2.394 2.394 0 0 1-3.186-.186 1 1 0 0 1 1.414-1.414.414.414 0 0 0 .586 0l1-1a.414.414 0 0 0 0-.585l-.28-.28a.414.414 0 0 0-.478-.078l-2.176 1.088a2.411 2.411 0 0 1-2.787-.451l-.28-.28a2.392 2.392 0 0 1-.186-3.188l-.813-.812a1 1 0 1 1 1.414-1.414l.814.813a2.41 2.41 0 0 1 3.186.186 1 1 0 0 1-1.414 1.415.414.414 0 0 0-.586 0l-1 1a.414.414 0 0 0 0 .585l.28.28a.413.413 0 0 0 .478.077l2.175-1.088a2.413 2.413 0 0 1 2.787.452l.28.28a2.392 2.392 0 0 1 .187 3.187l.813.813a1 1 0 0 1 0 1.414zM56.999 32a3 3 0 1 1 3-3 3.003 3.003 0 0 1-3 3z" style="fill:#fff"/>
                                            <path d="M48.999 66a8.01 8.01 0 0 1 8-8h9v-6a4.988 4.988 0 0 0-5-5h-50a5.002 5.002 0 0 1-5-5v40a5.002 5.002 0 0 0 5 5h50a5.002 5.002 0 0 0 5-5v-8h-9a8.01 8.01 0 0 1-8-8zm14-14h1v2h-1a1 1 0 0 1 0-2zm-54 30a2.772 2.772 0 0 1-1-.18V79a1.003 1.003 0 0 0 1 1 1 1 0 1 1 0 2zm0-28a2.772 2.772 0 0 1-1-.18V51a1.003 1.003 0 0 0 1 1 1 1 0 1 1 0 2zm54 26h1v2h-1a1 1 0 0 1 0-2zm-7-28h2a1 1 0 0 1 0 2h-2a1 1 0 0 1 0-2zm-7 0h2a1 1 0 0 1 0 2h-2a1 1 0 0 1 0-2zm-33 30h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm0-28h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm7 28h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm0-28h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm7 28h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm0-28h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm7 28h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2zm0-28h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2zm7 28h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2zm0-28h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2zm7 28h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2zm8-1a1 1 0 0 1-1 1h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1z" style="fill:#fff"/>
                                            <path d="M11.999 45h1v-8h-1a4 4 0 1 0 0 8z" style="fill:#fff"/>
                                        </svg>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="">
                                                <h1>WALLET INCOME</h1>
                                            </div>
                                            <div class="mx-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                  </svg>
                                            </div>
                                            <div class="">
                                                <h1><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey() ?? 0 }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('wallet.withdrawl') }}"  class="btn-sm btn-warning mx-2 my-1" > Withdraw</a>
                                        <!-- @if (authUser('member')->is_paid == 1)
                                            <button type="button" class="btn-sm btn-warning mx-2 my-1 transferMoney" data-bs-toggle="modal" data-bs-target="#walletModal">
                                                Transfer Money
                                            </button>
                                            {{-- <button type="button" class="btn-sm btn-info mx-2 my-1 buyPin" data-bs-toggle="modal" data-bs-target="#walletModal">
                                                Buy Pin
                                            </button>  --}}
                                        @endif -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row mx-3 mb-4">
                        <div class="col-md-8">
                            <div class="transaction-list bg-light mt-4 table-responsive">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="mb-2">Transaction List</h4>
                                    </div>
                                    <div class="col-md-4 float-end">
                                        <select id="transactionFilter" class="form-control">
                                            <option value="all">All Transactions</option>
                                            @foreach((new \App\Models\WalletTransaction)->getKeywordNames() as $keyword => $title)
                                                <option value="{{ $keyword }}">{{ ucfirst($title) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @foreach($userTransations as $transaction)
                                    @php
                                        $message = $transaction->slug;
                                        $keyword = $transaction->keyword;
                                        /* Add Sign according to transaaction */
                                        $sign    = in_array($keyword, ['buy_pin', 'self_topup', 'user_topup', 'withdrawal', 'transfer']) ? '-' : '+';
                                        if ($keyword == 'transfer') {
                                            if ((authUser()->member_id == $transaction->user_id)) {
                                                $keyword = 'transfer';      $sign = '-'; } 
                                            else {
                                                $keyword = 'pin_transfer';  $sign = '+'; }
                                        }
                                        /* Add Class according to Sign */
                                        $class   = $sign === '-' ? "text-danger" : "text-success";
                                        /* Change Keyword if keyword is transfer and auth is transfered user */
                                    @endphp
                                    @php
                                        $displayKeyword = $keyword;
                                        if (strpos($keyword, 'level_') === 0 && strpos($keyword, '_income') !== false) {
                                            $displayKeyword = 'level_income';
                                        }
                                    @endphp
                                    <div class="transaction-item d-flex justify-content-between align-items-center border-bottom"
                                        data-keyword="{{ $displayKeyword }}">
                                        <div class="text-wrap">
                                            <p class="mb-0" style="font-weight:500;">{!! $message !!}</p>
                                            <small class="text-muted">{{ $transaction?->created_at?->toDayDateTimeString() }}</small>
                                        </div>
                                        <div class="text-end">
                                            <p class="{{ $class }} mb-0"><b>{{ $sign }} {{ $transaction?->amount }}</b></p>
                                            @if($keyword == 'withdrawal' && $transaction->admin_charges > 0)
                                                <small class="text-danger" style="font-size: 0.75rem;">(Charges: -₹{{ $transaction->admin_charges }})</small>
                                                <br>
                                                <small class="text-muted" style="font-size: 0.75rem;">Net: ₹{{ $transaction->net_amount }}</small>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <div id="pagination"></div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    let itemsPerPage = 10;
                                    let transactionList = document.querySelector('.transaction-list');
                                    let transactionItems = Array.from(transactionList.querySelectorAll('.transaction-item'));
                                    let paginationContainer = document.querySelector('#pagination');
                                    let filterDropdown = document.querySelector('#transactionFilter');

                                    let currentPage = 1;
                                    let filteredItems = transactionItems; // Store filtered transactions
                                    let totalPages = Math.ceil(filteredItems.length / itemsPerPage);

                                    function renderPage(page) {
                                        currentPage = page;
                                        let startIndex = (page - 1) * itemsPerPage;
                                        let endIndex = startIndex + itemsPerPage;

                                        transactionItems.forEach(item => item.classList.remove('displayData'));
                                        let currentPageItems = filteredItems.slice(startIndex, endIndex);
                                        currentPageItems.forEach(item => item.classList.add('displayData'));

                                        updatePagination();
                                    }

                                    function updatePagination() {
                                        paginationContainer.innerHTML = '';
                                        totalPages = Math.ceil(filteredItems.length / itemsPerPage);
                                        if (totalPages < 1) {
                                            totalPages = 1;
                                        }

                                        let totalRecords = document.createElement('span');
                                        totalRecords.textContent = `Total Records: ${filteredItems.length}`;
                                        paginationContainer.appendChild(totalRecords);

                                        let pageBtn = document.createElement('span');
                                        pageBtn.textContent = `Page: ${currentPage} of ${totalPages || 1}`;
                                        paginationContainer.appendChild(pageBtn);
                                        console.log(currentPage == totalPages, currentPage, totalPages);
                                        
                                        let firstBtn = createButton('First', () => renderPage(1), currentPage == 1);
                                        let prevBtn = createButton('<', () => renderPage(currentPage - 1), currentPage == 1);
                                        let nextBtn = createButton('>', () => renderPage(currentPage + 1), currentPage == totalPages);
                                        let lastBtn = createButton('Last', () => renderPage(totalPages), currentPage == totalPages);

                                        paginationContainer.append(firstBtn, prevBtn, nextBtn, lastBtn);
                                    }

                                    function createButton(text, action, disabled) {
                                        let btn = document.createElement('button');
                                        btn.textContent = text;
                                        btn.disabled = disabled;
                                        btn.addEventListener('click', action);
                                        return btn;
                                    }

                                    function applyFilter() {
                                        let selectedKeyword = filterDropdown.value;
                                        filteredItems = selectedKeyword === 'all' 
                                            ? transactionItems 
                                            : transactionItems.filter(item => item.getAttribute('data-keyword') === selectedKeyword);

                                        currentPage = 1;
                                        renderPage(1);
                                    }

                                    filterDropdown.addEventListener('change', applyFilter);

                                    if (transactionItems.length > itemsPerPage) {
                                        renderPage(1);
                                    } else {
                                        renderPage(1);
                                        transactionItems.forEach(item => item.classList.add('displayData'));
                                    }
                                });
                            </script>

                            <style>
                                .transaction-item { display: none !important; }
                                .transaction-item.displayData { display: flex !important; }
                                #pagination { margin-top: 20px; }
                                #pagination button {
                                    padding: 3px 15px;
                                    background: #35074a;
                                    color: white;
                                    border: 1px solid #35074a;
                                    margin-inline: 2px;
                                    cursor: pointer;
                                }
                                #pagination button:disabled { opacity: 0.5 !important; }
                                #pagination span { display: block; margin-bottom: 5px; margin-inline: 5px; }
                            </style>
                        </div>
                        <div class="col-md-4">
                            <div class="price-stats bg-light mt-4">
                                <h4 class="mb-4 justify-content-between d-flex">
                                    <span>Price Stats</span>
                                    {{-- <button type="button" class="btn-sm btn-main history" data-bs-toggle="modal" data-bs-target="#walletModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                          </svg>
                                    </button> --}}
                                </h4>
                                <div class="d-flex justify-content-between">
                                    <h6>Direct Income</h6>
                                    <p><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('directIncome') ?? 0 }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>Team Performance</h6>
                                    <p><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('teamPerform') ?? 0 }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>AutoPool Income</h6>
                                    <p><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('autopool') ?? 0 }}</p>
                                </div>
                                <hr class="mt-0">
                                <div class="d-flex justify-content-between">
                                    <h6>Total</h6>
                                    <p class="btn-sm btn-warning"><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('total') ?? 0 }}</p>
                                </div>
                                <!-- <div class="d-flex justify-content-between">
                                    <h6>TDS Charges</h6>
                                    <p> - <sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('tds') ?? 0 }}</p>
                                </div> -->
                                <div class="d-flex justify-content-between">
                                    <h6> Charges</h6>
                                    <p> - <sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('adminCharges') ?? 0 }}</p>
                                </div>
                                <!-- <hr class="mt-0">
                                <div class="d-flex justify-content-between">
                                    <h6>My Income</h6>
                                    <p class="btn-sm btn-success"><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('myIncome') ?? 0 }}</p>
                                </div> -->
                                <!-- <div class="d-flex justify-content-between">
                                    <h6>Received Money</h6>
                                    <p class="btn-sm btn-info">+ <sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('received') ?? 0 }}</p>
                                </div> -->
                                <div class="d-flex justify-content-between">
                                    <h6>Net Withdrawal</h6>
                                    <p class="btn-sm btn-danger">- <sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey('withdrawls') - authUser()->walletIncomesByKey('adminCharges') ?? 0 }}</p>
                                </div>
                                {{-- <div class="d-flex justify-content-between">
                                    <h6>Payout Generated</h6>
                                    <p class="btn-sm btn-warning">- <sup><i class="bx bx-rupee"></i></sup>{{ $pinBuys ?? 0 }}</p>
                                </div> --}}
                                <hr class="mt-0">
                                <div class="d-flex justify-content-between">
                                    <h6>Total Income</h6>
                                    <p class="btn-sm btn-success"><sup><i class="bx bx-rupee"></i></sup>{{ authUser()->walletIncomesByKey() ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-labelledby="walletModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-sitecolor ">
                <h5 class="modal-title text-white " id="walletModalLabel">Paid Till Now</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="price-stats modal-price-stats bg-light">
                        <div class="d-flex justify-content-between">
                            <h6>Direct Income</h6>
                            <p><sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('direct_income') ?? 0 }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Team Performance</h6>
                            <p><sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('binary_income') ?? 0 }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Autopool Income</h6>
                            <p><sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('ad_income') ?? 0 }}</p>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between">
                            <h6>Total</h6>
                            <p class="btn-sm btn-warning"><sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('total_income') ?? 0 }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>TDS Charges</h6>
                            <p> - <sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('tds') ?? 0 }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Admin Charges</h6>
                            <p> - <sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('admin_charges') ?? 0 }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Transacted Money</h6>
                            <p> - <sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->walletTransations?->where('status', 0)?->whereIn('keyword', ['transfer', 'buy_pin'])?->sum('amount') ?? 0 }}</p>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between">
                            <h6>Total Paid</h6>
                            <p class="btn-sm btn-success"><sup><i class="bx bx-rupee"></i></sup>{{ authUser('member')?->userPayouts?->sum('total_paid') ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="transfer-money-modal">
                        @php
                            $isDisabled = authUser()->walletIncomesByKey() < 1;
                        @endphp
                        @if ($isDisabled)
                            <p class="text-danger"><b>Warning: </b>Sorry, You don't have enough amount in your Wallet. Minimum amount to transfer is <b>₹1</b></p>
                        @endif
                        {!! Form::open(['route' => 'member.wallet.transaction', 'method' => 'POST','onsubmit="ajaxFormSubmit($(this))"']) !!}
                        <span class="bold">Wallet Amount: </span>
                        <button class="btn-sm btn-warning">
                            <sup><i class="bx bx-rupee"></i></sup>
                            <span id="wallet_amount" data-value="{{ authUser()->walletIncomesByKey() }}">{{ authUser()->walletIncomesByKey() }}</span>
                        </button>
                        @if (!$isDisabled)
                            <input type="hidden" name="type" value="transfer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('amount','Amount') !!}
                                        {!! Form::number('amount',null,['class'=>'form-control','id' => 'transfer-money-amount', 'placeholder'=>'500, 1000, 1500,...', 'disabled' => $isDisabled]) !!}                                    
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 parent_to_user">
                                    <div class="form-group">
                                        {!! Form::label('to_user','To User (ID)') !!}
                                        {!! Form::text('to_user',null,['class'=>'form-control','placeholder'=>'Enter User ID', 'id' => 'transfer_to_user', 'disabled' => $isDisabled]) !!}
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 otp">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            {!! Form::label('otp','OTP Varification') !!}
                                            @if (authUser()->member_id == 'company' || authUser()->member_id == 'Company')
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="skip_otp" name="skip_otp" value="1">
                                                    <label for="skip_otp">Skip OTP</label>
                                                </div>
                                            @endif
                                        </div>
                                        {!! Form::text('otp',null,['class'=>'form-control','placeholder'=>'Enter OTP', 'id' => 'email_otp', 'disabled' => $isDisabled]) !!}
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 d-none" id="otp_resend">
                                    
                                </div>
                                <div class="col-md-6 mt-3">
                                    <button class="btn btn-info btn-sm" id="send_otp">Send OTP</button>
                                </div>  
                                <div class="col-md-6 mt-3 text-end">
                                    <input type="submit" value="Transfer Money" class="btn btn-success btn-sm" id="transfer-money">
                                    {{-- <button class="btn btn-warning btn-sm" id="verify_otp">Verify</button> --}}
                                </div>
                            </div>
                        @endif
                        {!! Form::close() !!}
                    </div>
                    <div class="buy-pin-modal">
                        @php
                            $isDisabled = authUser()->walletIncomesByKey() < 1;
                        @endphp
                        @if ($isDisabled)
                            <p class="text-danger"><b>Warning: </b>Sorry, You don't have enough amount in your Wallet.</p>
                        @else
                            {!! Form::open(['route' => 'member.wallet.transaction', 'method' => 'POST']) !!}
                            <input type="hidden" name="type" value="buy_pin">
                            @php
                                $joiningKits = \App\Models\JoiningKit::get();
                            @endphp
                            <div id="buy_pin_form">
                                <label for="joining_kit_id">Select Kit<span class="text-danger">*</span></label>
                                <select name="joining_kit_id" id="joining_kit_id" class="form-control">
                                    <option value="" data-amount="0">--Selectc Kit--</option>
                                    @foreach ($joiningKits as $joiningKit)
                                        <option value="{{ encrypt($joiningKit->id) }}" data-amount="{{ $joiningKit->amount }}">{{ $joiningKit->kit_name }} ( ₹{{ $joiningKit->amount }} )</option>
                                    @endforeach
                                </select>
                                <div class="text-danger mt-2">
                                    <b>Note: </b> If you buy the pin then <sup><i class="bx bx-rupee"></i></sup><span id="kit_amount">0</span> amount will be deducted from your wallet.
                                </div>
                                <div class="confirmation mt-2 text-center d-none">
                                    <h4>Are you Sure?</h4>
                                    <p>You want to purchase this Pin!</p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Yes" class="btn btn-success mx-1" id="buy-pin">
                                    <a href="javascript:void(0)" class="btn btn-danger mx-1" data-bs-dismiss="modal">No</a>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    @parent
    <style>
        .header {
            background: linear-gradient(135deg, #12a0bf, #015a78);
            color: #fff;
            padding: 30px;
            border-radius: 0px 0px 100px 100px;
        }
        .header h1 {
            font-size: 1.5rem;
            color: white;
        }
        .transaction-list, .price-stats {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .transaction-item {
            border-bottom: 1px solid #f1f1f1;
            padding: 10px 0;
        }
        .transaction-item:last-child {
            border-bottom: none;
        }
        .transaction-item .amount {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .price-stats h6 {
            font-size: 0.9rem;
        }
        .btn-custom {
            background: #007bff;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background: #0056b3;
        }
        .bg-gradient-sitecolor {
            background: linear-gradient(135deg, #5e5264, #0e0019 50%, #5e5264) !important;
        }
    </style>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).on('click', '.transferMoney', function(e) {
            e.preventDefault();
            showWalletModal('money');
        });
        $(document).on('click', '.history', function(e) {
            e.preventDefault();
            showWalletModal('history');
        });
        $(document).on('click', '.buyPin', function(e) {
            e.preventDefault();
            showWalletModal('pin');
        });
        function showWalletModal(type) {
            $('.transfer-money-modal').hide();
            $('.modal-price-stats').hide();
            $('.buy-pin-modal').hide();
            $('#walletModal').modal('show');
            let modalLabel = $('#walletModalLabel');
            if (type == 'money') {
                modalLabel.html('Transfer Your Money?');
                $('.transfer-money-modal').show();
            } else if(type == 'history') {
                modalLabel.html('Paid Till Now');
                $('.modal-price-stats').show();
            } else if (type == 'pin') {
                modalLabel.html('Want to Buy Pin?');
                $('.buy-pin-modal').show();
            }
        }
        $(document).on('input', '#transfer-money-amount', function() {
            checkAmount($(this));
        });
        $(document).on('focusout', '#transfer-money-amount', function() {
            checkAmount($(this), 'focusout');
        });
        function checkAmount(selector, onType = 'input') {
            selector.parents('.form-group').find('.errro-message').remove();
            let amount = selector.val();
            let walletAmount = $(document).find('#wallet_amount').data('value');
            if (amount < 1) {
                selector.addClass('is-invalid');
                selector.parents('.form-group').append('<span class="errro-message text-danger">Amount must be at least ₹1.</span>')
                if (onType != 'input') {
                    selector.val('');
                }
            } else if (amount > walletAmount) {
                selector.addClass('is-invalid');
                selector.parents('.form-group').append('<span class="errro-message text-danger">Insufficient balance</span>')
                if (onType != 'input') {
                    selector.val('');
                }
            } else {
                selector.removeClass('is-invalid');
            }
        }
        $(document).on('change', '#joining_kit_id', function() {
            var selectedOption = $(this).find('option:selected');
            var amount = selectedOption.data('amount');
            let pinForm = $(document).find('#buy_pin_form');
            pinForm.find('#kit_amount').text(amount);
            if (amount > 0) {
                pinForm.find('.confirmation').removeClass('d-none');
            } else {
                pinForm.find('.confirmation').addClass('d-none');
            }
        });
        $(document).on('blur', '#transfer_to_user', function() {
            let username = $(this).val();
            var messageText = $(this).parents('.form-group').find('.invalid-feedback');
            $.ajax({
                type: 'GET',
                url: route()+'/member/sponsor/validate',
                data: {
                    sponsor: username,
                    is_for:'transfer_money'
                },
                success: function(res){
                    if(res.status){
                        messageText.text(res.message).removeClass('text-danger d-block').addClass('text-success d-block');
                    }else{
                        messageText.text(res.message).removeClass('text-success d-block').addClass('text-danger d-block');
                    }
                }
            }) 
        });
        $(document).on('click','#send_otp',function(){
            $(this).attr('disabled',true);
            $('#otp_resend').removeClass('d-none');
            var time = 60;
            setInterval(() => {
                time--;
                if(time > 0){
                    $('#otp_resend').html(`<small class="text-muted">Wait for ${time} seconds to resend OTP, if you did not receive it.`);
                }else{
                    $(this).removeAttr('disabled');
                    $('#otp_resend').addClass('d-none');
                }
            }, 1000);
            $.ajax({
                url:`{{route('send.otp')}}`,
                type:'get',
                success:function(res){
                    if(res.status){
                        toasterMessanger.success('Success',res.message);
                    }else{
                        toasterMessanger.error('Error',res.message);
                    }
                }
            });
        })
    </script>
@endsection
