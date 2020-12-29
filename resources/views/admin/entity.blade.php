@extends('layouts.admin')
@section('title', ucfirst($is_page).' Entity Type')
@section('content')

<div class="page-content">
    <div class="container">
        @include('layouts.messages')
        @include('vendor.notice')
        <div class="card content-area content-area-mh">
            <div class="card-innr">
                <div class="card-head has-aside">
                    <h4 class="card-title">Entity Type</h4>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.addentity') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fas fa-plus-circle"> </em><span>Add <span class="d-none d-md-inline-block">Entity</span></span>
                        </a>
                    </div>
                </div>

                <div class="gaps-1x"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right position-relative">
                            <a href="#" class="btn btn-light-alt btn-xs dt-filter-text btn-icon toggle-tigger"> <em class="ti ti-settings"></em> </a>
                            <div class="toggle-class toggle-datatable-filter dropdown-content dropdown-dt-filter-text dropdown-content-top-left text-left">
                                <ul class="dropdown-list dropdown-list-s2">
                                    <li><h6 class="dropdown-title">{{ __('Types') }}</h6></li>
                                    <li>
                                        <input class="data-filter input-checkbox input-checkbox-sm" type="radio" name="tnx-type" id="type-all" checked value="">
                                        <label for="type-all">{{ __('Any Type') }}</label>
                                    </li>
                                    <li>
                                        <input class="data-filter input-checkbox input-checkbox-sm" type="radio" name="tnx-type" id="type-purchase" value="Purchase">
                                        <label for="type-purchase">{{ __('Purchase') }}</label>
                                    </li>
                                </ul>
                                <ul class="dropdown-list dropdown-list-s2">
                                    <li><h6 class="dropdown-title">{{ __('Status') }}</h6></li>
                                    <li>
                                        <input class="data-filter input-checkbox input-checkbox-sm" type="radio" name="tnx-status" id="status-all" checked value="">
                                        <label for="status-all">{{ __('Show All') }}</label>
                                    </li>
                                    <li>
                                        <input class="data-filter input-checkbox input-checkbox-sm" type="radio" name="tnx-status" id="status-approved" value="approved">
                                        <label for="status-approved">{{ __('Approved') }}</label>
                                    </li>
                                    <li>
                                        <input class="data-filter input-checkbox input-checkbox-sm" type="radio" name="tnx-status" value="pending" id="status-pending">
                                        <label for="status-pending">{{ __('Pending') }}</label>
                                    </li>
                                    <li>
                                        <input class="data-filter input-checkbox input-checkbox-sm" type="radio" name="tnx-status" value="canceled" id="status-canceled">
                                        <label for="status-canceled">{{ __('Canceled') }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                @if($entity->total() > 0)
                <table class="data-table dt-filter-init user-list">
                    <thead>
                        <tr class="data-item data-head">
                            <th class="data-col filter-data dt-user ">Entity Type</th>
                            <th class="data-col filter-data dt-email">Jurisdiction</th>
                            <th class="data-col dt-status"> Status</th>
                            <th class="data-col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entity as $en)
                        <tr class="data-item">
                            <td class="data-col dt-user">
                                <span class="lead user-name text-wrap">{{ $en->entity_type }}</span>
                            </td>
                            <td class="data-col dt-email">
                                <span class="lead user-name text-wrap">{{ $en->jurisdiction }}</span>
                            </td>
                            <td class="data-col data-col-wd-md dt-status">
                                <span class="dt-status-md badge badge-outline badge-md badge-{{ __status($en->status,'status') }}">{{ __status($en->status,'text') }}</span>
                                <span class="dt-status-sm badge badge-sq badge-outline badge-md badge-{{ __status($en->status,'status') }}">{{ substr(__status($en->status,'text'), 0, 1) }}</span>
                            </td>
                            <td class="data-col text-right">
                                <div class="relative d-inline-block">
                                    <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                                    <div class="toggle-class dropdown-content dropdown-content-top-left">
                                        <ul class="dropdown-list more-menu-{{$en->id}}">
                                            <li><a href="#"><em class="far fa-eye"></em> View Details</a></li>
                                            <li><a class="user-email-action" href="#" data-uid="{{ $en->id }}" data-toggle="modal"><em class="far fa-envelope"></em>Statutory Framework</a></li>
                                            <li><a href="javascript:void(0)" data-uid="{{ $en->id }}" data-type="deactivate" class="user-form-action user-action"><em class="fas fa-sign-out-alt"></em>Deactivate</a></li>
                                            <li>
                                                {{--  <a href="#" data-uid="{{ $user->id }}" data-type="delete_user" class="user-action front" data-url="{{route('admin.entity.delete_users',encrypt($en->id))}}">  --}}
                                                <a href="#" data-uid="{{ $en->id }}" data-type="delete_user" class="user-action front">
                                                    <em class="fas fa-ban"></em>
                                                    Delete
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
                        <p><em class="ti ti-server fs-24"></em><br>{{ ($is_page=='all') ? 'No investor / user found!' : 'No '.$is_page.' user here!' }}</p>
                        <p><a class="btn btn-primary btn-auto" href="{{ route('admin.users', 'user') }}">View All Users</a></p>
                    </div>
                @endif

                @if ($pagi->hasPages())
                <div class="pagination-bar">
                    <div class="d-flex flex-wrap justify-content-between guttar-vr-20px guttar-20px">
                        <div class="fake-class">
                            <ul class="btn-grp guttar-10px pagination-btn">
                                @if($pagi->previousPageUrl())
                                <li><a href="{{ $pagi->previousPageUrl() }}" class="btn ucap btn-auto btn-sm btn-light-alt">Prev</a></li>
                                @endif
                                @if($pagi->nextPageUrl())
                                <li><a href="{{ $pagi->nextPageUrl() }}" class="btn ucap btn-auto btn-sm btn-light-alt">Next</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="fake-class">
                            <div class="pagination-info guttar-10px justify-content-sm-end justify-content-mb-end">
                                <div class="pagination-info-text ucap">Page </div>
                                <div class="input-wrap w-80px">
                                    <select class="select select-xs select-bordered goto-page" data-dd-class="search-{{ ($pagi->lastPage() > 7) ? 'on' : 'off' }}">
                                        @for ($i = 1; $i <= $pagi->lastPage(); $i++)
                                        <option value="{{ $pagi->url($i) }}"{{ ($pagi->currentPage() ==$i) ? ' selected' : '' }}>{{ $i }}</option>
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
            {{-- .card-innr --}}
        </div>{{-- .card --}}
    </div>{{-- .container --}}
</div>{{-- .page-content --}}

@endsection

@section('modals')

<div class="modal fade" id="addUser" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="popup-body popup-body-md">
                <h3 class="popup-title">Add New User</h3>
                <form action="{{ route('admin.ajax.users.add') }}" method="POST" class="adduser-form validate-modern" id="addUserForm" autocomplete="false">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-item input-with-label">
                                <label class="input-item-label">User Type</label>
                                <select name="role" class="select select-bordered select-block" required="required">
                                    <option value="user">
                                        Regular
                                    </option>
                                    <option value="admin">
                                        Admin
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-item input-with-label">
                        <label class="input-item-label">First Name</label>
                        <div class="input-wrap">
                            <input name="name" class="input-bordered" minlength="3" required="required" type="text" placeholder="User First Name">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-item input-with-label">
                                <label class="input-item-label">Email Address</label>
                                <div class="input-wrap">
                                    <input class="input-bordered" required="required" name="email" type="email" placeholder="Email address">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-item input-with-label">
                                <label class="input-item-label">Password</label>
                                <div class="input-wrap">
                                    <input name="password" class="input-bordered" minlength="6" placeholder="Automatically generated if blank" type="password" autocomplete='new-password'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-item">
                        <input checked class="input-checkbox input-checkbox-sm" name="email_req" id="send-email" type="checkbox">
                        <label for="send-email">Required Email Verification
                        </label>
                    </div>
                    <div class="gaps-1x"></div>
                    <button class="btn btn-md btn-primary" type="submit">Add User</button>
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
                <form class="validate-modern" id="emailToUser" action="{{ route('admin.ajax.users.email') }}" method="POST" autocomplete="off">
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
                            <textarea required="required" name="message" class="input-bordered cls input-textarea input-textarea-sm" type="text" placeholder="Write something..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
            </div>
        </div>{{-- .modal-content --}}
    </div>{{-- .modal-dialog --}}
</div>

@endsection