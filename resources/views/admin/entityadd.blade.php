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
                <div class="card-head has-aside pd-2x">
                    <h4 class="card-title">Entities > Add Entity</h4>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entity') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>

                <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" />
                <form class="<!--validate-modern-->" action="{{ route('user.ajax.kyc.submit') }}" method="POST" id="<!--kyc_submit-->">
                    @csrf

                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{__('Basic Details')}}</h4>
                                    <p>{{__('Fill in the basic details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="jurisdiction"  class="input-item-label">{{__('Jurisdiction')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="jurisdiction" id="jurisdiction"  data-dd-class="search-on">
                                                <option default value="">Select Country</option>
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="participant-type" class="input-item-label">{{__('Participant Type')}}</label>
                                        <div class="input-wrap">
                                            <select onchange="onChange()" class="select-bordered select-block" name="participant_type" id="participant-type" data-dd-class="search-on">
                                                <option default >Participant Type</option>
                                                <option value="sharefolders">SHAREHOLDERS</option>
                                                <option value="members">MEMBERS</option>
                                                <option value="partners">PARTNERS</option>
                                                <option value="benificiaries">BENEFICIARIES</option>
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="entityname" class="input-item-label">{{__('Entity Type: Full Name')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered" id="entityname" name="entityname" placeholder="Full Name">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                    
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="longabbreviation" class="input-item-label">{{__('Entity Type: Long Abbreviation')}}  </label>
                                        <div class="input-wrap">
                                            <input required class="input-bordered" placeholder="Long Abbreviation" type="text" id="longabbreviation" name="longabbreviation">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                
                   
                          
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="shortabbreviation" class="input-item-label">{{__('Entity Type: Short Abbreviation')}}  </label>
                                        <div class="input-wrap">
                                            <input required class="input-bordered" placeholder="Short Abbreviation" type="text" id="shortabbreviation" name="shortabbreviation">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="format" class="input-item-label">{{__('Abbreviation Format')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="format" id="format" placeholder="Set Format">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                
                            </div>{{-- .row --}}
                        </div>{{-- .step-fields --}}
                    </div>

                    <div class="form-step form-step1" id="sharefolders">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{__('Statutory Details')}}</h4>
                                    <p>{{__('Fill in the legal details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="principal1"  class="input-item-label">{{__('Principal Statute')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" required class="input-bordered" id="principal1" name="principal1" placeholder="Principal Statute">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="governing1" class="input-item-label">{{__('Governing Body')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" required class="input-bordered" id="governing1" name="governing1" placeholder="Governing Body">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="language1" class="input-item-label">{{__('Standard Language')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="language1" id="language1"  data-dd-class="search-on">
                                                <option value="">{{__('Select Language')}}</option>
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                    
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="currency1" class="input-item-label">{{__('Standard Currency')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="currency1" id="currency1" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                   
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="requirement1" class="input-item-label">{{__('Local Director/Secretary Requirement')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="requirement1" id="requirement1"  data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                    
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="transferability1" class="input-item-label">{{__('Share Transferability')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="transferability1" id="transferability1" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="minimum1" class="input-item-label">{{__('Minimum Share Capital')}}  </label>
                                        <div class="input-wrap">
                                            <input required class="input-bordered" placeholder="Minimum Share Capital" type="text" id="minimum1" name="minimum1">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="maximum" class="input-item-label">{{__('Maximum Number of Shareholders')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="maximum" id="maximum" placeholder="Maximum Number of Shareholders">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                
                            </div>{{-- .row --}}
                        </div>{{-- .step-fields --}}
                    </div>

                    <div class="form-step form-step1" id="members">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">03</div>
                                <div class="step-head-text">
                                    <h4>{{__('Statutory Details')}}</h4>
                                    <p>{{__('Fill in the legal details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="principal1"  class="input-item-label">{{__('Principal Statute')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" required class="input-bordered" id="principal1" name="principal1" placeholder="Principal Statute">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="governing1" class="input-item-label">{{__('Governing Body')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" required class="input-bordered" id="governing1" name="governing1" placeholder="Governing Body">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="language1" class="input-item-label">{{__('Standard Language')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="language1" id="language1"  data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                    
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="currency1" class="input-item-label">{{__('Standard Currency')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="currency1" id="currency1" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                   
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="requirement1" class="input-item-label">{{__('Local Director/Secretary Requirement')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="requirement1" id="requirement1"  data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                    
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="transferability1" class="input-item-label">{{__('Share Transferability')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="transferability1" id="transferability1" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="minimum1" class="input-item-label">{{__('Minimum Share Capital')}}  </label>
                                        <div class="input-wrap">
                                            <input required class="input-bordered" placeholder="Minimum Share Capital" type="text" id="minimum1" name="minimum1">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                                
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="maximum" class="input-item-label">{{__('Maximum Number of Shareholders')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="maximum" id="maximum" placeholder="Maximum Number of Shareholders">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                
                            </div>{{-- .row --}}
                        </div>{{-- .step-fields --}}
                    </div>
                    <div class="form-step form-step1" id="benificiaries">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">04</div>
                                <div class="step-head-text">
                                    <h4>{{__('Statutory Details')}}</h4>
                                    <p>{{__('Fill in the legal details of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="principal1"  class="input-item-label">{{__('Principal Statute')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" required class="input-bordered" id="principal1" name="principal1" placeholder="Principal Statute">
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                               
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="currency1" class="input-item-label">{{__('Standard Currency')}}</label>
                                        <div class="input-wrap">
                                            <select required class="select-bordered select-block" name="currency1" id="currency1" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>{{-- .input-item --}}
                                </div>{{-- .col --}}
                            </div>{{-- .row --}}
                        </div>{{-- .step-fields --}}
                    </div>

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
            console.log(x);
            document.getElementById("sharefolders").style.display="none";
            document.getElementById("members").style.display="none";
            document.getElementById("benificiaries").style.display="none";
            if ( x.length > 0 ){
                if ( x=="partners")
                    document.getElementById("members").style.display="block";
                else document.getElementById(x).style.display="block";
            }
                
        }
    </script>
@endsection
