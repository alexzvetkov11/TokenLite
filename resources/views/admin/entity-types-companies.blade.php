@extends('layouts.admin')
@section('title', __('Add Entity Type'))
    @php
    $has_sidebar = false;
    @endphp

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            @include('layouts.messages')

            <div class="<!--kyc-form-steps--> card mx-lg-4">
                <div class="card-head has-aside pd-2x">
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entity Types ></b> <span style="font-size:0.8em">Add Entity Type</span></div>
                    {{-- <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entity') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div> --}}
                </div>

                {{-- <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" /> --}}
                <form  method="POST" action="{{isset($companies)? route('admin.ajax.entype.editCompanies') :route('admin.ajax.entype.addcompanies')}}">
                    @csrf
                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{__('Members')}}</h4>
                                    <p>{{__('Fill in the Member characteristics of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>{{-- .step-head --}}
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="minmember"  class="input-item-label">{{__('Minimum Number of Members')}}</label>
                                        <div class="input-wrap">
                                            <input required type="number" class="input-bordered" id="minmember" name="minmember" placeholder="Numbers"
                                            value="{{ isset($companies)? $companies->members_min : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="maxmember"  class="input-item-label">{{__('Maximum Number of Members')}}</label>
                                        <div class="input-wrap">
                                            <input required type="number" class="input-bordered" id="maxmember" name="maxmember" placeholder="Numbers"
                                            value="{{ isset($companies)? $companies->members_max : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label class="input-item-label">Share Transferability</label>
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-2">Private</span>
                                            <input class="input-switch" name="sharetransfer" type="checkbox" id="sharetransfer"
                                             {{ isset($companies)&&$companies->share_transferability=='Private' ? 'checked' : '' }}>
                                            <label for="sharetransfer">Public</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-step form-step2">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">02</div>
                                <div class="step-head-text">
                                    <h4>{{__('Share Capital')}}</h4>
                                    <p>{{__('Fill in the Share Capital requirements of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="input-item input-with-label">
                                        <label for="minissuedcaptial"  class="input-item-label">{{__('Minimum Issued Share Capital')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered comma" id="minissuedcaptial" name="minissuedcaptial" placeholder="Amount" 
                                            value="{{ isset($companies)? $companies->share_cap_issued_min : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="minpaidcaptial" class="input-item-label ">{{__('Minimum Paid-Up Share Capital')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered comma" id="minpaidcaptial" name="minpaidcaptial" placeholder="Amount"
                                            value="{{ isset($companies)? $companies->share_cap_paid_up_min : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="minpaidauth" class="input-item-label">{{__('Minimum Paid-Up Capital Relative to Authorized Capital')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered percent" id="minpaidauth" name="minpaidauth" placeholder='Percentage format: either "20%" or 0.2'
                                            value="{{ isset($companies)? $companies->share_cap_authorized_paid_up_min_rel : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="input-item input-with-label">
                                        <label for="minshareissued" class="input-item-label">{{__('Minimum Shares Issued')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="minshareissued" name="minshareissued" placeholder='Number'
                                            value="{{ isset($companies)? $companies->shares_issued_min : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="maxshareissued" class="input-item-label">{{__('Maximum Shares Issued')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="maxshareissued" name="maxshareissued" placeholder='Number'
                                            value="{{ isset($companies)? $companies->shares_issued_max : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Shares Without Dividend Rights Permitted </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="withoutDR" type="checkbox" id="withoutDR"
                                            {{ isset($companies)&&$companies->shares_without_dividend_rights=='Y' ? 'checked' : '' }}>
                                            <label for="withoutDR">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Shares Without Voting Rights Permitted </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="withoutVR" type="checkbox" id="withoutVR"
                                            {{ isset($companies)&&$companies->shares_without_voting_rights=='Y' ? 'checked' : '' }}>
                                            <label for="withoutVR">No</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Bearer Shares Permitted </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="BSP" type="checkbox" id="BSP"
                                            {{ isset($companies)&&$companies->bearer_shares_permitted=='Y' ? 'checked' : '' }}>
                                            <label for="BSP">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Fractional Shares Permitted </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="FSP" type="checkbox" id="FSP"
                                            {{ isset($companies)&&$companies->fractional_shares_permitted=='Y' ? 'checked' : '' }}>
                                            <label for="FSP">No</label>
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
                                    <h4>{{__('Directors & Officers')}}</h4>
                                    <p>{{__('Fill in the Directors & Officers requirements of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="input-item input-with-label">
                                        <label for="minNumberDirectors"  class="input-item-label">{{__('Minimum Number of Directors')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="minNumberDirectors" name="minNumberDirectors" placeholder="Decimal" step="0.01"
                                            value="{{ isset($companies)? $companies->directors_min : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="maxNumberDirectors" class="input-item-label">{{__('Maximum Number of Directors')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="maxNumberDirectors" name="maxNumberDirectors" placeholder="Decimal" step="0.01"
                                            value="{{ isset($companies)? $companies->directors_max : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Local Director Requirement</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="localDR" type="checkbox" id="localDR"
                                            {{ isset($companies)&&$companies->local_dir_req=='Y' ? 'checked' : '' }}>
                                            <label for="localDR">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">Local Officer Requirement (example: Secretary)</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="localOR" type="checkbox" id="localOR"
                                            {{ isset($companies)&&$companies->local_officer_req=='Y' ? 'checked' : '' }}>
                                            <label for="localOR">No</label>
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
                                    <h4>{{__('Domiciliation & Office')}}</h4>
                                    <p>{{__('Fill in the Domiciliation & Office requirements of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Local Registered Office Requirement </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="localROR" type="checkbox" id="localROR"
                                            {{ isset($companies)&&$companies->local_reg_office_req=='Y' ? 'checked' : '' }}>
                                            <label for="localROR">No</label>
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
                                    <h4>{{__('Annual Accounts')}}</h4>
                                    <p>{{__('Fill in the Annual Accounts requirements of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" name="share">
                                    <div class="pt-2"> Annual Accounts Approval by Members</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="annualAAM" type="checkbox" id="annualAAM"
                                            {{ isset($companies)&&$companies->members_annual_meeting_req=='Y' ? 'checked' : '' }}>
                                            <label for="annualAAM">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="input-item input-with-label">
                                        <label for="initailAD"  class="input-item-label">{{__('Initial Approval Deadline (Days Following Closing of FY)')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="initailAD" name="initailAD" placeholder="Number"
                                            value="{{ isset($companies)? $companies->member_annual_accounts_approval_deadline_days : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="AdjustedAD" class="input-item-label">{{__('Adjusted Approval Deadline (Days Following Closing FY)')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="AdjustedAD" name="AdjustedAD" placeholder="Number"
                                            value="{{ isset($companies)? $companies->member_annual_accounts_approval_deadline_adjusted_days : '' }}">
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
                                    <h4>{{__('Registrar Filiing Requirements')}}</h4>
                                    <p>{{__('Fill in the Filing requirements requirements of the new Entity Type.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">Members Register</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="memberRegister" type="checkbox" id="memberRegister"
                                            {{ isset($companies)&&$companies->filing_members_req=='Y' ? 'checked' : '' }}>
                                            <label for="memberRegister">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">Directors Register</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="directorRegister" type="checkbox" id="directorRegister"
                                            {{ isset($companies)&&$companies->filing_directors_req=='Y' ? 'checked' : '' }}>
                                            <label for="directorRegister">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">Officer Register</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="officerRegister" type="checkbox" id="officerRegister"
                                            {{ isset($companies)&&$companies->filing_officers_req=='Y' ? 'checked' : '' }}>
                                            <label for="officerRegister">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">Paid-Up Capital Declaration</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="paidUCD" type="checkbox" id="paidUCD"
                                            {{ isset($companies)&&$companies->filing_paid_up_capital_declaration=='Y' ? 'checked' : '' }}>
                                            <label for="paidUCD">No</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">Annual Accounts Filling Requirements</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="annualAFR" type="checkbox" id="annualAFR"
                                            {{ isset($companies)&&$companies->filing_annual_accounts_req=='Y' ? 'checked' : '' }}>
                                            <label for="annualAFR">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="pt-2">UBO Register</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="UBORegister" type="checkbox" id="UBORegister"
                                            {{ isset($companies)&&$companies->filing_ubo_req=='Y' ? 'checked' : '' }}>
                                            <label for="UBORegister">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="annualAFD" class="input-item-label">{{__('Annual Accounts Filling Deadline (Days Following Closing)')}}</label>
                                        <div class="input-wrap">
                                            <input type="number" class="input-bordered" id="annualAFD" name="annualAFD" placeholder="Number"
                                            value="{{ isset($companies)? $companies->filing_annual_accounts_deadline_days : '' }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6" >
                                    <div class="input-item input-with-label">
                                        <label for="UBOCapital"  class="input-item-label">{{__('UBO Threshold Capital Rights')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered percent" id="UBOCapital" name="UBOCapital" placeholder='Percentage format: "25%" or "0.25"'
                                            value="{{ isset($companies)? $companies->UBO_threshold_capital_rights : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" name="share">
                                    <div class="input-item input-with-label">
                                        <label for="UBOVoting" class="input-item-label">{{__('UBO Threshold Voting Rights')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered percent" id="UBOVoting" name="UBOVoting" placeholder='Percentage format: "25%" or "0.25"'
                                            value="{{ isset($companies)? $companies->UBO_threshold_voting_interest : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="entypeId" value="{{$entype->id}}">
                    <input type="hidden" name="companyId" value="{{ isset($companies) ? $companies->id : ''}}">

                    <div class="form-step form-final">
                        <div class="form-step-fields card-innr">
                            <button class="btn btn-primary">Save</button>
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
