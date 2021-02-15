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
                    <h4 class="card-title">Entities > Add Entity</h4>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entity') }}" class="btn btn-auto btn-sm btn-primary">
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>

                <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
                <form action="{{ route('admin.ajax.entities.add') }}" method="POST">
                    @csrf
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
                                        <input class="document-type" type="radio" name="documentType" value="passport"
                                            id="entities_option_inco" data-title="Passport"
                                            data-img="{{ asset('assets/images/vector-passport.png') }}" checked>
                                        <label for="entities_option_inco">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                            </div>
                                            <span>Incorporate New Entity</span>
                                        </label>
                                    </div>
                                </li>
                                {{--  --}}
                                {{--  --}}
                                <li class="document-item">
                                    <div class="input-wrap">
                                        <input class="document-type" type="radio" name="documentType"
                                            id="entities_option_exist" data-change=".doc-upload-d2" value="nidcard"
                                            data-title="National ID Card"
                                            data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="entities_option_exist">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}"
                                                    alt="">
                                            </div>
                                            <span>Add Existing Entity</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

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
                                            <label for="first-name"
                                                class="input-item-label">{{ __('Supported Jurisdictions') }}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block" name="Proof of Address Type"
                                                    id="Proof of Address Type" data-dd-class="search-on">
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
                                            <label for="first-name"
                                                class="input-item-label">{{ __('Supported Entity Types') }}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block" name="Proof of Address Type"
                                                    id="Proof of Address Type" data-dd-class="search-on">
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
                                            <label for="first-name" class="input-item-label">Entity Name</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" id="first-name" name="first_name"
                                                    value="Mercer Worth">
                                                <div class="gaps-1x"> </div>
                                                <div> <strong>Full Name: </strong> Mercer Worth B.V.</p>
                                                </div>
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
                                        <h4>Assignment</h4>
                                        <p>Choose the User who will perform the Role of Secretary for this new entity.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Choosen Date</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered date-picker" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>By clicking "Create" a new profile for the new entity will be created and saved as a
                                        draft. Actual incorporation of the new entity will only occur after the entire
                                        application has been completed.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-final">
                            <div class="form-step-fields card-innr">
                                <button class="btn btn-primary">{{ __('Create Entity') }} </button>
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                    </div>

                    <div id='existing'>
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
                                            <label for="first-name"
                                                class="input-item-label">{{ __('Supported Jurisdictions') }}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block" name="Proof of Address Type"
                                                    id="Proof of Address Type" data-dd-class="search-on">
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
                                            <label for="first-name"
                                                class="input-item-label">{{ __('Entity Types') }}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block" name="Proof of Address Type"
                                                    id="Proof of Address Type" data-dd-class="search-on">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name"
                                                class="input-item-label">{{ __('Other Entity Type') }}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" id="dd">
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
                                            <label for="first-name" class="input-item-label">Entity Name</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" id="first-name" name="first_name"
                                                    value="Mercer Worth">
                                                <div class="gaps-1x"> </div>
                                                <div> <strong>Full Name: </strong> Mercer Worth B.V.</p>
                                                </div>
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
                                            <label for="first-name"
                                                class="input-item-label">{{ __('Registration Number at Registrar:') }}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text">
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
                                                        <span
                                                            class="dz-message-text">{{ __('Drag and drop file') }}</span>
                                                        <span class="dz-message-or">{{ __('or') }}</span>
                                                        <button type="button"
                                                            class="btn btn-primary">{{ __('Select') }}</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="document_one" />
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
                                            <input class="document-type" type="radio" name="onboarding" value="passport"
                                                id="full_functionality" data-title="Passport" checked>
                                            <label for="full_functionality"><span>Full Functionality</span></label>
                                        </div>
                                    </li>

                                    <li class="document-item">
                                        <div class="input-wrap">
                                            <input class="document-type" type="radio" name="onboarding"
                                                id="listing_only" value="nidcard" data-title="National ID Card">
                                            <label for="listing_only"><span>Add Existing Entity</span></label>
                                        </div>
                                    </li>
                                </ul>
                                <div class="note note-plane note-light-alt note-md pdb-1x">
                                    <em class="fas fa-info-circle"></em>
                                    <p>{{ __('By clicking "Create" a new profile for the new entity will be created and saved as a draft. Actual incorporation of the new entity will only occur after the entire application has been completed.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step form-final">
                            <div class="form-step-fields card-innr">
                                <button class="btn btn-primary">{{ __('Add Entity') }} </button>
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
