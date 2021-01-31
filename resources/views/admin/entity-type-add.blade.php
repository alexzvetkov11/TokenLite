@extends('layouts.admin')
@section('title', __('Add Entity Type'))
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
                <div class="card-head has-aside pd-2x">
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entity Types ></b> <span style="font-size:0.8em">Add Entity Type</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entity') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>

                {{-- <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" /> --}}
                <form action="{{ isset($entype) ?  route('admin.ajax.entype.editinitial') : route('admin.ajax.entype.addinitial') }}" method="POST">
                    @csrf

                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{__('Name Details')}}</h4>
                                    <p>{{__('Fill in the name details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="entityname" class="input-item-label">{{__('Entity Type: Full Name')}}</label>
                                        <div class="input-wrap">
                                            <input required type="text" class="input-bordered" id="entityname" name="entityname" placeholder="Full Name"
                                                value="{{ isset($entype)?$entype->entity_type_name : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="abbrev_long" class="input-item-label">{{__('Entity Type: Long Abbreviation')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder="abbrev_long" type="text" id="abbrev_long" name="longabb"
                                                value="{{ isset($entype)?$entype->abbrev_long : ''}}">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}



                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="abbrev_short" class="input-item-label">{{__('Entity Type: Short Abbreviation')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder="Short Abbreviation" type="text" id="abbrev_short" name="abbrev_short"
                                                value="{{ isset($entype)?$entype->abbrev_short : ''}}">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="abbrev_position" class="input-item-label">{{__('Abbreviation Position')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="abbrev_position" id="abbrev_position" data-dd-class="search-on">
                                                <option value="" default >-- Select --</option>
                                                <option value=">" {{ isset($entype)&&$entype->abbrev_position==">"? 'selected' : ''}}>Behind</option>
                                                <option value="<" {{ isset($entype)&&$entype->abbrev_position=="<"? 'selected' : ''}}>Before</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{__('Principal Characteristics')}}</h4>
                                    <p>{{__('Fill in the principal characteristics of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="legalStructure" class="input-item-label">{{__('Legal Structure')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="legalStructure" id="legalStructure"  data-dd-class="search-on" required>
                                                <option default value="">-- Select --</option>
                                                @foreach($legals as $legal)
                                                <option value="{{ $legal->id}}" {{ isset($entype)&&$entype->legal_structure_id==$legal->id? 'selected' : ''}}>{{$legal->label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="jurisdiction"  class="input-item-label">{{__('Jurisdiction')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="jurisdiction" id="jurisdiction"  data-dd-class="search-on">
                                                <option default value="">-- Select --</option>
                                                @foreach( $juris as $jur)
                                                <option value="{{ $jur->id }}" {{ isset($entype)&&$entype->jurisdiction_id==$jur->id? 'selected' : ''}}> {{ $jur->jurisdiction_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="separateLegal" class="input-item-label">{{__('Separate Legal Personality')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="separateLegal" id="separateLegal" data-dd-class="search-on">
                                                <option default value="">-- Select --</option>
                                                <option value="Y" {{ isset($entype)&&$entype->separate_legal_person=="Y"? 'selected' : ''}}>Yes</option>
                                                <option value="N" {{ isset($entype)&&$entype->separate_legal_person=="N"? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="formationDocuments" class="input-item-label">{{__('Formation Documents')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="formationDocuments" id="formationDocuments"  data-dd-class="search-on" multiple="multiple" data-placeholder="-- Select --">
                                                <option value="Memorandum of Association" {{ isset($entype)&&$entype->formation_documents=="Memorandum of Association"? 'selected' : ''}}>Memorandum of Association</option>
                                                <option value="Articles of Association" {{ isset($entype)&&$entype->formation_documents=="Articles of Association"? 'selected' : ''}}>Articles of Association</option>
                                                <option value="Partnership Agreement" {{ isset($entype)&&$entype->formation_documents=="Partnership Agreement"? 'selected' : ''}}>Partnership Agreement</option>
                                                <option value="Operating Agreement" {{ isset($entype)&&$entype->formation_documents=="Operating Agreement"? 'selected' : ''}}>Operating Agreement</option>
                                                <option value="Articles of Organization" {{ isset($entype)&&$entype->formation_documents=="Articles of Organization"? 'selected' : ''}}>Articles of Organization</option>
                                                <option value="Articles of Association" {{ isset($entype)&&$entype->formation_documents=="Articles of Association"? 'selected' : ''}}>Articles of Association</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="notary" class="input-item-label">{{__('Notary Requirement for Formation')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="notary" id="notary" data-dd-class="search-on">
                                                <option default value="">-- Select --</option>
                                                <option value="Y" {{ isset($entype)&&$entype->formation_notary_req=="Y"? 'selected' : ''}}>Yes</option>
                                                <option value="N" {{ isset($entype)&&$entype->formation_notary_req=="N"? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="principal_statue" class="input-item-label">{{__('Participant Type')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="principal_statue" id="principal_statue" data-dd-class="search-on">
                                                <option default value="">-- Select --</option>
                                                <option value="sharefolders" {{ isset($entype)&&$entype->principal_statute=="sharefolders"? 'selected' : ''}}>Shareholders</option>
                                                <option value="members" {{ isset($entype)&&$entype->principal_statute=="members"? 'selected' : ''}}>Members</option>
                                                <option value="partners" {{ isset($entype)&&$entype->principal_statute=="partners"? 'selected' : ''}}>Partners</option>
                                                <option value="benificiaries" {{ isset($entype)&&$entype->principal_statute=="benificiaries"? 'selected' : ''}}>Beneficiaries</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="registername" class="input-item-label">{{__('Registrar Name (written with "-rar")')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder='Registrar Name (written with "-rar")' type="text" id="registername" name="registername"
                                                value="{{ isset($entype)?$entype->register_native_name : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="entypeId" value="{{isset($entype)? $entype->id:''}}">
                    <div class="form-step form-final">
                        <div class="form-step-fields card-innr">
                            <button class="btn btn-primary">{{ isset($entype)? "Save": "Next Step" }} </button>
                        </div>
                    </div>
                    <div class="gaps-1x"></div>
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
