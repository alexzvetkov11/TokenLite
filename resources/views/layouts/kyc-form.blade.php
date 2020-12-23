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
                <h4>{{__('Personal Details')}}</h4>
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
                        <label for="first-name"
                               class="input-item-label">{{__('First Name')}}</label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_firstname', 'req' ) == '1' ? 'required ' : '' }} style="text-transform:uppercase"
                                class="input-bordered" type="text"
                                value="{{ isset($user_kyc) ? $user_kyc->firstName : ''}}" id="first-name"
                                name="first_name">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_lastname', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="last-name"
                               class="input-item-label">{{__('Last Name')}}</label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_lastname', 'req' ) == '1' ? 'required ' : '' }}   style="text-transform:uppercase"
                                class="input-bordered" value="{{ isset($user_kyc) ? $user_kyc->lastName : ''}}"
                                type="text" id="last-name" name="last_name">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_email', 'show' ) && isset($input_email) && $input_email == true)
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="email"
                               class="input-item-label">{{__('Email Address')}}</label>
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
                        <label for="password" class="input-item-label">{{__('Password')}}
{{--                            <span class="text-require text-danger">*</span>--}}
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
                            <label for="gender"
                                   class="input-item-label">{{__('Gender')}}</label>
                            <div class="input-wrap">
                                <select
                                    {{ field_value('kyc_gender', 'req' ) == '1' ? 'required ' : '' }}class="select-bordered select-block"
                                    name="gender" id="gender">
                                    <option value="">{{__('Select Gender')}}</option>
                                    <option
                                        {{( (isset($user_kyc) ? $user_kyc->gender : '') == 'male')?"selected":"" }} value="male">{{__('Male')}}</option>
                                    <option
                                        {{( (isset($user_kyc) ? $user_kyc->gender : '') == 'female')?"selected":"" }} value="female">{{__('Female')}}</option>
                                    <option
                                        {{( (isset($user_kyc) ? $user_kyc->gender : '') == 'other')?"selected":"" }} value="other">{{__('Other')}}</option>
                                </select>
                            </div>
                        </div>{{-- .input-item --}}
                    </div>{{-- .col --}}
                @endif

