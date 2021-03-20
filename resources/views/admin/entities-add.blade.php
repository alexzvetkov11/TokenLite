@extends('layouts.admin')
@section('title', __('Add Entity'))
    @php
    $has_sidebar = false;
    @endphp

@section('content')
    {{-- <div class="page-header page-header-kyc">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7 text-center">
                <h2 class="page-title">{{ __('Begin your ID-Verification') }}</h2>
                <p class="large">{{ __('Verify your identity to participate in token sale.') }}</p>
            </div>
        </div>
    </div> --}}
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            @include('layouts.messages')
            <div class="card mx-lg-4">
                {{-- <div class="gaps-3-5x"></div>
                <div class="card-head d-flex justify-content-between align-items-center">
                    <h4 class="card-title ml-5">Entities > Add Entity</h4>
                </div> --}}

                <div class="card-head has-aside pd-2x">
                    <div style="font-size:1.29em; color:#342d6e"> <b>{{ __('Your Entities') }} ></b> <span style="font-size:0.8em">{{ __('Add Entity') }}</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entities') }}" class="btn btn-auto btn-sm btn-primary">
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>
                <div class="form-step form-step1">
                    <div class="form-step-head card-innr">
                        <div class="step-head">
                            <div class="step-number">01</div>
                            <div class="step-head-text">
                                <h4>{{ __('Entity Adding Option') }}</h4>
                                <p>{{ __('Choose the type of Entity adding functionality that you wish to perform.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-step-fields card-innr">
                        <div class="gaps-2x"></div>
                        <ul class="document-list guttar-vr-10px">
                            <li class="document-item">
                                <div class="input-wrap">
                                    <input class="document-type" type="radio" name="documentType" value="incorporate"
                                        id="entities_option_inco" data-title="Passport"
                                        data-img="{{ asset('assets/images/vector-passport.png') }}" checked>
                                    <label for="entities_option_inco">
                                        <div class="document-type-icon">
                                            <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                            <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                        </div>
                                        <span>{{ __('incorporate New Entity') }}</span>
                                    </label>
                                </div>
                            </li>
                            <li class="document-item">
                                <div class="input-wrap">
                                    <input class="document-type" type="radio" name="documentType"
                                        id="entities_option_exist" data-change=".doc-upload-d2" value="existing"
                                        data-title="National ID Card"
                                        data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                    <label for="entities_option_exist">
                                        <div class="document-type-icon">
                                            <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                            <img src="{{ asset('assets/images/icon-national-id-color.png') }}"
                                                alt="">
                                        </div>
                                        <span>{{ __('Add Existing Entity') }}</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <form action="{{ route('admin.ajax.entities.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="exist">
                    <div id='exist'>
                        <div class="form-step form-step2">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">02</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Jurisdiction') }}</h4>
                                        <p>{{ __('Select the Jurisdiction in which you wish to incorporate the new Entity in.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="jurisdiction1" class="input-item-label ">{{ __('Supported Jurisdictions') }}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block " name="jurisdiction1" id="jurisdiction1" data-dd-class="search-on" required>
                                                    <option value=""> {{ __('Select Option') }}</option>
                                                    @foreach ( $juris_actived as $jur_act)
                                                        <option value="{{ $jur_act->id }}"> {{ $jur_act->jurisdiction_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-step3">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">03</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Entity Type') }}</h4>
                                        <p>{{ __('Select the Legal Form of the new Entity that you wish to incorporate.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="entype1" class="input-item-label">{{ __('Supported Entity Types') }}</label>
                                            <div class="input-wrap">
                                                <select class="form-control" name="entype1" id="entype1">
                                                    <option value="0">{{ __('Select Option') }}</option>
                                                    @foreach($entype as $en)
                                                        <option value="{{ $en->id }}" data-status="{{ $en->status}}" data-juris="{{ $en->jurisdiction_id }}">{{ $en->entity_type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-step4">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">04</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Entity Name') }}</h4>
                                        <p>{{ __('Choose the name of the new entity.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>Please type the Entity Name carefully, it is case-sensitive and sensitive to special
                                        characters.</p>
                                </div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>Do not include the abbreviation of the Entity Type (for example: Limited or Ltd.).
                                    </p>
                                </div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>You can still change the name later, up until the point that the Entity is formally
                                        registered.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="entity_name1 " class="input-item-label">Entity Name</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" id="entity_name1" name="entity_name1" value="" required>
                                                <div class="gaps-1x"> </div>
                                                <div> <strong>Full Name: </strong> <span id="fullname1"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-step form-step5">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">05</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Start Date') }}</h4>
                                        <p>{{ __('Choose the earliest date at which this new Entity can be formally incorporated.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="fstart_date" class="input-item-label">{{ __('Choosen Date') }}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered date-picker" type="text" id="start_date" name="start_date"  data-format="alt" required
                                                    min="{{ now()->toDateString('d-m-Y') }}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gaps-2x"></div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>By clicking "Create" a new profile for the new entity will be created and saved as a
                                        draft. Actual incorporation of the new entity will only occur after the entire
                                        application has been completed.
                                    </p>
                                </div>
                                <div class="gaps-3x"></div>
                                <button class="btn btn-primary" type="submit">{{ __('Create Entity') }} </button>
                            </div>
                        </div>
                    </div>
                </form>

                <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
                <form action="{{ route('admin.ajax.entities.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="incorporate">
                    <div id='incorporate'>
                        <div class="form-step form-step2">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">02</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Jurisdiction') }}</h4>
                                        <p>{{ __('Select the Jurisdiction in which you wish to incorporate the new Entity in.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="jurisdiction2" class="input-item-label required">{{ __('Supported Jurisdictions') }}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block required" name="jurisdiction2" id="jurisdiction2" data-dd-class="search-on">
                                                    <option value="0">{{ __('Select Option') }}</option>
                                                    <optgroup label="{{ __('Supported Jurisdictions') }}">
                                                        @foreach($juris as $jur)
                                                            @if ($jur->jur_status=='active' )
                                                                <option value="{{ $jur->id }}">{{ $jur->jurisdiction_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                    <optgroup label="{{ __('Unsupported Jurisdictions') }} ">
                                                        @foreach($juris as $jur)
                                                            @if ($jur->jur_status!='active' )
                                                                <option value="{{ $jur->id }}">{{ $jur->jurisdiction_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>

                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-step3">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">03</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Entity Type') }}</h4>
                                        <p>{{ __('Select the Legal Form of the new Entity that you wish to incorporate.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="entype2" class="input-item-label required">{{ __('Entity Types') }}</label>
                                            <div class="input-wrap">
                                                <select class="form-control required" name="entype2" id="entype2" data-dd-class="search-on">
                                                    <option value="0">{{ __('Select Option') }}</option>
                                                    @foreach ($entype as $en)
                                                        <option value="{{ $en->id }}" data-juris="{{ $en->jurisdiction_id }}"> {{ $en->entity_type_name }}</option>
                                                    @endforeach
                                                    <option value="other"> {{ __('Other') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 other">
                                        <div class="input-item input-with-label">
                                            <label for="other" class="input-item-label">{{ __('Other Entity Type') }}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" id="other" name="other">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-step4">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">04</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Entity Name') }}</h4>
                                        <p>{{ __('Choose the name of the new entity.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('Please type the Entity Name carefully, it is case-sensitive and sensitive to special characters.') }}
                                    </p>
                                </div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('Do not include the abbreviation of the Entity Type (for example: Limited or Ltd.).') }}
                                    </p>
                                </div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>You can still change the name later, up until the point that the Entity is formally
                                        registered.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="entity_name2" class="input-item-label required">Entity Name</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered required" type="text" id="entity_name2" name="entity_name2" value="">
                                                <div class="gaps-1x"> </div>
                                                <div> <strong>Full Name: </strong> <span id="fullname2"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-step form-step5">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">05</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Registration Details') }}</h4>
                                        <p>{{ __('Enter the Registration Details of the existing Entity so that it can be easily identified.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="registration" class="input-item-label">{{ __('Registration Number at Registrar:') }}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" name="registration" id="registration">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-step6">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">06</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Upload Documents') }}</h4>
                                        <p>{{ __('Upload the Statutory Documents and Extracts of the existing Entity so we can most of the work for you.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="note note-plane note-light-alt note-md pdb-0-5x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('Upload all Statutory Documents and Extracts that are related to: incorporation, statutory agreements, members, directors, officers') }}
                                    </p>
                                </div>
                                <div class="gaps-2x"></div>
                                <div class="doc-upload doc-upload-d1">
                                    <h6 class="font-mid doc-type-title">{!! __('Upload Documents') !!}</h6>
                                    <div class="row align-items-center">
                                        <div class="col-sm-8">
                                            <div class="upload-box">
                                                <div class="upload-zone document_one">
                                                    <div class="dz-message" data-dz-message>
                                                        <span class="dz-message-text">{{ __('Drag and drop file') }}</span>
                                                        <span class="dz-message-or">{{ __('or') }}</span>
                                                        <button type="button" class="btn btn-primary">{{ __('Select') }}</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="document_one"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-step form-step7">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">07</div>
                                    <div class="step-head-text">
                                        <h4>{{ __('Onboarding Type') }}</h4>
                                        {{-- <p>{{ __('Choose the name of the new entity.') }}</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('"Full Functionality" means that the Entity can make full use of all the functionalities of the Apollo Platform. This option is only available for supported Entity Types.') }}
                                    </p>
                                </div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('"Listing Only" means that the Entity gets registered on the Apollo Platform for administrative and reference purposes, however, is not supported able to make use of most of the Entity Management Functionalities.') }}
                                    </p>
                                </div>
                                <ul class="document-list guttar-vr-10px">
                                    <li class="document-item">
                                        <div class="input-wrap">
                                            <input class="document-type" type="radio" name="onboarding" value="full_functionality"
                                                id="full_functionality" data-title="Passport" checked>
                                            <label for="full_functionality"><span>{{ __('Full Functionality') }}</span></label>
                                        </div>
                                    </li>
                                    <li class="document-item">
                                        <div class="input-wrap">
                                            <input class="document-type" type="radio" name="onboarding"
                                                id="listing_only" value="listing_only" data-title="National ID Card">
                                            <label for="listing_only"><span>{{ __('Listing Only') }}</span></label>
                                        </div>
                                    </li>
                                </ul>
                                <div class="gaps-2x"></div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('By clicking "Create" a new profile for the new entity will be created and saved as a draft. Actual incorporation of the new entity will only occur after the entire application has been completed.') }}
                                    </p>
                                </div>
                                <div class="gaps-2x"></div>
                                <button class="btn btn-primary" type="submit">{{ __('Add Entity') }} </button>
                            </div>
                        </div>

                        <div class="gaps-1x"></div>
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

@push('footer')
    <script type="text/javascript">
        (function($){

            show_entype1();
            $("#jurisdiction1").on('change', function(){
                show_entype1();
            });
            function show_entype1(){
                var entypeOptions = $('#entype1 option');
                for( var i=1; i<entypeOptions.length; i++){
                    if ($(entypeOptions[i]).data('status')=='supported' && $(entypeOptions[i]).data('juris')==$('#jurisdiction1').val() ){
                        $(entypeOptions[i]).show();
                    } else {
                        $(entypeOptions[i]).hide();
                    }
                }
                $('#entype1').val("0").change();
            }


            show_entype2();
            $('#jurisdiction2').on('change', function(){
                show_entype2();
            });
            function show_entype2(){
                var entypeOptions = $('#entype2 option');
                for( var i=1; i<entypeOptions.length-1; i++){
                    if ($(entypeOptions[i]).data('juris')==$('#jurisdiction2').val() ){
                        $(entypeOptions[i]).show();
                    } else {
                        $(entypeOptions[i]).hide();
                    }
                }
                $('#entype2').val("0").change();
            }

            $('.other').hide();
            $('#entype2').on('change', function (){
                if ( $(this).val()=='other'){
                    console.log("here");
                    $('.other').show();
                    $('#listing_only').prop('checked', true).trigger('click');
                    $('#full_functionality').prop('disabled', true);
                } else {
                    $('#full_functionality').prop('disabled', false);
                    $('.other').hide();
                }
            })


            $("#entity_name1").on('keyup', function(){
                var prefix="", position="";
                @foreach($entype as $en)
                    if( "{{ $en->id }}" == $('#entype1').val() ) {
                        prefix = "{{ $en->abbrev_short }}";
                        position = "{{ $en->abbrev_position }}";
                    }
                @endforeach

                var str=$(this).val();
                if ( str.length>0) {
                    if ( position=="&lt;"){
                        str = prefix + " " + str;
                    } else {
                        str += " " + prefix;
                    }
                }
                $("#fullname1").text( str );
            });

            $("#entity_name2").on('keyup', function(){
                var prefix="", position="";
                @foreach($entype as $en)
                    if( "{{ $en->id }}" == $('#entype2').val() ) {
                        prefix = "{{ $en->abbrev_short }}";
                        position = "{{ $en->abbrev_position }}";
                    }
                @endforeach

                var str=$(this).val();
                if ( str.length>0) {
                    if ( position=="&lt;"){
                        str = prefix + " " + str;
                    } else {
                        str += " " + prefix;
                    }
                }
                $("#fullname2").text( str );
            });

        })(jQuery);
    </script>
@endpush
