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

            <div class="<!--kyc-form-steps--> card mx-lg-4">
                {{--  <div class="gaps-3-5x"></div>
                <div class="card-head d-flex justify-content-between align-items-center">
                    <h4 class="card-title ml-5">Entities > Add Entity</h4>
                </div>  --}}

                <div class="card-head has-aside pd-2x">
                    <h4 class="card-title">Entities > Add Entity</h4>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entity') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>


                <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
                <form class="<!--validate-modern-->" action="{{ route('user.ajax.kyc.submit') }}" method="POST"
                    id="<!--kyc_submit-->">
                    @csrf
                    <div class="form-step form-step3">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Entity Adding Option') }}</h4>
                                    <p>{{ __('Choose the type of entity adding functionality you want to perform.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="gaps-2x"></div>
                            <ul class="document-list guttar-vr-10px">
                                <li class="document-item">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType" value="passport"
                                            id="docType-passport" data-title="Passport"
                                            data-img="{{ asset('assets/images/vector-passport.png') }}" checked>
                                        <label for="docType-passport" >
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                            </div>
                                            <span>Incorporate New Entity  </span>
                                        </label>
                                    </div>
                                </li>
                                <li class="document-item">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType"
                                            data-change=".doc-upload-d2" value="nidcard" id="docType-nidcard"
                                            data-title="National ID Card"
                                            data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="docType-nidcard">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}" alt="">
                                            </div>
                                            <span>Add Existing Entity</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-step form-step3">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Jurisdiction') }}</h4>
                                    <p>{{ __('Choose the Jurisdiction in which you wish to incorporate.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <ul class="document-list guttar-vr-10px">
                                <li class="document-item">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType" value="passport"
                                            id="docType-passport" data-title="Passport"
                                            data-img="{{ asset('assets/images/vector-passport.png') }}" checked>
                                        <label for="docType-passport">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                            </div>
                                            <span>Netherlands</span>
                                        </label>
                                    </div>
                                </li>
                                <li class="document-item">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType"
                                            data-change=".doc-upload-d2" value="nidcard" id="docType-nidcard"
                                            data-title="National ID Card"
                                            data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="docType-nidcard">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}" alt="">
                                            </div>
                                            <span>United Kingdom</span>
                                        </label>
                                    </div>
                                </li>
                                <li class="document-item">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType"
                                            data-change=".doc-upload-d2" value="nidcard" id="docType-nidcard"
                                            data-title="National ID Card" data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="docType-nidcard">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}" alt="">
                                            </div>
                                            <span>British Virgin Islands</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-step form-step3">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">03</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Entity Type') }}</h4>
                                    <p>{{ __('Choose the type of legal entity that you wish to incorporate.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <ul class="document-list guttar-vr-10px" style="margin-left:-20px; margin-right: -20px;">
                                <li class="document-item" style="padding-left:5px; padding-right:0px">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType" value="passport"
                                            id="docType-passport" data-title="Passport"
                                            data-img="{{ asset('assets/images/vector-passport.png') }}" checked>
                                        <label for="docType-passport">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                            </div>
                                            <div class='column'>
                                                <span style="float: left; clear: both;"><span class='title'>Short title comes here</span></span>
                                                <span style="float: left; clear: both;"><span class='title'>(Besloten Vennootschap)</span></span>
                                            </div>
                                        </label>
                                    </div>
                                </li>
                                <li class="document-item" style="padding-left:5px; padding-right:0px">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType"
                                            data-change=".doc-upload-d2" value="nidcard" id="docType-nidcard"
                                            data-title="National ID Card"
                                            data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="docType-nidcard">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}" alt="">
                                            </div>
                                            <div>
                                                <span style="float:left; clear: both;"><span class='title'>Public Limited Company</span></span>
                                                <span style="float:left; clear: both;"><span class='title'>(Naamloze Vennootschap)</span></span>
                                            </div>
                                        </label>
                                    </div>
                                </li>
                                <li class="document-item" style="padding-left:5px; padding-right:0px">
                                    <div class="input-wrap">
                                        <input class="document-type" type="checkbox" name="documentType"
                                            data-change=".doc-upload-d2" value="nidcard" id="docType-nidcard"
                                            data-title="National ID Card"
                                            data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="docType-nidcard">
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}" alt="">
                                            </div>
                                            <div>
                                                <span style="float:left; clear: both;"><span class='title'>Foundation</span></span>
                                                <span style="float:left; clear: both;"><span class='title'>(Stichting)</span></span>
                                            </div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-step form-step3">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">04</div>
                                <div class="step-head-text">
                                    <h4>Entity Name</h4>
                                    <p>Choose the name of the new entity.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="note note-plane note-light-alt note-md pdb-1x">
                                <em class="fas fa-info-circle"></em>
                                <p>Please type the Entity Name carefully, it is both case-sensitive and sensitive for special characters. Do not include the entity type abbreviation.
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="first-name" class="input-item-label">Entity Name</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" id="first-name" name="first_name" value="Mercer Worth">
                                            <div class="gaps-1x"> </div>
                                            <div> <strong>Full Name: </strong> Mercer Worth B.V.</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="form-step form-step3">
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
                                        <label for="first-name" class="input-item-label">User</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="Proof of Address Type" id="Proof of Address Type" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="note note-plane note-light-alt note-md pdb-1x">
                                <em class="fas fa-info-circle"></em>
                                <p>By clicking “Create” a new profile for the new entity will be created and saved as a draft. Actual incorporation of the new entity will only occur after the entire application has been completed.
                                </p>
                                <button class="btn btn-primary">Create</button>
                            </div>
                       </div>
                    </div>

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
