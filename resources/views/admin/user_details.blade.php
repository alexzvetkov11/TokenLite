@extends('layouts.admin')
@section('title', 'User Details')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="card content-area">
                <div class="card-innr card-innr-fix">
                    <div class="card-head d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">User Details <em class="ti ti-angle-right fs-14"></em> <small class="tnx-id">{{ set_id($user->id) }}</small></h4>
                        <div class="d-flex align-items-center guttar-20px">
                            <div class="flex-col d-sm-block d-none">
                                <a href="{{ (url()->previous()) ? url()->previous() : route('admin.users') }}" class="btn btn-sm btn-auto btn-primary"><em class="fas fa-arrow-left mr-3"></em>Back</a>
                            </div>
                            <div class="flex-col d-sm-none">
                                <a href="{{route('admin.users')}}" class="btn btn-icon btn-sm btn-primary"><em class="fas fa-arrow-left"></em></a>
                            </div>
                            <div class="relative d-inline-block">
                                <a href="#" class="btn btn-dark btn-sm btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                                <div class="toggle-class dropdown-content dropdown-content-top-left">
                                    <ul class="dropdown-list more-menu-{{$user->id}}">
                                        <li><a class="user-email-action" href="#EmailUser" data-uid="{{ $user->id }}" data-toggle="modal"><em class="far fa-envelope"></em>Send Email</a></li>
                                        @if($user->id != save_gmeta('site_super_admin')->value)
                                            <li><a class="user-form-action user-action" href="#" data-type="reset_pwd" data-uid="{{ $user->id }}" ><em class="fas fa-shield-alt"></em>Reset Pass</a></li>
                                        @endif
                                        @if(Auth::id() != $user->id && $user->id != save_gmeta('site_super_admin')->value)
                                            @if($user->status != 'suspend')
                                                <li><a href="#" data-uid="{{ $user->id }}" data-type="suspend_user" class="user-action"><em class="fas fa-ban"></em>Suspend</a></li>

                                            @else
                                                <li><a href="#" data-uid="{{ $user->id }}" data-type="active_user" class="user-action"><em class="fas fa-ban"></em>Active</a></li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gaps-1-5x"></div>
                    <div class="data-details d-flex">
                        {{--                    <div class="fake-class">--}}
                        {{--                        <span class="data-details-title">Token Balance</span>--}}
                        {{--                        <span class="data-details-info large">{{ number_format($user->tokenBalance) }}</span>--}}
                        {{--                    </div>--}}
                        {{--                    <div class="fake-class">--}}
                        {{--                        <span class="data-details-title">Contributed</span>--}}
                        {{--                        <span class="data-details-info large">{{ number_format($user->contributed) }} <small>USD</small></span>--}}
                        {{--                    </div>--}}
                        <div class="status_user fake-class">
                            <span class="data-details-title">User Status</span>
                            <span class="badge badge-{{ __status($user->status, 'status' ) }} ucap">{{ $user->status }}</span>
                        </div>
                        <div>
                            <span class="data-details-title">Verified Status</span>
                            <ul class="data-vr-list">
                                <li><div class="data-state data-state-sm data-state-{{ $user->email_verified_at !== null ? 'approved' : 'pending'}}"></div> Email</li>
                                @php
                                    if(isset($user->kyc_info->status)){
                                        $user->kyc_info->status = str_replace('rejected', 'canceled',$user->kyc_info->status);
                                    }
                                @endphp
                                @if($user->role != 'admin')
                                    <li><div class="data-state data-state-sm data-state-{{ !empty($user->kyc_info) ? $user->kyc_info->status : 'missing' }}"></div> KYC</li>
                                @endif
                            </ul>
                        </div>

                    </div>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">Login Credientials</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">First Name</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->firstName ? optional($user->kyc_infoSingle)->firstName : '&nbsp;' !!}</div>
                        {{--                    </li>--}}{{-- li --}}{{--{!! $user->email ? $user->name : '&nbsp;' !!}--}}
                        <li>
                            <div class="data-details-head" >Email</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $user->email ? $user->email : '&nbsp;' !!}</div>
                        </li>
                        {{--                    --}}{{-- li --}}{{--{!! explode_user_for_demo($user->email, auth()->user()->type) !!}--}}
                    </ul>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">Personal Information</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">First Name</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->firstName ? optional($user->kyc_infoSingle)->firstName : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Last Name</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->lastName ? optional($user->kyc_infoSingle)->lastName : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Gender</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->gender ? optional($user->kyc_infoSingle)->gender : "&nbsp;" !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Date of Birth</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->dob ? _date(optional($user->kyc_infoSingle)->dob) : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Country of Birth</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->country_of_birth ?  optional($user->kyc_infoSingle)->country_of_birth : "&nbsp;" !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Place of Birth</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->place_of_birth ? $user->kyc_infoSingle->place_of_birth : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Nationality</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->nationality ? optional($user->kyc_infoSingle)->nationality : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Nationality Identification Number</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->nationality_id ? optional($user->kyc_infoSingle)->nationality_id : '&nbsp;' !!}</div>
                        </li>
                    </ul>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">Registered Address</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Country</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->country ? $user->kyc_infoSingle->country : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">State/Province</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->state ? $user->kyc_infoSingle->state : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        @if(isset($refered) && $refered && count($refered) > 0)
                            <li>
                                <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Zip/Postal Code</div>
                                <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->zip ? $user->kyc_infoSingle->zip : '&nbsp;' !!}</div>
                            </li>{{-- li --}}
                        @endif
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Town City</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->city ? $user->kyc_infoSingle->city : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Street Name</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->address1 ? $user->kyc_infoSingle->address1 : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Street / Building</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->address2 ? $user->kyc_infoSingle->address2 : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Floor/Unit</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->floor ? $user->kyc_infoSingle->floor : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                    </ul>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">ID Documents</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Identification Type</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->documentType ? $user->kyc_infoSingle->documentType : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            @if(optional($user->kyc_infoSingle)->document4 !== NULL)
                            <div class="data-details-head">ID Document Front</div>
                            <div class="data-doc-item data-doc-item-lg">
                                <div class="data-doc-image">
                                    @if(pathinfo(storage_path('app/'.optional($user->kyc_infoSingle)->document4), PATHINFO_EXTENSION) == 'pdf')
                                        <em class="kyc-file fas fa-file-pdf"></em>
                                    @else
                                        <img src="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document4 }}" style="height: 200px" alt="ID Document Front" title="" />                                     @endif
                                </div>
                                <ul class="data-doc-actions">
                                    <li><a href="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document4 }}" target="_blank" ><em class="ti ti-import"></em></a></li>
                                </ul>
                            </div>
                            @endif
                        </li>{{-- li --}}
                            {{--  <div class="gaps-3x"></div>  --}}
                            <li>
                                @if(optional($user->kyc_infoSingle)->document2 !== NULL)
                                <div class="data-details-head">ID Document Back</div>
                                <div class="data-doc-item data-doc-item-lg">
                                    <div class="data-doc-image">
                                        @if(pathinfo(storage_path('app/'.optional($user->kyc_infoSingle)->document2), PATHINFO_EXTENSION) == 'pdf')
                                            <em class="kyc-file fas fa-file-pdf"></em>
                                        @else
                                            <img src="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document2 }}" style="height: 200px" alt="ID Document Front" title="" />                                     @endif
                                    </div>
                                    <ul class="data-doc-actions">
                                        <li><a href="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document2 }}" target="_blank" ><em class="ti ti-import"></em></a></li>
                                    </ul>
                                </div>
                                @endif

