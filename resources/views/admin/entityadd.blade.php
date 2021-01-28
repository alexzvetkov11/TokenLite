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
                <form class="<!--validate-modern-->" action="{{ route('admin.ajax.entities.add') }}" method="POST" id="<!--kyc_submit-->">
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
                                        <label for="jurisdiction"  class="input-item-label">{{__('Jurisdiction')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="jurisdiction" id="jurisdiction"  data-dd-class="search-on">
                                                @foreach( $juris as $jur)
                                                <option value="{{ $jur->id }}"> {{ $jur->jurisdiction_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="participant-type" class="input-item-label">{{__('Participant Type')}}</label>
                                        <div class="input-wrap">
                                            <select onchange="onChange()" class="select-bordered select-block" name="participant_type" id="participant-type" data-dd-class="search-on">
                                                <option default value="sharefolders">Shareholders</option>
                                                <option value="members">Members</option>
                                                <option value="partners">Partners</option>
                                                <option value="benificiaries">Beneficiaries</option>
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="entityname" class="input-item-label">{{__('Entity Type: Full Name')}}</label>
                                        <div class="input-wrap">
                                            <input required type="text" class="input-bordered" id="entityname" name="entityname" placeholder="Full Name">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

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
                                                <option value="before">Behind</option>
                                                <option default value="after">Before</option>
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
                                    <h4>{{__('Statutory Details')}}</h4>
                                    <p>{{__('Fill in the legal details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="input-item input-with-label">
                                        <label for="principal"  class="input-item-label">{{__('Principal Statute')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered" id="principal" name="principal" placeholder="Principal Statute">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="register" class="input-item-label">{{__('Commercial Register')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered" id="register" name="register" placeholder="Commercial Register">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="language" class="input-item-label">{{__('Standard Language')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="language" id="language"  data-dd-class="search-on">
                                                <option default value="English">{{__('English')}}</option>
                                                <option value="Arab">{{__('Arab')}}</option>
                                                <option value="Chinese">{{__('Chinese')}}</option>
                                                <option value="Dutch">{{__('Dutch')}}</option>
                                                <option value="French">{{__('French')}}</option>
                                                <option value="German">{{__('German')}}</option>
                                                <option value="Hindi">{{__('Hindi')}}</option>
                                                <option value="Japanese">{{__('Japanese')}}</option>
                                                <option value="Korean">{{__('Korean')}}</option>
                                                <option value="Portuguese">{{__('Portuguese')}}</option>
                                                <option value="Russian">{{__('Russian')}}</option>
                                                <option value="Spanish">{{__('Spanish')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="currency" class="input-item-label">{{__('Standard Currency')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="currency" id="currency" data-dd-class="search-on">
                                                <option default value="USD">United States Dollar (USD)</option>
                                                <option value="GBP">British Pound (GBP)</option>
                                                <option value="EUR">Euro (EUR)</option>
                                                <option value="CHF">Swiss Franc (CHF)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="requirement" class="input-item-label">{{__('Local Director/Secretary Requirement')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="requirement" id="requirement"  data-dd-class="search-on">
                                                <option default value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="transferability" class="input-item-label">{{__('Share Transferability')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="transferability" id="transferability" data-dd-class="search-on">
                                                <option default value="Private">Private</option>
                                                <option value="Public">Public</option>
                                                <option value="Statutes">As per Statutes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="minimum" class="input-item-label">{{__('Minimum Share Capital')}}  </label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" placeholder="Minimum Share Capital" type="text" id="minimum" name="minimum">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="maximum" class="input-item-label">{{__('Maximum Number of Shareholders')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="maximum" id="maximum" placeholder="Maximum Number of Shareholders">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="type" value="shar">
                    {{-- <div class="form-step form-step1" id="benificiaries">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{__('Statutory Details')}}</h4>
                                    <p>{{__('Fill in the legal details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="principal1"  class="input-item-label">{{__('Principal Statute')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered" id="principal1" name="principal" placeholder="Principal Statute">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="currency1" class="input-item-label">{{__('Standard Currency')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="currency" id="currency" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-step form-step1">
                        <div class="form-step-fields card-innr">
                            <button class="btn btn-primary"> Add Entity Type</button>
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
