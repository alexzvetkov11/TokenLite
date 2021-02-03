@extends('layouts.user')
@section('title', __('User Account'))
@php($has_sidebar = true)

@section('content')
{{--@include('layouts.messages')--}}
<div class="content-area card">
    <div class="card-innr">
        <div class="card-head">
            <h4 class="card-title">{{__('Compliance')}}</h4>
        </div>
        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#identity">{{__('Identity')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#KYC">{{__('Residency')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#personalData">{{__('Tax')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings">{{__('Source of wealth')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#password">{{__('Carrer')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#password">{{__('Public records')}}</a>
            </li>
        </ul>
        <div class="tab-content" id="identity">
            <div class="tab-pane fade show active" id="identity">
                <form class="" action="{{ route('user.ajax.account.update') }}" method="POST" id="" autocomplete="off">
                    @csrf
                    <input type="hidden" name="action_type" value="personal_data">
                    
                    <div class="justify-content-between row">
                        <div class="col-md-3 pt-2">
                            <div class="row">
                            <div class="col-md-6 pt-3">{{__('Status') }}: </div>
                            <div class="col-md-6">
                                <span class="badge badge-auto badge-md badge-success mt-2">{{__('Verified') }}</span>
                                {{-- <span class="badge badge-auto badge-md mt-2 badge-{{isset($user->email_verified_at) && $user->email_verified_at != null ? 'success' : 'danger' }}">
                                    {{isset($user->email_verified_at) && $user->email_verified_at != null ? __('Verified')  : __('Unverified') }} 
                                </span> --}}
                            </div>
                            </div>
                        </div>
                        <div class="input-wrap pt-2">
                            <a href="{{route('user.kyc.application') }}" class="btn btn-primary">{{__('Update Name')}}</a>
                        </div>
                    </div>
                    <hr/>
                    <div class="gaps-3x"></div>
                    <h6 class="card-sub-title">{{__('Personal Information') }}</h6>
                    <div class="gaps-1x"></div>
                    <ul class="data-details-list">
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('First and Middle Names')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->first_middle_names ? $kycIdenty->first_middle_names : '&nbsp;' !!}</div>
                        </li>
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('Last Name')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->last_name ? $kycIdenty->last_name : '&nbsp;' !!}</div>
                        </li>
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('Gender')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->gender_id ? "male" : 'femal' !!}</div>
                        </li>
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('Date of Birth')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->country_of_birth ? $kycIdenty->country_of_birth : '&nbsp;' !!}</div>
                        </li>
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('Place of Birth')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->place_of_birth ? $kycIdenty->place_of_birth : '&nbsp;' !!}</div>
                        </li>
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('Citizenship')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->citizenship ? $kycIdenty->citizenship : '&nbsp;' !!}</div>
                        </li>
                        <li>
                            <div class="data-details-head" style="border-bottom: 1px solid #d2dde9">{{__('National Identification Number')}}</div>
                            <div class="data-details-des" style="border-left: 0px">{!! $kycIdenty->nationality_id ? $kycIdenty->nationality_id : '&nbsp;' !!}</div>
                        </li>
                    </ul>
                    <hr/>
                </form>{{-- form --}}
            </div>{{-- .tab-pane --}}
        </div>{{-- .tab-content --}}
    </div>{{-- .card-innr --}}
</div>{{-- .card --}}


@endsection


@push('footer')


@endpush
