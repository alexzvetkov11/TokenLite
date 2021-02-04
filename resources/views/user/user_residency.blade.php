@extends('layouts.user')
@section('title', __('Kyc Residency'))
@php
$has_sidebar = false;
@endphp

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-9">

        @include('layouts.messages')
        <div class=" card mx-lg-4">
            <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
            <form >
                @csrf
           
                <div class="form-step form-step1">
                    <div class="form-step-head card-innr">
                        <div class="step-head">
                            <div class="step-number">01</div>
                            <div class="step-head-text">
                                <h4>{{__('Residency')}}</h4>
                                <p>{{__('For regulatory purposes, we are required to obtain information about your residency.')}}</p>
                            </div>
                        </div>
                    </div>
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
                                            <input
                                                {{ field_value('kyc_firstname', 'req' ) == '1' ? 'required ' : '' }} 
                                                class="input-bordered" type="text" name="first_name" id="first-name"
                                                {{-- value="{{ isset($user_kyc) ? $user_kyc->first_middle_names : ''}}"   --}}
                                                >
                                        </div>
                                    </div>
                                </div>
                            @endif

                            
                        </div>
                    </div>
                </div>

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
