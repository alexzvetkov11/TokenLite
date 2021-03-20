@extends('layouts.admin')
@section('title', ucfirst($is_page) . ' Entity Type')
@section('content')

    <div class="page-content">
        <div class="container">
            @include('layouts.messages')
            @include('vendor.notice')
            <div class="card content-area content-area-mh">
                <div class="card-innr">
                    <div class="card-head has-aside">
                        <h4 class="card-title">Jurisdictions</h4>
                        <div class="card-opt data-action-list d-md-inline-flex">
                            <a href="#" data-toggle="modal" data-target="#addJurisdiction"
                                class="btn btn-auto btn-sm btn-primary">
                                <em class="fas fa-plus-circle"> </em><span>Add <span
                                        class="d-none d-md-inline-block">Jurisdiction</span></span>
                            </a>
                        </div>
                    </div>

                    <div class="gaps-1x"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right position-relative">
                                <a href="#" class="btn btn-light-alt btn-xs dt-filter-text btn-icon toggle-tigger"> <em
                                        class="ti ti-settings"></em> </a>
                                <div
                                    class="toggle-class toggle-datatable-filter dropdown-content dropdown-dt-filter-text dropdown-content-top-left text-left">
                                    <form class="update-meta" action="#" data-type="jurisdiction_page_meta">
                                        <ul class="dropdown-list">
                                            <li>
                                                <h6 class="dropdown-title">Show</h6>
                                            </li>
                                            <li {!! gmvl('jurisdiction_per_page', 10) == 10 ? ' class="active"' : '' !!}>
                                                <a href="#" data-meta="perpage=10">10</a>
                                            </li>
                                            <li {!! gmvl('jurisdiction_per_page', 10) == 20 ? ' class="active"' : '' !!}>
                                                <a href="#" data-meta="perpage=20">20</a>
                                            </li>
                                            <li {!! gmvl('jurisdiction_per_page', 10) == 50 ? ' class="active"' : '' !!}>
                                                <a href="#" data-meta="perpage=50">50</a>
                                            </li>
                                        </ul>
                                        <ul class="dropdown-list">
                                            <li>
                                                <h6 class="dropdown-title">Order By</h6>
                                            </li>
                                            <li {!! gmvl('jurisdiction_order_by', 'jurisdiction_name') == 'jurisdiction_name' ? ' class="active"' : '' !!}>
                                                <a href="#" data-meta="orderby=jurisdiction_name">Jurisdiction</a>
                                            </li>
                                            <li {!! gmvl('jurisdiction_order_by', 'jur_status') == 'jur_status' ? ' class="active"' : '' !!}>
                                                <a href="#" data-meta="orderby=jur_status">Status</a>
                                            </li>
                                            {{-- <li{!! gmvl('user_order_by', 'id' )=='token' ? ' class="active"' : '' !!}>
                                                    <a href="#" data-meta="orderby=token">Token</a></li>
                                        </ul> --}}
                                            <ul class="dropdown-list">
                                                <li>
                                                    <h6 class="dropdown-title">Order</h6>
                                                </li>
                                                <li {!! gmvl('jurisdiction_ordered', 'DESC') == 'DESC' ? ' class="active"' : '' !!}>
                                                    <a href="#" data-meta="ordered=DESC">DESC</a>
                                                </li>
                                                <li {!! gmvl('jurisdiction_ordered', 'DESC') == 'ASC' ? ' class="active"' : '' !!}>
                                                    <a href="#" data-meta="ordered=ASC">ASC</a>
                                                </li>
                                            </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-between pdb-1x" style="background-color: #f9fcff">
                        <div class="col-9 col-sm-6 text-left">
                            <div class="dataTables_filter pt-3">
                                <input type="search" id="search_table" class="form-control form-control-sm"
                                    placeholder="Type in to Search" aria-controls="DataTables_Table_0">
                            </div>
                        </div>
                        <div class="col-3 text-right">
                            <div class="data-table-filter relative d-inline-block"></div>
                        </div>
                    </div>

                    @if ($juris->total() > 0)
                        <table class="data-table dt-filter-init user-list pt-3">
                            <thead>
                                <tr class="data-item data-head">
                                    {{-- <th class="data-col filter-data dt-user ">Entity Type
                                    </th> --}}
                                    <th class="data-col filter-data dt-email">Jurisdictions</th>
                                    <th class="data-col dt-status"> Status</th>
                                    <th class="data-col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($juris as $jur)
                                    <tr class="data-item ">
                                        <td class="data-col dt-email">
                                            <span class="lead user-name text-wrap">{{ $jur->jurisdiction_name }}</span>
                                        </td>
                                        <td class="data-col data-col-wd-md dt-status" style="width:50px">
                                            <span
                                                class="dt-status-md badge badge-outline badge-md badge-{{ __status($jur->jur_status, 'status') }}">{{ __status($jur->jur_status, 'text') }}</span>
                                            <span
                                                class="dt-status-sm badge badge-sq badge-outline badge-md badge-{{ __status($jur->jur_status, 'status') }}">{{ substr(__status($jur->jur_status, 'text'), 0, 1) }}</span>
                                        </td>
                                        <td class="data-col text-right" style="width:70px">
                                            <div class="relative d-inline-block">
                                                <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                    <em class="ti ti-more-alt"></em></a>
                                                <div class="toggle-class dropdown-content dropdown-content-top-left">
                                                    <ul class="dropdown-list more-menu-{{ $jur->id }}">
                                                        <li>
                                                            <a href="#" data-toggle="modal" data-target="#editJurisdiction"
                                                                data-id="{{ $jur->id }}"
                                                                data-juris="{{ $jur->jurisdiction_name }}"
                                                                data-langcode="{{ $jur->check_lang->code }}"
                                                                data-curcode="{{ $jur->check_currency->cur_code }}"
                                                                data-statue={{ $jur->jur_status }}
                                                                class="user-action front editJurisdiction">
                                                                <em class="fas fa-edit"></em>Edit
                                                            </a>
                                                            <a href="#" data-uid="{{ $jur->id }}"
                                                                data-type="delete_user"
                                                                data-url="{{ route('admin.ajax.juris.delete', $jur->id) }}"
                                                                class="user-action front"
                                                                data-title="Are you sure you want to delete this Jurisdiction?">
                                                                <em class="fas fa-trash-alt"></em>Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- .data-item --}}
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="bg-light text-center rounded pdt-5x pdb-5x">
                            <p><em class="ti ti-server fs-24"></em><br>
                                {{ $is_page == 'all' ? 'No investor / user found!' : 'No ' . $is_page . ' user here!' }}
                            </p>
                            <p><a class="btn btn-primary btn-auto" href="{{ route('admin.users', 'user') }}">
                                    View All Users</a></p>
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
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')

    <div class="modal fade" id="addJurisdiction" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Add New Jurisdiction</h3>
                    <div class="gaps-1x"></div>
                    <form method="POST" class="adduser-form validate-modern" id="addJurisForm" autocomplete="false"
                        action="{{ route('admin.ajax.juris.add') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Jurisdiction</label>
                                    <div class="input-wrap">
                                        <input name="juris_name" class="input-bordered" required="required" type="text"
                                            placeholder="Add Jurisdiction">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Statutory Language</label>
                                    <div class="input-wrap">
                                        <select class="select select-block select-bordered" name="lang_code">
                                            <option value="" default>Select Option</option>
                                            @foreach ($languages as $lang)
                                                <option value="{{ $lang->id }}">{{ $lang->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Main Currency</label>
                                    <div class="input-wrap">
                                        <select class="select select-block select-bordered" name="cur_code">
                                            <option value="" default>Select Option</option>
                                            @foreach ($currencies as $cur)
                                                <option value="{{ $cur->id }}">{{ $cur->cur_label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Status</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Active</span>
                                        <input class="input-switch" name="statue_switcher" type="checkbox"
                                            id="addstatue_switcher">
                                        <label for="addstatue_switcher">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">Add Jurisdiction</button>
                    </form>
                </div>
            </div>
            {{-- .modal-content --}}
        </div>
        {{-- .modal-dialog --}}
    </div>

    <div class="modal fade" id="editJurisdiction" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Edit Jurisdiction</h3>
                    <div class="gaps-1x"></div>
                    <form method="Post" class="adduser-form validate-modern" id="editJuristForm" autocomplete="false"
                        action="{{ route('admin.ajax.juris.edit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Jurisdiction</label>
                                    <div class="input-wrap">
                                        <input name="juris_name" class="input-bordered" required="required" type="text"
                                            placeholder="Change Jurisdiction">
                                        <input name="juris_id" type="hidden">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Statutory Language</label>
                                    <div class="input-wrap">
                                        <select class="select select-block select-bordered" name="lang_code">
                                            @foreach ($languages as $lang)
                                                <option value="{{ $lang->id }}">{{ $lang->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Main Currency</label>
                                    <div class="input-wrap">
                                        <select class="select select-block select-bordered" name="cur_code">
                                            @foreach ($currencies as $cur)
                                                <option value="{{ $cur->id }}">{{ $cur->cur_label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">Status</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Active</span>
                                        <input class="input-switch" name="statue_switcher" type="checkbox"
                                            id="editstatue_switcher">
                                        <label for="editstatue_switcher">Enable</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">Change Jurisdiction</button>
                    </form>
                </div>
            </div>
            {{-- .modal-content --}}
        </div>
        {{-- .modal-dialog --}}
    </div>

    <div class="modal fade" id="EmailUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Send Email to User </h3>
                    <div class="msg-box"></div>
                    <form class="validate-modern" id="emailToUser" action="{{ route('admin.ajax.users.email') }}"
                        method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Email Subject</label>
                            <div class="input-wrap">
                                <input type="text" name="subject" class="input-bordered cls" placeholder="New Message">
                            </div>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Email Greeting</label>
                            <div class="input-wrap">
                                <input type="text" name="greeting" class="input-bordered cls" placeholder="Hello User">
                            </div>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Your Message</label>
                            <div class="input-wrap">
                                <textarea required="required" name="message"
                                    class="input-bordered cls input-textarea input-textarea-sm" type="text"
                                    placeholder="Write something..."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </form>
                </div>
            </div>{{-- .modal-content --}}
        </div>{{-- .modal-dialog --}}
    </div>

@endsection

@push('footer')
    <script type="text/javascript">
        (function($) {
            var table = $('.data-table').DataTable({
                "destroy": true,
                'scrollY': 800,
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,
                "responsive": true,
                "autoWidth": false,
            });


        })(jQuery);

    </script>

@endpush
