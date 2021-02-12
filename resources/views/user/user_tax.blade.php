@extends('layouts.user')
@section('title', __('Kyc Tax'))
    @php
    $has_sidebar = false;
    @endphp

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            @include('layouts.messages')
            <div class=" card mx-lg-4">
                <div class="card-head has-aside pd-2x">
                    <h4 ><b>{{ __('Verification') }} </b> > {{ __('Tax') }}</h4>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('user.compliance') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>

                <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
                <form action="{{ route('user.ajax.kyc.submit') }}" method="POST">
                    <input type="hidden" name="type" value="tax">
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
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Tax') }}</h4>
                                    <p>{{ __('For purposes, we are required to obtain information about your tax status.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="note-light-alt pdb-1x text-primary">
                                <p class="text-primary">{{ __('Primary Tax Residence') }}</p>
                            </div>
                            <div class="row">
                                {{-- @if (field_value('kyc_country_birth', 'show')) --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="primary_residency" class="input-item-label">
                                            {{ __('Tax Residence Country') }}
                                            @if (field_value('kyc_country_birth', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="primary_residency"
                                                id="primary_residency" data-dd-class="search-on" aria-placeholder="Choose Country">
                                                <option value="">{{ __('Choose Country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option
                                                        {{ (isset($kyct->primary_residence) ? _x($kyct->primary_residence) : '') == $country ? 'selected' : '' }}
                                                        value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}

                                {{-- @if (field_value('kyc_birthPlace', 'show')) --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="primary_tin" class="input-item-label">
                                            {{ __('Taxpayer Identification Number (TIN)') }}
                                            @if (field_value('kyc_dob', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_dob', 'req') == '1' ? 'required ' : '' }}
                                                class="input-bordered numerical" type="text" id="primary_tin"
                                                name="primary_tin" placeholder="Enter Details"
                                                value="{{ isset($kyct->primary_tin) ? $kyct->primary_tin : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="note-light-alt pdb-1x">
                                <p class="text-primary">{{ __('Secondary Tax Residence') }}</p>
                            </div>
                            <div class="row">
                                {{-- @if (field_value('kyc_firstname', 'show')) --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="secondary_residence" class="input-item-label">
                                            {{ __('Tax Residence Country') }}
                                            @if (field_value('kyc_firstname', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="secondary_residence"
                                                id="secondary_residence" data-dd-class="search-on" aria-placeholder="Choose Country">
                                                <option value="">{{ __('Choose Country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option
                                                        {{ (isset($kyct->secondary_residence) ? $kyct->secondary_residence : '') == $country ? 'selected' : '' }}
                                                        value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="secondary_tin" class="input-item-label">
                                            {{ __('Taxpayer Identification Number (TIN)') }}
                                            @if (field_value('kyc_dob', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_dob', 'req') == '1' ? 'required ' : '' }}
                                                class="input-bordered numerical" type="text" id="secondary_tin"
                                                name="secondary_tin" placeholder="Enter Details"
                                                value="{{ isset($kyct->secondary_tin) ? $kyct->secondary_tin : '' }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                            <div class="note-light-alt pdb-1x">
                                <p class="text-primary">{{ __('U.S. Tax Residence') }}</p>
                            </div>
                            <div class="row">
                                {{-- @if (field_value('kyc_firstname', 'show')) --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="us_tax_residency" class="input-item-label">
                                            {{ __('I here by certify that I am:') }}
                                            @if (field_value('kyc_firstname', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="us_tax_residency"
                                                id="us_tax_residency" data-dd-class="search-on" aria-placeholder="Choose Country">
                                                <option value="Y" {{ $kyct->us_tax_residency && $kyct->us_tax_residency=="Y" ? 'selected' : '' }}>{{ __('U.S. tax resident.') }}</option>
                                                <option value="N" {{ $kyct->us_tax_residency && $kyct->us_tax_residency=="N" ? 'selected' : '' }}>{{ __('Not U.S. tax resident.') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                            <div class="note-light-alt pdb-1x">
                                <p class="text-primary">{{ __('Other') }}</p>
                            </div>
                            <div class="row">
                                {{-- @if (field_value('kyc_firstname', 'show')) --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="marital_status" class="input-item-label">
                                            {{ __('Marital Status') }}
                                            @if (field_value('kyc_firstname', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="marital_status"
                                                id="marital_status" data-dd-class="search-on" aria-placeholder="Choose Country">
                                                <option value="">{{ __('Choose Option') }}</option>
                                                <option value="Divorced" {{ $kyct->marital_status && $kyct->marital_status=="Divorced" ? 'selected' : '' }}>{{ __('Divorced') }}</option>
                                                <option value="Married" {{ $kyct->marital_status && $kyct->marital_status=="Married" ? 'selected' : '' }}>{{ __('Married') }}</option>
                                                <option value="Registered Partnership" {{ $kyct->marital_status && $kyct->marital_status=="Registered Partnership" ? 'selected' : '' }}>{{ __('Registered Partnership') }}</option>
                                                <option value="Separated {{ $kyct->marital_status && $kyct->marital_status=="Separated" ? 'selected' : '' }}">{{ __('Separated') }}</option>
                                                <option value="Single" {{ $kyct->marital_status && $kyct->marital_status=="Single" ? 'selected' : '' }}>{{ __('Single') }}</option>
                                                <option value="Widowed" {{ $kyct->marital_status && $kyct->marital_status=="Widowed" ? 'selected' : '' }}>{{ __('Widowed') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                {{-- @if (field_value('kyc_firstname', 'show')) --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="dependents_number" class="input-item-label">
                                            {{ __('Number of Dependents') }}
                                            @if (field_value('kyc_firstname', 'req'))
                                                <span class="text-require text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-wrap">
                                            <input {{ field_value('kyc_firstname', 'req') == '1' ? 'required ' : '' }}
                                                class="input-bordered" type="text" name="dependents_number" id="dependents_number" placeholder="Enter Details- Whole Numebers"
                                                value="{{ isset($kyct->dependents_number) ? $kyct->dependents_number : '' }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                    @if($has_docs)
                        <div class="form-step form-step2">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">{{ $step_02 }}</div>
                                    <div class="step-head-text">
                                        <h4>{{__('Tax Document Upload')}}</h4>
                                        <p>{{__('To verify your tax status, we ask you to upload high-quality scans or photos of certain official tax documents that provide Proof of Tax Registration.')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="note note-plane note-light-alt note-md pdb-0-5x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{__('In order to complete, please upload any of the following personal documents.')}}</p>
                                </div>
                                <div class="gaps-2x"></div>

                                <div class="doc-upload-area">
                                    <p class="text-secondary font-bold">{{__('To avoid delays with verification process, please double-check to ensure the below requirements are fully met:')}}</p>
                                    <ul class="list-check">
                                        <li>{{__('Document must include your Tax Identification Number (TIN).')}}</li>
                                        <li>{{__('Document should be in good 12 months old.')}}</li>
                                    </ul>
                                    <div class="gaps-2x"></div>
                                    <div class="doc-upload doc-upload-d1">
                                        <h6 class="font-mid doc-type-title">{!! __('Upload Here a Tax Statement of your Primary Tax Residence') !!}</h6>
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
                                    <div class="gaps-3x"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="document_primary_issue_date" class="input-item-label">
                                                    {{__('Issue Date')}}
                                                    @if (field_value('kyc_dob', 'req'))
                                                        <span class="text-require text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="input-wrap">
                                                    <input {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}
                                                        class="input-bordered date-picker" type="text" id="document_primary_issue_date" name="document_primary_issue_date"  data-format="alt"
                                                        value="{{ isset($kyct) ? _date($kyct->document_primary_issue_date, 'd/m/Y') : ''}}" max="{{ now()->toDateString('d-m-Y') }}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doc-upload doc-upload-d2">
                                        <h6 class="font-mid doc-type-title">{!! __('Upload Here a Tax Statement of your Secondary Tax Residence') !!}</h6>
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
                                                    <img width="160" class="_image"
                                                        src="{{ asset('assets/images/vector-'.$defaultImg.'.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gaps-3x"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="document_secondary_issue_date" class="input-item-label">
                                                    {{__('Issue Date')}}
                                                    @if (field_value('kyc_dob', 'req'))
                                                        <span class="text-require text-danger">*</span>
                                                    @endif
                                                </label>
                                                <div class="input-wrap">
                                                    <input {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}
                                                        class="input-bordered date-picker" type="text" id="document_secondary_issue_date" name="document_secondary_issue_date"  data-format="alt"
                                                        value="{{ isset($kyct) ? _date($kyct->issue_date, 'd/m/Y') : ''}}" min="{{ now()->toDateString('d-m-Y') }}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="gaps-3x"></div> --}}
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="issue_date" class="input-item-label">
                                                {{__('Issue Date')}}
                                                @if (field_value('kyc_dob', 'req'))
                                                    <span class="text-require text-danger">*</span>
                                                @endif
                                            </label>
                                            <div class="input-wrap">
                                                <input {{ field_value('kyc_dob', 'req' ) == '1' ? 'required ' : '' }}
                                                    class="input-bordered date-picker" type="text" id="issue_date" name="issue_date"  data-format="alt"
                                                    value="{{ isset($kyct) ? _date($kyct->issue_date, 'd/m/Y') : ''}}" max="{{ now()->toDateString('d-m-Y') }}" >
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        </div>

                    @endif

                    <div class="form-step form-step-final">
                        <div class="form-step-fields card-innr">
                            @if (get_page('privacy', 'status') == 'active' || get_page('terms', 'status') == 'active')
                                <div class="input-item">
                                    <input class="input-checkbox input-checkbox-md" id="term-condition" name="condition"
                                        type="checkbox" required="required"
                                        data-msg-required="{{ __('You should read our terms and policy.') }}">
                                    <label for="term-condition">{{ __('I have read the') }} {!! get_page_link('terms',
                                        ['target' => '_blank']) !!}
                                        {{ get_page_link('terms') && get_page_link('policy') ? __('and') : '' }} {!!
                                        get_page_link('policy', ['target' => '_blank']) !!}
                                        .</label>
                                </div>
                            @endif
                            <div class="input-item">
                                <input class="input-checkbox input-checkbox-md" id="info-currect" name="currect"
                                    type="checkbox" required="required"
                                    data-msg-required="{{ __('Confirm that all information is correct.') }}">
                                <label
                                    for="info-currect">{{ __('All the information I have entered is correct.') }}</label>
                            </div>

                            <div class="gaps-1x"></div>
                            <button class="btn btn-primary" type="submit">{{ __('Proceed to Verify') }}</button>
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
