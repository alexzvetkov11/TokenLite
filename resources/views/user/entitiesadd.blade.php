@extends('layouts.user')
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
                    <h4 >Entities > Add Entity</h4>
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
                        <div class="form-step-fields card-innr ml-5">
                            <div class="gaps-2x"></div>
                            <ul class="document-list guttar-vr-10px">
                                <li class="document-item" >
                                    <div class="input-wrap" onClick="onOptionChange(1)">
                                        <input class="document-type" type="radio" name="documentType" value="newentity"
                                            id="docType-newentity" data-title="Passport"
                                            data-img="{{ asset('assets/images/vector-passport.png') }}" checked>
                                        <label for="docType-newentity"  >
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-passport.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-passport-color.png') }}" alt="">
                                            </div>
                                            <span style="text-transform: none;">Incorporate New Entity</span>
                                        </label>
                                    </div>
                                </li>
                                <li class="document-item">
                                    <div class="input-wrap" onClick="onOptionChange(2)">
                                        <input class="document-type" type="radio" name="documentType" value="addentity" 
                                            id="docType-addentity" data-title="National ID Card"
                                            data-img="{{ asset('assets/images/vector-nidcard.png') }}">
                                        <label for="docType-addentity" >
                                            <div class="document-type-icon">
                                                <img src="{{ asset('assets/images/icon-national-id.png') }}" alt="">
                                                <img src="{{ asset('assets/images/icon-national-id-color.png') }}" alt="">
                                            </div>
                                            <span style="text-transform: none;">Add Existing Entity</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-step form-step3" name="newentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Jurisdiction') }}</h4>
                                    <p>{{ __('Choose the Jurisdiction in which you wish to incorporate.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="jurisdictions" class="input-item-label">Supported Jurisdictions</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="jurisdictions" id="jurisdictions" data-dd-class="search-on">
                                                @foreach ($juris as $jur)
                                                    <option value="{{ $jur->jurisdiction_name }}"> {{ $jur->jurisdiction_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="gaps-4x"></div>
                    </div>

                    <div class="form-step form-step3" name="newentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">03</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Entity Type') }}</h4>
                                    <p>{{ __('Choose the type of legal entity that you wish to incorporate.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="entitytype" class="input-item-label">Entity Type</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="entitytype" id="entitytype" data-dd-class="search-on">
                                                <option value="" default>Entity Type</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="gaps-4x"></div>
                    </div>

                    <div class="form-step form-step-final" name="newentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">04</div>
                                <div class="step-head-text">
                                    <h4>Entity Name</h4>
                                    <p>Choose the name of the new entity.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
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
                                            <input class="input-bordered" onchange="newEntityName(this.value)" type="text" id="first-name" name="first_name" value="" placeholder="Enter Entity Name">
                                            <div class="gaps-1x"> </div>
                                            <div> <strong>Full Name: </strong><span id="newEntityName"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="note note-plane note-light-alt note-md pdb-1x">
                                <em class="fas fa-info-circle"></em>
                                <p>By clicking “Create” a new profile for the new entity will be created and saved as a draft. Actual incorporation of the new entity will only occur after the entire application has been completed.
                                </p>
                                <div class="gaps-4x"> </div>
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-step form-step3" name="addentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Jurisdiction') }}</h4>
                                    <p>{{ __('Choose the Jurisdiction in which you wish to incorporate.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="jurisdictions" class="input-item-label">Supported Jurisdictions</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="jurisdictions" id="jurisdictions" data-dd-class="search-on">
                                                <option value="" default>Jurisdictions</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="unjurisdictions" class="input-item-label">Unsupported Jurisdictions</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="unjurisdictions" id="unjurisdictions" data-dd-class="search-on">
                                                <option value="" default>Jurisdictions</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="gaps-4x"></div>
                    </div>

                    <div class="form-step form-step3" name="addentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">03</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Entity Type') }}</h4>
                                    <p>{{ __('Choose the type of legal entity that you wish to incorporate.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="entitytype" class="input-item-label">Entity Type</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="entitytype" id="entitytype" data-dd-class="search-on">
                                                <option value="" default>Entity Type</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="gaps-4x"></div>
                    </div>

                    <div class="form-step form-step3" name="addentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">04</div>
                                <div class="step-head-text">
                                    <h4>Entity Name</h4>
                                    <p>Choose the name of the new entity.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
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
                                            <input class="input-bordered" onchange="addEntityName(this.value)" type="text" id="first-name" name="first_name" value="" placeholder="Entity Name">
                                            <div class="gaps-1x"> </div>
                                            <div> <strong>Full Name: </strong> <span id="addEntityName"> </span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="registration" class="input-item-label">Commercial Register – Registration Number </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" id="registration" name="registration" value="100449230">
                                            <div class="gaps-1x"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                
                    <div class="form-step form-step-final" name="addentityfield">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">05</div>
                                <div class="step-head-text">
                                    <h4>Upload Documents</h4>
                                    <p>Upload Statutory Documents.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr ml-5">
                            <div class="col-md-6">
                                <h6 class="font-mid">Upload Here Your Proof of Address Document</h6>
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
                            </div>
                            <div class="gaps-2x"></div>
                            <div class="col-md-12">
                                <ul class="list-check">
                                    <li>{{__('Shareholder Register')}}</li>
                                    <li>{{__('Directors Register')}}</li> 
                                </ul>
                                <div class="gaps-2x"></div>
                            </div>
                            <div class="note note-plane note-light-alt note-md pdb-1x">
                                <em class="fas fa-info-circle"></em>
                                <p>By clicking “Create” a new profile for the new entity will be created and saved as a draft. Actual incorporation of the new entity will only occur after the entire application has been completed.
                                </p>
                                <div class="gaps-2x"> </div>
                                <button class="btn btn-primary">Add Existing Entity</button>
                            </div>
                        </div>
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
        onOptionChange(1);
        function onOptionChange(index){
            if (index==1 )    {
                var x = document.getElementsByName("newentityfield");
                console.log(x.length);
                for (var i=0; i<x.length; i++)
                    x[i].style.display="block";

                var y = document.getElementsByName("addentityfield");
                for (var i=0; i<y.length; i++)
                    y[i].style.display="none";
            }else{
                var x = document.getElementsByName("newentityfield");
                for (var i=0; i<x.length; i++)
                    x[i].style.display="none";

                var y = document.getElementsByName("addentityfield");
                for (var i=0; i<y.length; i++)
                    y[i].style.display="block";
            }
        }
        function newEntityName( val){
            if ( val.length>0)
                document.getElementById("newEntityName").innerText = val + " B.V.";
            else
                document.getElementById("newEntityName").innerText = "";
        }
        function addEntityName( val){
            if ( val.length>0)
                document.getElementById("addEntityName").innerText = val + " B.V.";
            else
                document.getElementById("addEntityName").innerText = "";
        }
    </script>
@endsection
