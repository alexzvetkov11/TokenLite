@extends('layouts.user')
@section('title', __('Begin ID-Verification'))
@php
$has_sidebar = false;
@endphp

@section('content')
{{-- <div class="page-header page-header-kyc">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7 text-center">
            <h2 class="page-title">{{__('Begin your ID-Verification')}}</h2>
            <p class="large">{{__('Verify your identity to confirm your account.')}}</p>
        </div>
    </div>
</div> --}}
<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-9">

        @include('layouts.messages')
        <div class="<!--kyc-form-steps--> card mx-lg-4">
            <div class="card-head has-aside pd-2x">
                <h4 ><b>{{ __('Verification') }} </b> > {{ __('Identity') }}</h4>
                <div class="card-opt data-action-list d-md-inline-flex">
                    <a href="{{ route('user.compliance') }}" class="btn btn-auto btn-sm btn-primary" >
                        <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                    </a>
                </div>
            </div>
            <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
            <form action="{{ route('user.ajax.kyc.submit') }}" method="POST" >
                <input type="hidden" name="type" value="identity">
                @csrf
                @php
                    $option =  $defaultDoc = $defaultImg = ''; $wallets = array();
                    $wallet = field_value_text('kyc_wallet_opt', 'wallet_opt');
                    if($wallet) {
                        foreach ($wallet as $wal) {
                            $wallets[$wal] = $wal;
                        }
                    }

                    $custom = field_value_text('kyc_wallet_custom');
                    if($custom['cw_name'] != '' && $custom['cw_text'] != ''){
                        $wallets[$custom['cw_name']] = $custom['cw_text'];
                    }
                    $wallet_count = count($wallets);

                    if($wallet_count > 0){
                        foreach($wallets as $wallet_opt => $value){
                            $option .= '<option value="'.strtolower($value).'">'.ucfirst($value).'</option>';
                        }
                    }

                    $has_wallet = (field_value('kyc_wallet', 'show' ) && $wallet_count >= 1);
                    $has_docs = (field_value('kyc_document_passport') || field_value('kyc_document_nidcard') || field_value('kyc_document_driving'));
                    $support_docs = array(
                        'passport' => field_value('kyc_document_passport'),
                        'nidcard' => field_value('kyc_document_nidcard'),
                        'driving' => field_value('kyc_document_driving')
                    );
                    $default_docs = array();
                    foreach ($support_docs as $doc => $type){
                        if($type) {
                            $default_docs = array('doc' => $doc, 'name' => $title[$doc], 'image' => $doc);
                            break;
                        }
                    }
                    if (!empty($default_docs)) {
                        $defaultDoc = $default_docs['name'];
                        $defaultImg = $default_docs['image'];
                    }

                    $step_01 = ($has_wallet || $has_docs) ? '01' : '';
                    $step_02 = ($has_wallet || $has_docs) ? '02' : '';
                    $step_03 = ($step_01 && $has_docs) ? '03' : '';
                    $step_04 = ($step_01 && $has_docs) ? '04' : '';
                    /*$step_04 = ($has_wallet && $has_docs) ? '04' : (($has_wallet && !$has_docs) ? '03' : '');*/

                @endphp

                <div class="form-step form-step1">
                    <div class="form-step-head card-innr">
                        <div class="step-head">
                            <div class="step-number">{{ $step_01 }}</div>
                            <div class="step-head-text">
                                <h4>{{__('Identity Details')}}</h4>
                                <p>{{__('Your basic personal information is required for identification purposes.')}}</p>
                            </div>
                        </div>
                    </div>{{-- .step-head --}}
                    <div class="form-step-fields card-innr">
                        <div class="note note-plane note-light-alt note-md pdb-1x">
                            <em class="fas fa-info-circle"></em>
                            <p>{{__('Please type carefully and fill out the form with your personal details. You are not allowed to edit the details once you have submitted the application.')}}</p>
                        </div>
                        <div class="row">
                            @if(field_value('kyc_firstname', 'show'))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="first-name" class="input-item-label">
                                            {{__('First Name')}}
                                            @if (field_value('kyc_firstname', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            {{-- style="text-transform:uppercase" --}}
                                            <input
                                                {{ field_value('kyc_firstname', 'req' ) == '1' ? 'required ' : '' }}
                                                class="input-bordered" type="text" name="first_name"
                                                value="{{ isset($user_kyc) ? $user_kyc->first_middle_names : ''}}" id="first-name" >
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif

                            @if(field_value('kyc_lastname', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="last-name" class="input-item-label">
                                            {{__('Last Name')}}
                                            @if (field_value('kyc_lastname', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_lastname', 'req' ) == '1' ? 'required ' : '' }}
                                                class="input-bordered" value="{{ isset($user_kyc) ? $user_kyc->last_name : ''}}"
                                                type="text" id="last-name" name="last_name">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif
                            @if(field_value('kyc_email', 'show' ) && isset($input_email) && $input_email == true)
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="email" class="input-item-label">
                                            {{__('Email Address')}}
                                            @if (field_value('kyc_email', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input
                                                {{ field_value('kyc_email', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"
                                                value="{{ isset($user_kyc) ? $user_kyc->email : ''}}" type="email" id="email"
                                                name="email">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif

                            @if(!isset($user_kyc))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="password" class="input-item-label">
                                            {{__('Password')}}
                                            <span class="text-require text-danger">*</span>
                                        </label>
                                        <div class="input-wrap">
                                            <input required class="input-bordered" placeholder="*******" type="password" minlength="6"
                                                id="password" name="password">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif
                            @if(field_value('kyc_gender', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="gender" class="input-item-label">
                                            {{__('Gender')}}
                                            @if (field_value('kyc_gender', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select {{ field_value('kyc_gender', 'req' ) == '1' ? 'required ' : '' }}
                                                class="select-bordered select-block" name="gender" id="gender">
                                                <option value="">{{__('Select Gender')}}</option>
                                                <option
                                                    {{( (isset($user_kyc) ? $user_kyc->gender_id : '') == '1')?"selected":"" }} value="1">{{__('Male')}}</option>
                                                <option
                                                    {{( (isset($user_kyc) ? $user_kyc->gender_id : '') != '1')?"selected":"" }} value="2">{{__('Female')}}</option>
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif

                            @if(field_value('kyc_dob', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="date-of-birth" class="input-item-label">
                                            {{__('Date of Birth')}}
                                            @if (field_value('kyc_dob', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}
                                                class="input-bordered date-picker-dob" type="text" id="date-of-birth" name="dob" data-format="alt"
                                                value="{{ isset($user_kyc) ? _date($user_kyc->dob,'d/m/Y') : ''}}">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif
                            @if(field_value('kyc_country_birth', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="Country of Birth"  class="input-item-label">
                                            {{__('Country of Birth')}}
                                            @if (field_value('kyc_country_birth', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="Country_of_Birth" id="Country_of_Birth"
                                                    data-dd-class="search-on">
                                                <option value="">{{__('Select Country')}}</option>
                                                @foreach($countries as $country)
                                                    <option
                                                        {{ (isset($user_kyc) ? $user_kyc->country : '') == $country ? 'selected' : '' }} value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif
                            @if(field_value('kyc_birthPlace', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="email" class="input-item-label">
                                            {{__('Place of Birth')}}
                                            @if (field_value('kyc_birthPlace', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_birthPlace', 'req' ) == '1' ? 'required ' : '' }}
                                            class="input-bordered" type="text" name="place_of_birth"
                                            value="{{ isset($user_kyc) ? $user_kyc->place_of_birth : ''}}">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                            @endif
                            @if(field_value('kyc_nationality', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="Nationality" class="input-item-label">
                                            {{__('Citizenship')}}
                                            @if (field_value('kyc_nationality', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select {{ field_value('kyc_nationality', 'req' ) == '1' ? 'required ' : '' }}class="select-bordered select-block" name="Nationality" id="Nationality"
                                                    data-dd-class="search-on">
                                                <option value="">{{__('Select Country')}}</option>
                                                @foreach($countries as $country)
                                                    <option
                                                        {{ (isset($user_kyc) ? $user_kyc->citizenship : '') == $country ? 'selected' : '' }} value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif
                            @if(field_value('kyc_nationalityId', 'show' ))
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="email" class="input-item-label">
                                            {{__('National Identification Number')}}
                                            @if (field_value('kyc_nationalityId', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_nationalityId', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered" type="text"
                                                name="National Identification Number" value="{{isset($user_kyc)?$user_kyc->nationality_id:''}}">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            @endif
                        </div>{{-- .row --}}
                    </div>{{-- .step-fields --}}
                </div>

                @if($has_docs)
                    <div class="form-step form-step2">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">{{ $step_02 }}</div>
                                <div class="step-head-text">
                                    <h4>{{__('ID Document Upload')}}</h4>
                                    <p>{{__('To verify your identity, we ask you to upload high-quality scans or photos of your official identification documents issued by the government.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="note note-plane note-light-alt note-md pdb-0-5x">
                                <em class="fas fa-info-circle"></em>
                                <p>{{__('In order to complete, please upload any of the following personal documents.')}}</p>
                            </div>
                            <div class="gaps-2x"></div>
                            @if (!empty($support_docs))
                                <ul class="document-list guttar-vr-10px">
                                    @foreach ($support_docs as $doc_item => $opt)
                                        @if ($opt)
                                            <li class="document-item">
                                                <div class="input-wrap">
                                                    @if ($doc_item=='passport' && ($opt))
                                                        <input class="document-type" type="radio" name="documentType"
                                                            value="{{ $doc_item }}" id="docType-{{ $doc_item }}"
                                                            data-title="{{ $title[$doc_item] }}"
                                                            data-img="{{ asset('assets/images/vector-'.$doc_item.'.png') }}"{{ (isset($default_docs['doc']) && $default_docs['doc'] == $doc_item) ? ' checked' : '' }}>
                                                        <label for="docType-{{ $doc_item }}">
                                                            <div class="document-type-icon">
                                                                <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                                                <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                                            </div>
                                                            <span>{{ $title[$doc_item] }}</span>
                                                        </label>
                                                    @endif
                                                    @if ($doc_item=='nidcard' && ($opt))
                                                        <input class="document-type" type="radio" name="documentType"
                                                            data-change=".doc-upload-d2" value="{{ $doc_item }}"
                                                            id="docType-{{ $doc_item }}" data-title="{{ $title[$doc_item] }}"
                                                            data-img="{{ asset('assets/images/vector-'.$doc_item.'.png') }}"{{ (isset($default_docs['doc']) && $default_docs['doc'] == $doc_item) ? ' checked' : '' }}>
                                                        <label for="docType-{{ $doc_item }}">
                                                            <div class="document-type-icon">
                                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}"
                                                                    alt="">
                                                            </div>
                                                            <span>{{ $title[$doc_item] }}</span>
                                                        </label>
                                                    @endif
                                                    @if ($doc_item=='driving' && ($opt))
                                                        <input class="document-type" type="radio" name="documentType"
                                                            value="{{ $doc_item }}" id="docType-{{ $doc_item }}"
                                                            data-title="{{ $title[$doc_item] }}"
                                                            data-img="{{ asset('assets/images/vector-'.$doc_item.'.png') }}"{{ (isset($default_docs['doc']) && $default_docs['doc'] == $doc_item) ? ' checked' : '' }}>
                                                        <label for="docType-{{ $doc_item }}">
                                                            <div class="document-type-icon">
                                                                <img src="{{ asset('assets/images/icon-license.png') }}" alt="">
                                                                <img src="{{ asset('assets/images/icon-license-color.png') }}" alt="">
                                                            </div>
                                                            <span>{{ $title[$doc_item] }}</span>
                                                        </label>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            <div class="doc-upload-area">
                                <p class="text-secondary font-bold">{{__('To avoid delays with verification process, please double-check to ensure the below requirements are fully met:')}}</p>
                                <ul class="list-check">
                                    <li>{{__('Chosen credential must not be expired.')}}</li>
                                    <li>{{__('Document should be in good condition and clearly visible.')}}</li>
                                    <li>{{__('There is no light glare or reflections on the card.')}}</li>
                                    <li>{{__('File is at least 1 MB in size and has at least 300 dpi resolution.')}}</li>
                                </ul>
                                <div class="gaps-2x"></div>
                                <div class="doc-upload doc-upload-d1">
                                    <h6 class="font-mid doc-type-title">{!! __('Upload Here Your :doctype Copy', ['doctype' => '<storng class="doc-type-name">'.$defaultDoc.'</storng>']) !!}</h6>
                                    <div class="row align-items-center">
                                        <div class="col-sm-8">
                                            <div class="upload-box">
                                                <div class="upload-zone document_one">
                                                    <div class="dz-message" data-dz-message>
                                                        <span class="dz-message-text">{{__('Drag and drop file')}}</span>
                                                        <span class="dz-message-or">{{__('or')}}</span>
                                                        <button type="button" class="btn btn-primary">{{__('Select')}}</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="document_one"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 d-none d-sm-block">
                                            <div class="mx-md-4">
                                                <img width="160" class="_image" src="{{ asset('assets/images/vector-'.$defaultImg.'.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="gaps-3x"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="issue_date" class="input-item-label">
                                            {{__('Issue Birth')}}
                                            @if (field_value('kyc_dob', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>

                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}
                                                class="input-bordered date-picker" type="text" id="issue_date" name="issue_date"  data-format="alt"
                                                value="{{ isset($user_kyc) ? _date($user_kyc->issue_date, 'd/m/Y') : ''}}" max="{{ now()->toDateString('d-m-Y') }}" >
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="expire_date" class="input-item-label">
                                            {{__('Expiration Date')}}
                                            @if (field_value('kyc_dob', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}
                                                class="input-bordered date-picker" type="text" id="expire_date" name="expire_date" data-format="alt"
                                                value="{{ isset($user_kyc) ? _date($user_kyc->expiration_date,'d/m/Y') : ''}}" min="{{ now()->toDateString('d-m-Y') }}"  >
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>
                            </div>

                        </div>
                    </div>

                @endif


                <div class="form-step form-step-final">
                    <div class="form-step-fields card-innr">
                        @if(get_page('privacy', 'status') == 'active' || get_page('terms', 'status') == 'active')
                            <div class="input-item">
                                <input class="input-checkbox input-checkbox-md" id="term-condition" name="condition" type="checkbox"
                                    required="required" data-msg-required="{{ __("You should read our terms and policy.") }}">
                                <label
                                    for="term-condition">{{__('I have read the')}} {!! get_page_link('terms', ['target'=>'_blank']) !!} {{ (get_page_link('terms') && get_page_link('policy') ? __('and') : '') }} {!! get_page_link('policy', ['target'=>'_blank']) !!}
                                    .</label>
                            </div>
                        @endif
                        <div class="input-item">
                            <input class="input-checkbox input-checkbox-md" id="info-currect" name="currect" type="checkbox"
                                required="required" data-msg-required="{{ __("Confirm that all information is correct.") }}">
                            <label for="info-currect">{{__('All the information I have entered is correct.')}}</label>
                        </div>

                        <div class="gaps-1x"></div>
                        <button class="btn btn-primary" type="submit">{{__('Proceed to Verify')}}</button>
                    </div>{{-- .step-fields --}}
                </div>


                <div class="hiddenFiles"></div>

            </form>
        </div>


    </div>
</div>
<script type="text/javascript">
    function CheckSpace(event) {
        console.log(event.which);
        if (event.which === 32) {
            event.preventDefault();
            return false;
        }
    }
</script>
@endsection
