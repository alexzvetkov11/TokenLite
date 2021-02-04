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
                <a class="nav-link" data-toggle="tab" href="#residency">{{__('Residency')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tax">{{__('Tax')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#source_wealth">{{__('Source of wealth')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#career">{{__('Career')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#public_records">{{__('Public records')}}</a>
            </li>
        </ul>
        <div class="tab-content" id="tabs">
            <div class="tab-pane fade show active" id="identity">
                <div class="justify-content-between d-flex">
                    <div class="col-md-3">
                        <div class="row">
                        <div class="col-md-6" style="align-self: flex-end;">{{__('Status') }}: </div>
                        <div class="col-md-6">
                            <span class="badge badge-auto badge-md badge-success mt-2">{{__('Verified') }}</span>
                            {{-- <span class="badge badge-auto badge-md mt-2 badge-{{isset($user->email_verified_at) && $user->email_verified_at != null ? 'success' : 'danger' }}">
                                {{isset($user->email_verified_at) && $user->email_verified_at != null ? __('Verified')  : __('Unverified') }} 
                            </span> --}}
                        </div>
                        </div>
                    </div>
                    <div class="t-2">
                        <a href="{{route('user.identity.details') }}" class="btn btn-primary">{{__('Update Detail')}}</a>
                    </div>
                </div>
                <hr/>
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title text-primary">{{__('Personal Information') }}</h6>
                <div class="gaps-1x"></div>
                <ul class="data-details-list" style="border: 0px solid #d2dde9">
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('First and Middle Names')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->first_middle_names ? $kyci->first_middle_names : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Last Name')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->last_name ? $kyci->last_name : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Gender')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->gender_id ? "male" : 'femal' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Date of Birth')}} (DD/MM/YYYY)</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->dob ? _date($kyci->dob, 'd/m/Y'): '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Country of Birth')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->country_of_birth ? _x($kyci->country_of_birth): '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Place of Birth')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->place_of_birth ? $kyci->place_of_birth : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Citizenship')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! $kyci->citizenship ? $kyci->citizenship : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('National Identification Number')}}</div>
                        <div class="data-details-des col-md-8" style="border-bottom: 1px solid #d2dde9; border-left: 0px">{!! $kyci->nationality_id ? $kyci->nationality_id : '&nbsp;' !!}</div>
                    </li>
                </ul>
                
            </div>
            <div class="tab-pane fade " id="residency">
                <div class="justify-content-between d-flex">
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
                    <div class="pt-2">
                        <a href="{{route('user.residency.details') }}" class="btn btn-primary">{{__('Update Detail')}}</a>
                    </div>
                </div>
                <hr/>
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">{{__('Residency Detail') }}</h6>
                <div class="gaps-1x"></div>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head text-primary col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Current Residency')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">&nbsp; </div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Current Country of Residence')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? $kycr->country_residence_current : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Date of Registration')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? date('m-Y',strtotime($kycr->country_residence_current_registration_date))  : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head text-primary col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Current Registered Address')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">&nbsp; </div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('State / Province / Region')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? $kycr->state_province_region : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('City / Town / Village')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? $kycr->city_town_village : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Zip / Postal Code')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr)? $kycr->zip_postal_code : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Street Name')}}</div>
                        <div class="data-details-des col-md-8"  style="border-left: 0px">{!! isset($kycr) ? $kycr->street_name : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4"  style="border-bottom: 1px solid #d2dde9">{{__('House / Building Number')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? $kycr->house_building_number : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4"  style="border-bottom: 1px solid #d2dde9">{{__('Floor / Apartment / Unit')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? $kycr->floor_apt_unit : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head text-primary col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Previous Residency')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">&nbsp; </div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4"  style="border-bottom: 1px solid #d2dde9">{{__('Previous Country of Residence')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? $kycr->country_residence_previous : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4"  style="border-bottom: 1px solid #d2dde9">{{__('Date of Registration')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? _date($kycr->country_residence_previous_registration_date, 'm-Y') : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4"  style="border-bottom: 1px solid #d2dde9">{{__('Date of De-registration')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? _date($kycr->country_residence_previous_deregistration_date, 'm-Y')  : '&nbsp;' !!}</div>
                    </li>
                </ul>
                <div class="gaps-3x"></div>
                <h6 class="card-sub-title">{{__('Uploaded Documents')}}</h6>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head col-md-4">
                            {{-- @if($kyc->documentType == 'nidcard')
                            National ID Card
                            @elseif($kyc->documentType == 'passport')
                            Passport
                            @elseif($kyc->documentType == 'license')
                            Driving License
                            @else
                            Documents
                            @endif --}}
                            {{__('Residency Verification Document')}}
                        </div>
                        @if($kycr->document != NULL)
                        <ul class="data-details-docs col-md-8">
                            @if($kycr->document != NULL)
                            <li>
                                <span class="data-details-docs-title">{{ $kycr->document_type == 'nidcard' ? 'Front Side' : 'Document' }}</span>
                                <div class="data-doc-item data-doc-item-lg">
                                    <div class="data-doc-image">
                                        @if(pathinfo(storage_path('app/'.$kycr->document), PATHINFO_EXTENSION) == 'pdf')
                                        <em class="kyc-file fas fa-file-pdf"></em>
                                        @else
                                        <img src="{{ route('admin.kycs.file', ['file'=>$kycr->id, 'doc'=>1]) }}" src="">
                                        @endif
                                    </div>
                                    <ul class="data-doc-actions">
                                        <li><a href="{{ route('admin.kycs.file', ['file'=>$kycr->id, 'doc'=>1]) }}" target="_blank" ><em class="ti ti-import"></em></a></li>
                                    </ul>
                                </div>
                            </li>{{-- li --}}
                            @endif
                            
                        </ul>
                        @else
                        {{__('No document uploaded.') }}
                        @endif
                    </li>
                </ul>
                <ul class="data-details-list">
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9;">{{__('Residency Verification Document – Type')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? _x($kycr->document_type) : '&nbsp;' !!}</div>
                    </li>
                    <li>
                        <div class="data-details-head col-md-4" style="border-bottom: 1px solid #d2dde9">{{__('Residency Verification Document – Date of Issuance')}}</div>
                        <div class="data-details-des col-md-8" style="border-left: 0px">{!! isset($kycr) ? _date($kycr->document_issue_date, 'd-m-Y') : '&nbsp;' !!}</div>
                    </li>
                </ul>
                <hr/>
            </div>
            <div class="gaps-2x"></div>
        </div>
    </div>
</div>


@endsection


@push('footer')


@endpush
