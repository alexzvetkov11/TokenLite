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
                <form class="<!--validate-modern-->" action="{{ route('admin.ajax.entype.addfirst') }}" method="POST" id="<!--kyc_submit-->">
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
                                            <input required type="text" class="input-bordered" id="entityname" name="entityname" placeholder="Full Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="longabbreviation" class="input-item-label">{{__('Entity Type: Long Abbreviation')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder="Long Abbreviation" type="text" id="longabbreviation" name="longabb">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}



                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="shortabbreviation" class="input-item-label">{{__('Entity Type: Short Abbreviation')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder="Short Abbreviation" type="text" id="shortabbreviation" name="shortabb">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="abbformat" class="input-item-label">{{__('Abbreviation Position')}}</label>
                                        <div class="input-wrap">
                                            {{--  <input class="input-bordered" type="text" name="abbformat" id="format" placeholder="Set Format">  --}}
                                            <select class="select-bordered select-block" name="abbformat" id="abbformat" data-dd-class="search-on">
                                                <option value="" default >-- Select --</option>
                                                <option value="before">"Behind" =></option>
                                                <option value="after">"Before" =<</option>
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                            </div>{{-- .row --}}
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
                                        <label for="LegalStructure" class="input-item-label">{{__('Legal Structure')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="LegalStructure" id="LegalStructure"  data-dd-class="search-on">
                                                <option default value="">-- Select --</option>
                                                @foreach($legals as $legal)
                                                <option value="{{ $legal->id}}">{{$legal->label}}</option>
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
                                                <option value="{{ $jur->id }}"> {{ $jur->jurisdiction_name }}</option>
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
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="formationDocuments" class="input-item-label">{{__('Formation Documents')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="formationDocuments" id="formationDocuments"  data-dd-class="search-on" multiple="multiple" data-placeholder="-- Select --">
                                                <option value="Memorandum of Association">Memorandum of Association</option>
                                                <option value="Articles of Association">Articles of Association</option>
                                                <option value="Partnership Agreement">Partnership Agreement</option>
                                                <option value="Operating Agreement">Operating Agreement</option>
                                                <option value="Articles of Organization">Articles of Organization</option>
                                                <option value="Articles of Association">Articles of Association</option>

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
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="participant-type" class="input-item-label">{{__('Participant Type')}}</label>
                                        <div class="input-wrap">
                                            <select onchange="onChange()" class="select-bordered select-block" name="participant_type" id="participant-type" data-dd-class="search-on">
                                                <option default value="">-- Select --</option>
                                                <option value="sharefolders">Shareholders</option>
                                                <option value="members">Members</option>
                                                <option value="partners">Partners</option>
                                                <option value="benificiaries">Beneficiaries</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="minimum" class="input-item-label">{{__('Registrar Name (written with "-rar")')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder='Registrar Name (written with "-rar")' type="text" id="minimum" name="minimum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="shar">
                    <div class="form-step form-step1">
                        <div class="form-step-fields card-innr">
                            <button class="btn btn-primary"> Next Step</button>
                        </div>
                    </div>
                    <div class="gaps-1x"></div>
                </form>
            </div>


        </div>
    </div>
    <script type="text/javascript">
        onChange();

        function CheckSpace(event) {
            console.log(event.which);
            if (event.which === 32) {
                event.preventDefault();
                return false;
            }
        }

        function onChange(){
            var x = document.getElementById("participant-type").value;
            var y =  document.querySelectorAll('div[name="share"]');
            console.log(x)
            if ( x.length > 0 ){
                if (x=="benificiaries" ){
                    document.getElementsByName("type").value= "beni";
                    for ( var i=0; i<y.length; i++)
                        y[i].style.display='none';
                } else {
                    document.getElementsByName("type").value= "shar";
                    for ( var i=0; i<y.length; i++)
                        y[i].style.display='block';
                }
                    
            }

        }

    </script>
@endsection