{{--                                <div class="data-details-des"><img src="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document2 }}" style="height: 200px" alt="ID Document Front" title="" /></div>--}}
                            </li>{{-- li --}}

                    </ul>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">Address Document</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Proof of Address Type</div>
                            <div class="data-details-des" style="border-left: 0px">{!! optional($user->kyc_infoSingle)->addressType ? optional($user->kyc_infoSingle)->addressType : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            @if(optional($user->kyc_infoSingle)->document3 !== NULL)
                            <div class="data-details-head">Address Document</div>
                            <div class="data-doc-item data-doc-item-lg">
                                <div class="data-doc-image">
                                    @if(pathinfo(storage_path('app/'.optional($user->kyc_infoSingle)->document3), PATHINFO_EXTENSION) == 'pdf')
                                        <em class="kyc-file fas fa-file-pdf"></em>
                                    @else
                                        <img src="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document3 }}" style="height: 200px" alt="ID Document Front" title="" />                                     @endif
                                </div>
                                <ul class="data-doc-actions">
                                    <li><a href="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document3 }}" target="_blank" ><em class="ti ti-import"></em></a></li>
                                </ul>
                            </div>
                            @endif


{{--                            <div class="data-details-des"><img src="{{ explode('public', asset('/'))[0]."storage/app/".optional($user->kyc_infoSingle)->document3 }}" style="height: 200px" alt="ID Document Front" title="" /></div>--}}
                        </li>{{-- li --}}
                    </ul>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">Roles</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" >{!! $user->name ? $user->name : '&nbsp;' !!}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $user->role ? $user->role : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                    </ul>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">More Information</h6>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Joining Date</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $user->created_at ? _date($user->created_at) : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Referred By</div>
                            <div class="data-details-des" style="border-left: 0px">{!! ($user->referral != NULL && !empty($user->referee->name) ? '<span>'.$user->referee->name.' <small>('.set_id($user->referral).')</small></span>' : '<small class="text-light">Join without referral!</small>') !!}</div>
                        </li>{{-- li --}}
                        @if(isset($refered) && $refered && count($refered) > 0)
                            <li>
                                <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Total Referred</div>
                                <div class="data-details-des" style="border-left: 0px">{!! count($refered).' Contributors' !!}</div>
                            </li>{{-- li --}}
                        @endif
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">Reg Method</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $user->registerMethod ? ucfirst($user->registerMethod) : '&nbsp;' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">2FA Enabled</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $user->google2fa==1 ? 'Yes' : 'No' !!}</div>
                        </li>{{-- li --}}
                        <li>
                            <div class="data-details-head">Last Login</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $user->lastLogin && $user->email_verified_at !== null ? _date($user->lastLogin) : '<small class="text-light">Not logged yet!</small>' !!}</div>
                        </li>{{-- li --}}
                    </ul>
                </div>{{-- .card-innr --}}
            </div>{{-- .card --}}
        </div>{{-- .container --}}
    </div>{{-- .page-content --}}

    {{-- PWD Email Modal --}}
    <div class="modal fade" id="EmailUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-lg">
                    <h3 class="popup-title">Send Email to User </h3>
                    <div class="msg-box"></div>
                    <form id="emailToUser" action="{{ route('admin.ajax.users.email') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Subject</label>
                            <input type="text" name="subject" class="input-bordered cls " placeholder="Email Subject">
                            <span class="input-note">If blank It's will replace with default from EMail Template</span>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Greeting</label>
                            <input type="text" name="greeting" class="input-bordered cls " placeholder="Email Greeting">
                            <span class="input-note">If blank It's will replace with default from EMail Template</span>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Message</label>
                            <textarea required="required" name="message" class="input-bordered cls input-textarea input-textarea-sm" type="text" placeholder="Write something..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Send</button>
                    </form>
                </div>
            </div>{{-- .modal-content --}}
        </div>{{-- .modal-dialog --}}
    </div>
@endsection
