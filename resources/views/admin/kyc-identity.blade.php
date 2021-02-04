@extends('layouts.admin')
@section('title', ucfirst($is_page) . ' KYC Identity')


@section('content')

    <div class="page-content">
        <div class="container">
            @include('layouts.messages')
            @include('vendor.notice')
            <div class="card content-area content-area-mh">
                <div class="card-innr">
                    <div class="card-head has-aside">
                        {{-- <h4 class="card-title">{{ ucfirst($is_page) }} KYC Application
                        </h4> --}}
                        <h4 class="card-title"> {{ __('KYC Applications: Identity') }}</h4>
                        <div class="card-opt">
                            <ul class="btn-grp btn-grp-block guttar-20px">
                                <li>
                                    <a href="javascript:void(0)" data-type="kyc_settings"
                                        class="btn btn-auto btn-sm btn-primary get_kyc">
                                        <em class="ti ti-settings"></em><span>KYC <span
                                                class="d-none d-md-inline-block">Form</span> Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="page-nav-wrap">
                        <div class="page-nav-bar justify-content-between bg-lighter">
                          
                            <div class="search flex-grow-1 w-100 w-sm-auto">
                                {{-- <form action="{{ route('admin.kycs') }}" method="GET" autocomplete="off"> --}}
                                <div class="input-wrap">
                                    <span class="input-icon input-icon-left"><em class="ti ti-search"></em></span>
                                    <input type="search" class="input-solid input-transparent"
                                        placeholder="Quick search with name/id" value="{{ request()->get('s', '') }}"
                                        name="s" id="search_table">
                                </div>
                                {{-- </form> --}}
                            </div>

                            <div class="tools w-100 w-sm-auto">
                                <ul class="btn-grp guttar-8px">
                                    <li><a href="#"
                                            class="btn btn-light btn-sm btn-icon btn-outline bg-white advsearch-opt">
                                            <em class="ti ti-panel"></em> </a></li>
                                    <li>
                                        <div class="relative">
                                            <a href="#"
                                                class="btn btn-light bg-white btn-sm btn-icon toggle-tigger btn-outline"><em
                                                    class="ti ti-server"></em> </a>
                                            <div
                                                class="toggle-class dropdown-content dropdown-content-sm dropdown-content-center shadow-soft">
                                                <ul class="dropdown-list">
                                                    <li>
                                                        <h6 class="dropdown-title">Export</h6>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('admin.export', array_merge(['table' => 'kyc_identity', 'format' => 'entire'], request()->all())) }}">Entire</a>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('admin.export', array_merge(['table' => 'kyc_identity', 'format' => 'minimal'], request()->all())) }}">Minimal</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="relative">
                                            <a href="#"
                                                class="btn btn-light bg-white btn-sm btn-icon toggle-tigger btn-outline"><em
                                                    class="ti ti-settings"></em> </a>
                                            <div
                                                class="toggle-class dropdown-content dropdown-content-sm dropdown-content-center shadow-soft">
                                                <form class="update-meta" action="#" data-type="kyci_page_meta">
                                                   
                                                    <ul class="dropdown-list">
                                                        <li>
                                                            <h6 class="dropdown-title">Order By</h6>
                                                        </li>
                                                        <li {!! gmvl('kyci_order_by', 'created_at' )=='created_at'
                                                            ? ' class="active"' : '' !!}>
                                                            <a href="#" data-meta="orderby=created_at">Submitted</a>
                                                        </li>
                                                        <li {!! gmvl('kyci_order_by', 'updated_at' )=='updated_at'
                                                            ? ' class="active"' : '' !!}>
                                                            <a href="#" data-meta="orderby=updated_at">Updated</a>
                                                        </li>
                                                    </ul>
                                                    <ul class="dropdown-list">
                                                        <li>
                                                            <h6 class="dropdown-title">Order</h6>
                                                        </li>
                                                        <li {!! gmvl('kyci_ordered', 'DESC' )=='DESC' ? ' class="active"'
                                                            : '' !!}>
                                                            <a href="#" data-meta="ordered=DESC">DESC</a>
                                                        </li>
                                                        <li {!! gmvl('kyci_ordered', 'DESC' )=='ASC' ? ' class="active"'
                                                            : '' !!}>
                                                            <a href="#" data-meta="ordered=ASC">ASC</a>
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="search-adv-wrap hide">
                            <form class="adv-search" id="adv-search" action="{{ route('admin.kycs') }}" method="GET"
                                autocomplete="off">
                                <div class="adv-search">
                                    <div class="row align-items-end guttar-20px guttar-vr-15px">
                                        <div class="col-sm-4 col-lg-2 col-mb-6">
                                            <div class="input-wrap input-with-label">
                                                <label
                                                    class="input-item-label input-item-label-s2 text-exlight">Status</label>
                                                <select name="state" class="select select-sm select-block select-bordered"
                                                    data-dd-class="search-off">
                                                    <option value="">Any Status</option>
                                                    <option {{ request()->get('state') == 'pending' ? ' selected' : '' }}
                                                        value="pending">Pending</option>
                                                    <option {{ request()->get('state') == 'missing' ? ' selected' : '' }}
                                                        value="missing">Missing</option>
                                                    <option
                                                        {{ request()->get('state') == 'approved' ? ' selected' : '' }}
                                                        value="approved">Approved</option>
                                                    <option {{ request()->get('state') == 'deleted' ? ' selected' : '' }}
                                                        value="deleted">Deleted</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg-2 col-mb-6">
                                            <div class="input-wrap">
                                                <input type="hidden" name="filter" value="1">
                                                <button class="btn btn-sm btn-sm-s2 btn-auto btn-primary">
                                                    <em class="ti ti-search width-auto"></em><span>Search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if (request()->get('filter') || request()->s)
                            <div class="search-adv-result">
                                <div class="search-info">Found <span class="search-count">{{ $kyci->total() }}</span>
                                    Applications.</div>
                                <ul class="search-opt">
                                    @if (request()->get('search'))
                                        <li><a href="{{ qs_url(qs_filter('search')) }}">Search
                                                <span>'{{ request()->get('search') }}'</span>{{ !empty(request()->by) ? ' (' . ucfirst(request()->by) . ')' : '' }}</a>
                                        </li>
                                    @endif
                                    @if (request()->get('state'))
                                        <li><a href="{{ qs_url(qs_filter('state')) }}">Status:
                                                <span>{{ ucfirst(request()->get('state')) }}</span></a></li>
                                    @endif
                                    @if (request()->get('doc'))
                                        <li><a href="{{ qs_url(qs_filter('doc')) }}">DOC Type:
                                                <span>{{ ucfirst(request()->get('doc')) }}</span></a></li>
                                    @endif
                                    <li><a href="{{ route('admin.kycs') }}" class="link link-underline">Clear All</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                    @if ($kyci->total() > 0)
                        <table class="data-table kyc-list">
                            <thead>
                                <tr class="data-item data-head">
                                    <th class="data-col filter-data dt-user">{{ __('User') }}</th>
                                    {{-- <th class="data-col dt-doc-type">{{__('First & Middle Names')}}</th>
                                    <th class="data-col dt-doc-front">{{__('Last Name')}}</th> --}}
                                    <th class="data-col dt-doc-back">{{ __('Citizenship') }}</th>
                                    <th class="data-col dt-sbdate">{{ __('Submitted') }}</th>
                                    <th class="data-col dt-sbdate">{{ __('Updated') }}</th>
                                    <th class="data-col dt-status">{{ __('Status') }}</th>
                                    <th class="data-col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kyci as $kyc)
                                    <tr class="data-item data-item-{{ $kyc->id }}">
                                        <td class="data-col dt-user">
                                            <span class="d-none">{{ $kyc->status }}</span>
                                            <span
                                                class="lead user-name">{{ _x($kyc->first_middle_names) . ' ' . _x($kyc->last_name) }}</span>
                                            <span class="sub user-id">{{ set_id($kyc->user_id) }}</span>
                                        </td>


                                        <td class="data-col dt-email">
                                            <span class="sub sub-s2 sub-email">{{ $kyc->citizenship }}</span>
                                        </td>

                                        <td class="data-col dt-sbdate">
                                            <span class="sub sub-s2 sub-time">{{ _date($kyc->updated_at) }}</span>
                                        </td>
                                        <td class="data-col dt-sbdate">
                                            <span class="sub sub-s2 sub-time">{{ _date($kyc->updated_at) }}</span>
                                        </td>
                                        <td class="data-col dt-status" style="width:60px">
                                            <span
                                                class="dt-status-md badge badge-outline badge-md badge-{{ __status($kyc->status, 'status') }}">{{ __status($kyc->status, 'text') }}</span>
                                            <span
                                                class="dt-status-sm badge badge-sq badge-outline badge-md badge-{{ __status($kyc->status, 'status') }}">{{ substr(__status($kyc->status, 'text'), 0, 1) }}</span>
                                        </td>
                                        <td class="data-col text-right" style="width:50px">
                                            <div class="relative d-inline-block">
                                                <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                    <em class="ti ti-more-alt"></em></a>
                                                <div class="toggle-class dropdown-content dropdown-content-top-left">
                                                    <ul class="dropdown-list more-menu more-menu-{{ $kyc->id }}">
                                                        <li>
                                                            <a href="{{route('admin.kyc.view', [$kyc->id, 'kyc_details']) }}">
                                                                <em class="ti ti-eye"></em> View Details
                                                            </a>
                                                        @if ($kyc->status != 'approved')
                                                            <a class="kyc_action kyc_approve" href="#"
                                                                    data-id="{{ $kyc->id }}" data-toggle="modal" data-target="#actionkyc">
                                                                    <em class="far fa-check-square"></em>Approve</a>
                                                            
                                                        @endif
                                                        @if ($kyc->status != 'rejected')
                                                            <a href="javascript:void(0)"
                                                                    data-current="{{ __status($kyc->status, 'status') }}"
                                                                    data-id="{{ $kyc->id }}" class="kyc_reject">
                                                                    <em class="fas fa-ban"></em>Reject</a>
                                                            
                                                        @endif
                                                        @if ($kyc->status == 'missing' || $kyc->status == 'rejected')
                                                            <a href="javascript:void(0)" data-id="{{ $kyc->id }}" class="kyc_delete">
                                                                    <em class="fas fa-trash-alt"></em>Delete</a>
                                                        @endif
                                                    </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="bg-light text-center rounded pdt-5x pdb-5x">
                            <p><em
                                    class="ti ti-server fs-24"></em><br>{{ $is_page == 'all' ? 'No KYC application found!' : 'No ' . $is_page . ' KYC application here!' }}
                            </p>
                            <p><a class="btn btn-primary btn-auto" href="{{ route('admin.kycs') }}">View All KYC
                                    Application</a></p>
                        </div>
                    @endif

                    @if ($pagi->hasPages())
                        <div class="pagination-bar">
                            <div class="d-flex flex-wrap justify-content-between guttar-vr-20px guttar-20px">
                                <div class="fake-class">
                                    <ul class="btn-grp guttar-10px pagination-btn">
                                        @if ($pagi->previousPageUrl())
                                            <li><a href="{{ $pagi->previousPageUrl() }}"
                                                    class="btn ucap btn-auto btn-sm btn-light-alt">Prev</a></li>
                                        @endif
                                        @if ($pagi->nextPageUrl())
                                            <li><a href="{{ $pagi->nextPageUrl() }}"
                                                    class="btn ucap btn-auto btn-sm btn-light-alt">Next</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="fake-class">
                                    <div class="pagination-info guttar-10px justify-content-sm-end justify-content-mb-end">
                                        <div class="pagination-info-text ucap">Page </div>
                                        <div class="input-wrap w-80px">
                                            <select class="select select-xs select-bordered goto-page"
                                                data-dd-class="search-{{ $pagi->lastPage() > 7 ? 'on' : 'off' }}">
                                                @for ($i = 1; $i <= $pagi->lastPage(); $i++)
                                                    <option value="{{ $pagi->url($i) }}"
                                                        {{ $pagi->currentPage() == $i ? ' selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="pagination-info-text ucap">of {{ $pagi->lastPage() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>{{-- .card-innr --}}
            </div>{{-- .card --}}
        </div>{{-- .container --}}
    </div>{{-- .page-content --}}

@endsection

@section('modals')

    <div class="modal fade" id="actionkyc" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Approve the KYC Information</h3>
                    <p>Please check details carefully of the application before take any action. User can not re-submit the
                        application if you invalidated this application.</p>
                    <form method="POST" id="kyc_status_form">
                        @csrf
                        <input type="hidden" name="req_type" value="update_kyc_status">
                        <input type="hidden" name="kyc_id" id="kyc_id" required="required">
                        <div class="input-item input-with-label">
                            <label class="input-item-label">Admin Note</label>
                            <textarea name="notes" class="input-bordered input-textarea input-textarea-sm"></textarea>
                        </div>
                        <div class="input-item">
                            <input class="input-checkbox" id="send-email" checked type="checkbox">
                            <label for="send-email">Send Notification to Applicant</label>
                        </div>
                        <div class="gaps-1x"></div>
                        <ul class="btn-grp guttar-20px">
                            <li><button name="status" data-value="approved" disabled
                                    class="update_kyc form-progress-btn btn btn-md btn-primary ucap">Approve</button></li>
                            <li><button name="status" data-value="missing" disabled
                                    class="update_kyc form-progress-btn btn btn-md btn-light ucap">Missing</button></li>
                            <li><button name="status" data-value="rejected" disabled
                                    class="update_kyc form-progress-btn btn btn-md btn-danger ucap">Reject</button></li>
                        </ul>
                    </form>
                </div>
            </div>{{-- .modal-content --}}
        </div>{{-- .modal-dialog --}}
    </div>
    {{-- Modal End --}}
@endsection