{{--            @if(field_value('kyc_phone', 'show' ))--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="input-item input-with-label">--}}
{{--                        <label for="phone-number"--}}
{{--                               class="input-item-label">{{__('Phone Number ')}}</label>--}}
{{--                        <div class="input-wrap">--}}
{{--                            <input--}}
{{--                                {{ field_value('kyc_phone', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"--}}
{{--                                type="text" value="{{ isset($user_kyc) ? $user_kyc->phone : ''}}" id="phone-number"--}}
{{--                                name="phone">--}}
{{--                        </div>--}}
{{--                    </div>--}}{{-- .input-item --}}
{{--                </div>--}}{{-- .col --}}
{{--            @endif--}}
            @if(field_value('kyc_dob', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="date-of-birth"
                               class="input-item-label">{{__('Date of Birth')}}</label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered date-picker-dob"
                                type="text" value="{{ isset($user_kyc) ? $user_kyc->dob : ''}}" id="date-of-birth"
                                name="dob">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_country_birth', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="Country of Birth"
                               class="input-item-label">{{__('Country of Birth')}}</label>
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
                        <label for="email" class="input-item-label">{{__('Place of Birth')}}</label>
                        <div class="input-wrap">
                            <input {{ field_value('kyc_birthPlace', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered" type="text" style="text-transform:uppercase"
                                   name="place_of_birth">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}

            @endif
            @if(field_value('kyc_nationality', 'show' ))
            <div class="col-md-6">
                <div class="input-item input-with-label">
                    <label for="Nationality" class="input-item-label">{{__('Nationality')}} </label>
                    <div class="input-wrap">
                        <select {{ field_value('kyc_nationality', 'req' ) == '1' ? 'required ' : '' }}class="select-bordered select-block" name="Nationality" id="Nationality"
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
            @if(field_value('kyc_nationalityId', 'show' ))
            <div class="col-md-6">
                <div class="input-item input-with-label">
                    <label for="email" class="input-item-label">{{__('National Identification Number')}}</label>
                    <div class="input-wrap">
                        <input {{ field_value('kyc_nationalityId', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered" type="text" style="text-transform:uppercase"
                               name="National Identification Number">
                    </div>
                </div>{{-- .input-item --}}
            </div>{{-- .col --}}
            @endif
{{--            @if(field_value('kyc_telegram', 'show' ))--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="input-item input-with-label">--}}
{{--                        <label for="telegram"--}}
{{--                               class="input-item-label">{{__('Telegram Username')}}</label>--}}
{{--                        <div class="input-wrap">--}}
{{--                            <input--}}
{{--                                {{ field_value('kyc_telegram', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"--}}
{{--                                type="text" value="{{ isset($user_kyc) ? $user_kyc->telegram : ''}}" id="telegram"--}}
{{--                                name="telegram">--}}
{{--                        </div>--}}
{{--                    </div>--}}{{-- .input-item --}}
{{--                </div>--}}{{-- .col --}}
{{--            @endif--}}
        </div>{{-- .row --}}
{{--        <div class="step-head">--}}
{{--            <div class="step-number">{{ $step_02 }}</div>--}}
{{--            <div class="step-head-text">--}}
{{--                <h4>{{__('Registered Address Details')}}</h4>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="gaps-3x"></div>
        <div class="form-step-head">
            <div class="step-head">
                <div class="step-number">{{ $step_02 }}</div>
                <div class="step-head-text">
                    <h4>{{__('Registered Address Details')}}</h4>
                    <p>{{__('To verify your identity, we ask you to enter your address details as your identity card provided by the government.')}}</p>
                </div>
            </div>
        </div>
        <div class="gaps-3x"></div>

        {{--<div class="step-number">{{ $step_02 }}</div>
        <h4 class="text-secondary mgt-0-5x">{{__('Registered Address Details')}}</h4>--}}
        <div class="row">
            @if(field_value('kyc_country', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="country"
                               class="input-item-label">{{__('Country')}}</label>
                        <div class="input-wrap">
                            <select
                                {{ field_value('kyc_country', 'req' ) == '1' ? 'required ' : '' }}class="select-bordered select-block"
                                name="country" id="country" data-dd-class="search-on">
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
            @if(field_value('kyc_state', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="state"
                               class="input-item-label">{{__('State / Province')}} </label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_state', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"
                                type="text" value="{{ isset($user_kyc) ? $user_kyc->state : ''}}" id="state"
                                name="state">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_city', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="city"
                               class="input-item-label">{{__('City / Town')}}</label>
                        <div class="input-wrap">
                            <input {{ field_value('kyc_city', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"
                                   type="text" value="{{ isset($user_kyc) ? $user_kyc->city : ''}}"
                                   style="text-transform:uppercase" id="city"
                                   name="city">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_zip', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="zip"
                               class="input-item-label">{{__('Zip / Postal Code')}}</label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_zip', 'req' ) == '1' ? 'required ' : '' }}  onkeypress="CheckSpace(event)"
                                class="input-bordered" type="text" value="{{ isset($user_kyc) ? $user_kyc->zip : ''}}"
                                id="zip" name="zip">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_address_1', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="address_1"
                               class="input-item-label">{{__('Street Name')}}</label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_address_1', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"
                                type="text" value="{{ isset($user_kyc) ? $user_kyc->address1 : ''}}"
                                style="text-transform:uppercase" id="address_1"
                                name="address_1">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_Building', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="address_2"
                               class="input-item-label">{{__('Street / Building Number')}}</label>
                        <div class="input-wrap">
                            <input
                                {{ field_value('kyc_Building', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"
                                type="text" value="{{ isset($user_kyc) ? $user_kyc->address2 : ''}}"
                                style="text-transform:uppercase" id="address_2"
                                name="address_2">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
            @if(field_value('kyc_Floor', 'show' ))
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="floor"
                               class="input-item-label">{{__('Floor / Unit')}}</label>
                        <div class="input-wrap">
                            <input
                            {{ field_value('kyc_Floor', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered" type="text"
                               name="floor">
                        </div>
                    </div>{{-- .input-item --}}
                </div>{{-- .col --}}
            @endif
        </div>{{-- .row --}}
    </div>{{-- .step-fields --}}
</div>
@if($has_docs)
    <div class="form-step form-step3">
        <div class="form-step-head card-innr">
            <div class="step-head">
                <div class="step-number">{{ $step_03 }}</div>
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
                                <img width="160" class="_image"
                                     src="{{ asset('assets/images/vector-'.$defaultImg.'.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="doc-upload doc-upload-d2{{ (isset($default_docs['doc']) && $default_docs['doc'] == 'nidcard') ? '' : ' hide' }}">
                    <h6 class="font-mid">{{ __('Upload Here Your National ID Back Side') }}</h6>
                    <div class="row align-items-center">
                        <div class="col-sm-8">
                            <div class="upload-box">
                                <div class="upload-zone document_two">
                                    <div class="dz-message" data-dz-message>
                                        <span class="dz-message-text">{{__('Drag and drop file')}}</span>
                                        <span class="dz-message-or">{{__('or')}}</span>
                                        <button type="button" class="btn btn-primary">{{__('Select')}}</button>
                                    </div>
                                </div>
                                <input type="hidden" name="document_two"/>
                            </div>
                        </div>
                        <div class="col-sm-4 d-none d-sm-block">
                            <div class="mx-md-4">
                                <img width="160" src="{{  asset('assets/images/vector-id-back.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sap sap-gap"></div>
                <div class="doc-upload doc-upload-d3">
                    <h6 class="font-mid">{{__('Upload a selfie as a Photo Proof while holding document in your hand')}}</h6>
                    <div class="row align-items-center">
                        <div class="col-sm-8">
                            <div class="upload-box">
                                <div class="upload-zone document_upload_hand">
                                    <div class="dz-message" data-dz-message>
                                        <span class="dz-message-text">{{__('Drag and drop file')}}</span>
                                        <span class="dz-message-or">{{__('or')}}</span>
                                        <button type="button" class="btn btn-primary">{{__('Select')}}</button>
                                    </div>
                                </div>
                                <input type="hidden" name="document_image_hand"/>
                            </div>
                        </div>
                        <div class="col-sm-4 d-none d-sm-block">
                            <div class="mx-md-4">
                                <img width="160" src="{{ asset('assets/images/vector-hand.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="sap sap-gap"></div>--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="input-item input-with-label">--}}
{{--                    <label for="document_no"--}}
{{--                           class="input-item-label">{{__('Document Number')}}</label>--}}
{{--                    <div class="input-wrap">--}}
{{--                        <input {{ field_value('kyc_address1', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"--}}
{{--                               type="text" value="{{ isset($user_kyc) ? $user_kyc->address1 : ''}}"--}}
{{--                               style="text-transform:uppercase" id="document_no"--}}
{{--                               name="document_no">--}}
{{--                    </div>--}}
{{--                </div>--}}{{-- .input-item --}}
{{--            </div>--}}{{-- .col --}}
{{--            <div class="col-md-6">--}}
{{--                <div class="input-item input-with-label">--}}
{{--                    <label for="Proof of Address Type"--}}
{{--                           class="input-item-label">{{__('Proof of Address Type')}} </label>--}}
{{--                    <div class="input-wrap">--}}
{{--                        <select class="select-bordered select-block" name="Proof of Address Type" id="Proof of Address Type"--}}
{{--                                data-dd-class="search-on">--}}
{{--                            <option value="">{{__('Select option')}}</option>--}}

{{--                            <option >Utility Bill</option>--}}
{{--                            <option >Phone Bill</option>--}}
{{--                            <option >Bank Statement</option>--}}
{{--                            <option >Tax Statement</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}{{-- .input-item --}}
{{--            </div>--}}{{-- .col --}}


        </div>
    </div>
    <div class="form-step form-step4">
        <div class="form-step-head card-innr">
            <div class="step-head">
                <div class="step-number">{{ $step_04 }}</div>
                <div class="step-head-text">
                    <h4>{{__('Address Document Upload')}}</h4>
                    <p>{{__('To verify your identity, we ask you to upload high-quality scans or photos of your official identification documents issued by the government.')}}</p>
                </div>
            </div>
        </div>{{-- .step-head --}}
        <div class="form-step-fields card-innr">
            <div class="col-md-6">
                <div class="input-item input-with-label">
                    <label for="Proof of Address Type"
                           class="input-item-label">{{__('Proof of Address Type')}} </label>
                    <div class="input-wrap">
                        <select class="select-bordered select-block" name="Proof of Address Type" id="Proof of Address Type"
                                data-dd-class="search-on">
                            <option value="">{{__('Select option')}}</option>

                            <option >Utility Bill</option>
                            <option >Phone Bill</option>
                            <option >Bank Statement</option>
                            <option >Tax Statement</option>
                        </select>
                    </div>
                </div>{{-- .input-item --}}
                <h6 class="font-mid">Upload here your proof of Address document</h6>
                <div class="upload-box">
                    <div class="upload-zone document_proof_of_address">
                        <div class="dz-message" data-dz-message>
                            <span class="dz-message-text">{{__('Drag and drop file')}}</span>
                            <span class="dz-message-or">{{__('or')}}</span>
                            <button type="button" class="btn btn-primary">{{__('Select')}}</button>
                        </div>
                    </div>
                    <input type="hidden" name="document_proof_of_address"/>
                </div>
            </div>{{-- .col --}}

            <div class="sap sap-gap"></div>
            <div class="col-md-6">
                <div class="input-item input-with-label">
                    <label for="document_no"
                           class="input-item-label">{{__('Document Number')}}</label>
                    <div class="input-wrap">
                        <input {{ field_value('kyc_address1', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered"
                               type="text" value="{{ isset($user_kyc) ? $user_kyc->address1 : ''}}"
                               style="text-transform:uppercase" id="document_no"
                               name="document_no">
                    </div>
                </div>{{-- .input-item --}}
            </div>{{-- .col --}}

        </div>
    </div>
@endif

{{--@if($has_wallet)
<div class="form-step form-step3">
    <div class="form-step-head card-innr">
        <div class="step-head">
            <div class="step-number">{{ $step_04 }}</div>
            <div class="step-head-text">
                <h4>{{__('Your Paying Wallet')}}</h4>
                <p>{{__('Submit your wallet address that you are going to send funds')}}</p>
            </div>
        </div>
    </div>--}}{{-- .step-head --}}{{--
    <div class="form-step-fields card-innr">
        <div class="note note-plane note-light-alt note-md pdb-1x">
            <em class="fas fa-info-circle"></em>
            <p>{{__('DO NOT USE your exchange wallet address such as Kraken, Bitfinex, Bithumb, Binance etc.')}}</p>
        </div>
        @if($wallet_count > 1)
        <div class="row">
            <div class="col-md-6">
                <div class="input-item input-with-label">
                    <label for="swalllet" class="input-item-label">{{__('Select Wallet')}} {!! required_mark('kyc_wallet') !!}</label>
                    <div class="input-wrap">
                        <select {{ field_value('kyc_wallet', 'req' ) == '1' ? 'required ' : '' }}class="select-bordered select-bordered select-block" name="wallet_name" id="swalllet">
                            {!! $option !!}
                        </select>
                    </div>
                </div>
            </div>
        </div>--}}{{-- .row --}}{{--
        @else
        <input type="hidden" name="wallet_name" value="{{array_keys($wallets)[0]}}">
        @endif
        <div class="input-item input-with-label">
            <label for="token-address" class="input-item-label">{{ ($wallet_count ==1) ? __('Enter your :Name wallet address', ['name' => array_values($wallets)[0]]) : __('Enter your wallet address') }}{!! required_mark('kyc_wallet') !!}</label>
            <div class="input-wrap">
                <input {{ field_value('kyc_wallet', 'req' ) == '1' ? 'required ' : '' }}class="input-bordered" type="text" id="token-address" name="wallet_address" placeholder="{{__('Your personal wallet address')}}">
            </div>
            <span class="input-note">{{__('Note:')}} {{ get_setting('kyc_wallet_note') }}</span>
        </div>--}}{{-- .input-item --}}{{--
    </div>--}}{{-- .step-fields --}}{{--
</div>
@endif--}}
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
            <label for="info-currect">{{__('All the personal information I have entered is correct.')}}</label>
        </div>
        {{--<div class="input-item">
            <input class="input-checkbox input-checkbox-md" id="certification" name="certification" type="checkbox" required="required" data-msg-required="{{ __("Certify that you are individual.") }}">
            <label for="certification">{{__("I certify that, I am registering to participate in the token distribution event(s) in the capacity of an individual (and beneficial owner) and not as an agent or representative of a third party corporate entity.")}}</label>
        </div>
        @if($has_wallet)
        <div class="input-item">
            <input class="input-checkbox input-checkbox-md" id="tokenKnow" name="tokenKnow" type="checkbox" required="required" data-msg-required="{{ __("Confirm that you understand.") }}">
            <label for="tokenKnow">{{__("I understand that, I can participate in the token distribution event(s) only with the wallet address that was entered in the application form.")}}</label>
        </div>
        @endif--}}
        <div class="gaps-1x"></div>
        <button class="btn btn-primary" type="submit">{{__('Proceed to Verify')}}</button>
    </div>{{-- .step-fields --}}
</div>
<div class="hiddenFiles"></div>


