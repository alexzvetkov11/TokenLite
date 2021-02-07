@extends('layouts.user')
@section('title', __('User Account'))
@php($has_sidebar = true)

@section('content')
@include('layouts.messages')
<div class="content-area card">
    <div class="card-innr">
        <div class="card-head">
            <h4 class="card-title">{{__('dashboard.account_detail')}}</h4>
        </div>
        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#personal-data">{{__('dashboard.general')}}</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#KYC">{{__('KYC')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#personalData">{{__('PERSONAL DATA')}}</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings">{{__('Settings')}}</a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-toggle="tab" href="#password">{{__('Password')}}</a>--}}
{{--            </li>--}}
        </ul>{{-- .nav-tabs-line --}}
        <div class="tab-content" id="profile-details">
            <div class="tab-pane fade show active" id="personal-data">
                <form class="" action="{{ route('user.ajax.account.update') }}" method="POST"  autocomplete="off">
                    @csrf
                    <input type="hidden" name="action_type" value="update_name">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-item input-with-label">
                                <label for="name" class="input-item-label">{{__('Display Name')}}</label>
                                <div class="input-wrap">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="input-bordered" type="text" id="name" name="name" required="required" 
                                            placeholder="{{ __('First and Middle Name') }}" value="{{ $user->name }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary">{{__('Update Name')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                </form>
                    
                <div class="row">
                    <form class="col-md-6" action="{{ route('user.ajax.account.update') }}" method="POST"  autocomplete="off">
                        @csrf
                        <input type="hidden" name="action_type" value="update_email">
                        <div class="input-item input-with-label">
                            <label for="email" class="input-item-label">{{__('Email Address')}}</label>
                            <div class="input-wrap">
                                <div class="row">
                                    <div class="col-md-9 pr-0">
                                        <input class="input-bordered" type="email" name="email" id="email" value="{{ $user->email}}">
                                    </div>
                                    <div class="col-md-3">
                                        <span class="badge badge-auto badge-md mt-2 badge-{{isset($user) && $user->email_verified_at != null ? 'success' : 'danger' }}">
                                            {{isset($user) && $user->email_verified_at != null ? __('Verified')  : __('Unverified') }} 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Update Email')}}</button>
                    </form>
                    <form class="col-md-6" action="{{ route('user.ajax.account.update') }}" method="POST"  autocomplete="off">
                        @csrf
                        <input type="hidden" name="action_type" value="update_mobile">
                        <div class="input-item input-with-label">
                            <label for="mobile_code" class="input-item-label">{{__('Mobile Phone')}}</label>
                            <div class="input-wrap">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6 pr-0">
                                                <select class="select-bordered select-block" name="mobile_code" id="mobile_code" data-dd-class="search-on">
                                                    <option value="">Select Code</option>
                                                    @foreach ($mobileCode as $code)
                                                    <option value="{{trim($code->phone_code)}}" {{trim($code->phone_code)==trim($user->mobile_code)?'selected':''}}>[{{$code->country_label}}] {{$code->phone_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 pl-1 pr-0">
                                                <input class="input-bordered numerical" type="text" name="mobile" id="mobile" value="{{$user->mobile}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="badge badge-auto badge-md mt-2 badge-{{isset($user) && $user->mobile_verified_at != null ? 'success' : 'danger' }}">
                                            {{isset($user) && $user->mobile_verified_at != null ? __('Verified')  : __('Unverified') }} 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Update Mobile Phone')}}</button>
                    </form>
                </div>
                <hr/>
                
                <form class="" action="{{ route('user.ajax.account.update') }}" method="POST"  autocomplete="off">
                    @csrf
                    <input type="hidden" name="action_type" value="update_password">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-item input-with-label">
                                <label for="old-pass" class="input-item-label">{{__('Current Password')}}</label>
                                <div class="input-wrap">
                                    <input class="input-bordered" type="password" name="old-password" id="old-pass" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-item input-with-label">
                                <label for="new-pass" class="input-item-label">{{__('New Password')}}</label>
                                <div class="input-wrap">
                                    <input class="input-bordered" id="new-pass" type="password" name="new-password" {{--required="required"--}} minlength="6" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-item input-with-label">
                                <label for="confirm-pass" class="input-item-label">{{__('Confirm New Password')}}</label>
                                <div class="input-wrap">
                                    <input id="confirm-pass" class="input-bordered" type="password" name="re-password" data-rule-equalTo="#new-pass" data-msg-equalTo="Password not match." {{--required="required"--}} minlength="6" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="note note-plane note-info pdb-1x">
                        <em class="fas fa-info-circle"></em>
                        <p>{{__('password.digit',['what'=>6])}}</p>
                    </div>
                    <div class="note note-plane note-danger pdb-2x">
                        <em class="fas fa-info-circle"></em>
                        <p>{{__('password.only.confirm')}}</p>
                    </div>
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">{{__('Update Password')}}</button>
                        <div class="gaps-2x d-sm-none"></div>
                    </div>
                    <div class="gaps-1x"></div>
                    <hr/>
                </form>                    
                <form class="" action="{{ route('user.ajax.account.update') }}" method="POST"  autocomplete="off">
                    @csrf
                    <input type="hidden" name="action_type" value="update_public_key">
                    <div class="content-area card">
                        <div class="card-head">
                            <h4 class="card-title">{!! __('Public Key') !!}</h4>
                        </div>
                        <p>{!! __("public.key.descript") !!}</p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-item input-with-label">
                                    <label for="userid" class="input-item-label">{{__('User ID')}}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered" type="text" name="userid" id="userid" disabled value='{{set_id($user->id)}}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="input-item input-with-label">
                                    <label for="old-pass" class="input-item-label">{{__('Public Key')}}</label>
                                    <div class="input-wrap">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input class="input-bordered numerical clipboard-value" type="text" name="public-key" id="public-key" disabled value="{{$user->public_key}}">
                                            </div>
                                            <div class="col-md-3">
                                                <a href="javascript:void(0)" class="btn btn-auto btn-primary btn-outline clipboard" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                               
                                                <button type="submit" class="btn btn-primary col-md-2">{{__('Update Key')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="KYC">
                {{--@section('title', __('KYC Verification'))--}}
                <div class="page-header page-header-kyc">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xl-7 text-center">
                            <h2 class="page-title">{{ ($user_kyc !== NULL && isset($_GET['thank_you'])) ? __('Begin your ID-Verification') : __('KYC Verification') }}</h2>
                            <p class="large">{{ ($user_kyc !== NULL && isset($_GET['thank_you'])) ? __('Verify your identity to participate in token sale.') : __('To comply with regulations each participant is required to go through identity verification (KYC/AML) to prevent fraud, money laundering operations, transactions banned under the sanctions regime or those which fund terrorism. Please, complete our fast and secure verification process to participate in token offerings.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <div class="content-area card user-account-pages page-kyc">
                            <div class="card-innr">
                                @include('layouts.messages')
                                <div class="kyc-status card mx-lg-4">
                                    <div class="card-innr">
                                        {{-- IF NOT SUBMITED --}}
                                        @if($user_kyc == NULL)
                                            <div class="status status-empty">
                                                <div class="status-icon">
                                                    <em class="ti ti-files"></em>
                                                </div>
                                                <span class="status-text text-dark">{{__('You have not submitted your necessary documents to verify your identity.')}}{{ (token('before_kyc')=='1') ? __('In order to purchase our tokens, please verify your identity.') : ''}}</span>
                                                <p class="px-md-5">{{__('It would great if you please submit the form. If you have any question, please feel free to contact our support team.')}}</p>
                                                <a href="{{ route('user.kyc.application') }}?state=new" class="btn btn-primary">{{__('Click here to complete your KYC')}}</a>
                                            </div>
                                        @endif
                                        {{-- IF SUBMITED @Thanks --}}
                                        @if($user_kyc !== NULL && isset($_GET['thank_you']))
                                            <div class="status status-thank px-md-5">
                                                <div class="status-icon">
                                                    <em class="ti ti-check"></em>
                                                </div>
                                                <span class="status-text large text-dark">{{__('You have completed the process of KYC')}}</span>
                                                <p class="px-md-5">{{__('We are still waiting for your identity verification. Once our team verified your identity, you will be notified by email. You can also check your KYC  compliance status from your profile page.')}}</p>
                                                <a href="{{ route('user.account') }}" class="btn btn-primary">{{__('Back to Profile')}}</a>
                                            </div>
                                        @endif

                                        {{-- IF PENDING --}}
                                        @if($user_kyc !== NULL && $user_kyc->status == 'pending' && !isset($_GET['thank_you']))
                                            <div class="status status-process">
                                                <div class="status-icon">
                                                    <em class="ti ti-infinite"></em>
                                                </div>
                                                <span class="status-text text-dark">{{__('Your application verification under process.')}}</span>
                                                <p class="px-md-5">{{__('We are still working on your identity verification. Once our team verified your identity, you will be notified by email.')}}</p>
                                            </div>
                                        @endif

                                        {{-- IF REJECTED/MISSING --}}
                                        @if($user_kyc !== NULL && ($user_kyc->status == 'missing' || $user_kyc->status == 'rejected') && !isset($_GET['thank_you']))
                                            <div class="status status{{ ($user_kyc->status == 'missing') ? '-warnning' : '-canceled' }}">
                                                <div class="status-icon">
                                                    <em class="ti ti-na"></em>
                                                </div>
                                                <span class="status-text text-dark">
                                                    {{ $user_kyc->status == 'missing' ? __('We found some information to be missing.') : __('Sorry! Your application was rejected.') }}
                                                </span>
                                                <p class="px-md-5">{{__('In our verification process, we found information that is incorrect or missing. Please resubmit the form. In case of any issues with the submission please contact our support team.')}}</p>
                                                <a href="{{ route('user.kyc.application') }}?state={{ $user_kyc->status == 'missing' ? 'missing' : 'resubmit' }}" class="btn btn-primary">{{__('Submit Again')}}</a>
                                            </div>
                                        @endif

                                        {{-- IF VERIFIED --}}
                                        @if($user_kyc !== NULL && $user_kyc->status == 'approved' && !isset($_GET['thank_you']))
                                            <div class="status status-verified">
                                                <div class="status-icon">
                                                    <em class="ti ti-files"></em>
                                                </div>
                                                <span class="status-text text-dark">{{__('Your identity verified successfully.')}}</span>
                                                <p class="px-md-5">{{__('One of our team members verified your identity. Now you can participate in our token sale. Thank you.')}}</p>
                                                <div class="gaps-2x"></div>

                                            </div>
                                        @endif

                                    </div>
                                </div>{{-- .card --}}
                            </div>
                        </div>
                        {!! UserPanel::kyc_footer_info() !!}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="personalData">
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">Personal Information</h6>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">First Name</div>
                        <div class="data-details-des" style="border-left:0px">{!! ($user->name)?$user->name: "&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Last Name</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->lastName) ? (optional($user_kyc)->lastName): "&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Gender</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->gender)?(optional($user_kyc)->gender):"&nbsp;" !!}</div>
                    </li>{{-- li --}}

                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Date of Birth</div>
                        <div class="data-details-des" style="border-left:0px"> {!! (optional($user_kyc)->dob)?(optional($user_kyc)->dob):"&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Country of Birth</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->country_of_birth)?(optional($user_kyc)->country_of_birth):"&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Place of Birth</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->place_of_birth)?(optional($user_kyc)->place_of_birth):"&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Nationality</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->nationality)?(optional($user_kyc)->nationality):"&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head">National Identification Number</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->nationality_id)?(optional($user_kyc)->nationality_id):"&nbsp;" !!}</div>
                    </li>{{-- li --}}

                </ul>
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">Address Information</h6>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Country</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->country)?(optional($user_kyc)->country): "&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">State / Province</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->state)?(optional($user_kyc)->state):"&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">City / Town</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->city)?(optional($user_kyc)->city): "&nbsp;" !!}</div>
                    </li>{{-- li --}}

                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Zip / Postal Code</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->zip)?(optional($user_kyc)->zip): "&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Street Name</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->address1)?(optional($user_kyc)->address1): "&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head" style="border-bottom:1px solid #d2dde9;">Street/Building Number</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->address2)?(optional($user_kyc)->address2): "&nbsp;" !!}</div>
                    </li>{{-- li --}}
                    <li>
                        <div class="data-details-head">Floor / Unit</div>
                        <div class="data-details-des" style="border-left:0px">{!! (optional($user_kyc)->floor)?(optional($user_kyc)->floor): "&nbsp;" !!}</div>
                    </li>{{-- li --}}

                </ul>
            </div>{{-- .tab-pane --}}
            <div class="tab-pane fade" id="settings">
                <div>
                    <form class="" action="{{ route('user.ajax.account.update') }}" method="POST" id="">
                        @csrf
                        <input type="hidden" name="action_type" value="account_setting">
                        <div class="pdb-1-5x">
                            <h5 class="card-title card-title-sm text-dark">{{__('Security Settings')}}</h5>
                        </div>
                        <div class="input-item">
                            <input name="save_activity" class="input-switch input-switch-sm" type="checkbox" {{ $userMeta->save_activity == 'TRUE' ? 'checked' : '' }} id="activitylog">
                            <label for="activitylog">{{__('Save my activities log')}}</label>
                        </div>
                        <div class="input-item">
                            <input class="input-switch input-switch-sm" type="checkbox" @if($userMeta->unusual == 1) checked="" @endif name="unusual" id="unuact">
                            <label for="unuact">{{__('Alert me by email in case of unusual activity in my account')}}</label>
                        </div>
                        <div class="gaps-1x"></div>
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                            <div class="gaps-4x d-sm-none"></div>
                        </div>
                    </form>
                </div>
                <div class="gaps-3x"></div>
                <hr/>
                <div class="gaps-3x"></div>
                <div class="content-area card">
                    <div class="">
                        <div class="card-head">
                            <h4 class="card-title">{!! __('Two-Factor Verification') !!}</h4>
                        </div>
                        <p>{!! __("Two-factor authentication is a method for protection of your account. When it is activated you are required to enter not only your password, but also a special code. You can receive this code in mobile app. Even if third party gets access to your password, they still won't be able to access your account without the 2FA code.") !!}</p>
                        <div class="d-sm-flex justify-content-between align-items-center pdt-1-5x">
                            <span class="text-light ucap d-inline-flex align-items-center"><span class="mb-0"><small>{{ __('Current Status:') }}</small></span> <span class="badge badge-{{ $user->google2fa == 1 ? 'info' : 'disabled' }} ml-2">{{ $user->google2fa == 1 ? __('Enabled') : __('Disabled') }}</span></span>
                            <div class="gaps-2x d-sm-none"></div>
                            <button type="button" data-toggle="modal" data-target="#g2fa-modal" class="order-sm-first btn btn-{{ $user->google2fa == 1 ? 'warning' : 'primary' }}">{{ ($user->google2fa != 1) ? __('Enable 2FA') : __('Disable 2FA') }}</button>
                            {{--       @dd( \Illuminate\Support\Facades\Lang::getLocale(),App::setLocale('zh'),\Illuminate\Support\Facades\Lang::getLocale(),__('Enable 2FA'))--}}

                        </div>
                    </div>{{-- .card-innr --}}
                </div>

            </div>{{-- .tab-pane --}}

            <div class="tab-pane fade" id="password">
                <form class="" action="{{ route('user.ajax.account.update') }}" method="POST" id="">
                    @csrf
                    <input type="hidden" name="action_type" value="pwd_change">

                    <div class="gaps-1x"></div>{{-- 10px gap --}}
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                        <div class="gaps-2x d-sm-none"></div>
                    </div>
                </form>
            </div>{{-- .tab-pane --}}
        </div>{{-- .tab-content --}}
    </div>{{-- .card-innr --}}
</div>{{-- .card --}}


@endsection


@push('footer')
{{-- Modal Medium --}}
<div class="modal fade" id="g2fa-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="popup-body">
                <h3 class="popup-title">{{ ($user->google2fa != 1) ? __('Enable') : __('Disable') }} {{ __('2FA Authentication') }}</h3>
                <form class="" action="{{ route('user.ajax.account.update') }}" method="POST" id="">
                    @csrf
                    <input type="hidden" name="action_type" value="google2fa_setup">
                    @if($user->google2fa != 1)
                    <div class="pdb-1-5x">
                        <p><strong>{{ __('Step 1:') }}</strong> {{ __('Install this app from') }} <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">{{ __('Google Play') }} </a> {{ __('store or') }} <a target="_blank" href="https://itunes.apple.com/us/app/google-authenticator/id388497605">{{ __('App Store') }}</a>.</p>
                        <p><strong>{{ __('Step 2:') }}</strong> {{ __('Scan the below QR code by your Google Authenticator app, or you can add account manually.') }}</p>
                        <p><strong>{{ __('Manually add Account:') }}</strong><br>{{ __('Account Name:') }} <strong class="text-head">{{ site_info() }}</strong> <br> {{ __('Key:') }} <strong class="text-head">{{ $google2fa_secret }}</strong></p>
                        <div class="row g2fa-box">
                            <div class="col-md-4">
                                <img class="img-thumbnail" src="{{ route('public.qrgen', ['text' => $google2fa]) }}" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="input-item">
                                    <label for="google2fa_code">{{ __('Enter Google Authenticator Code') }}</label>
                                    <input id="google2fa_code" type="number" class="input-bordered" name="google2fa_code" placeholder="{{ __('Enter the Code to verify') }}">
                                </div>
                                <input type="hidden" name="google2fa_secret" value="{{ $google2fa_secret }}">
                                <input name="google2fa" type="hidden" value="1">
                                <button type="submit" class="btn btn-primary">{{ __('Confirm 2FA') }}</button>
                            </div>
                        </div>
                        <div class="gaps-2x"></div>
                        <p class="text-danger"><strong>{{ __('Note:') }}</strong> {{ __('If you lost your phone or uninstall the Google Authenticator app, then you will lost access of your account.') }}</p>
                    </div>
                    @else
                    <div class="pdb-1-5x">
                        <div class="input-item">
                            <label for="google2fa_code">{{ __('Enter Google Authenticator Code') }}</label>
                            <input id="google2fa_code" type="number" class="input-bordered" name="google2fa_code" placeholder="{{ __("Enter the Code to verify") }}">
                        </div>
                        <input name="google2fa" type="hidden" value="0">
                        <button type="submit" class="btn btn-primary">{{ __('Disable 2FA') }}</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>{{-- .modal-content --}}
    </div>{{-- .modal-dialog --}}
</div>
{{-- Modal End --}}
<script type="text/javascript">
    (function($){
        var $nio_user_2fa = $('#nio-user-2fa');
        if ($nio_user_2fa.length > 0) {
            ajax_form_submit($nio_user_2fa);
        }
    })(jQuery);
</script>
@endpush
