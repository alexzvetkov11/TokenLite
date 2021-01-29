@extends('layouts.admin')
@section('title', __('Statutory Framework'))
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
                    <h5 >Entity Type > {{ $obj->entity_type. '('.$obj->jurisdiction.') > Statutory Framework' }}</h5>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('admin.entity') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>

                {{-- <input type="hidden" id="file_uploads" value="{{ route('ajax.kyc.file.upload') }}" /> --}}
                <form class="<!--validate-modern-->" method="POST" id="<!--kyc_submit-->">
                    @csrf
                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{__('Languages')}}</h4>
                                    <p>{{__('Choose the language in which the Statues should be available.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label class="input-item-label">Add Language: </label>
                                        <div class="input-wrap">
                                            <select  name="entitydetail_lang" class="select select-block select-bordered" value="" data-placeholder="Select Options" multiple="multiple">
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
                                        <span class="input-note">Choose one or multiple language.</span>
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
                                    <h4>{{__('Framework')}}</h4>
                                    <p>{{__('Develop the framework of Statute Types, Articles and sections for the Statutes.')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="principal1"  class="input-item-label">{{__('Principal Statute')}}</label>
                                        <div class="input-wrap">
                                            <input type="text" class="input-bordered" id="principal1" name="principal1" placeholder="Principal Statute">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="currency1" class="input-item-label">{{__('Standard Currency')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="currency1" id="currency1" data-dd-class="search-on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        function CheckSpace(event) {
            console.log(event.which);
            if (event.which === 32) {
                event.preventDefault();
                return false;
            }
        }
    </script>
@endsection

@section('modals')

<div class="modal fade" id="addArticle" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="popup-body popup-body-md">
                <h3 class="popup-title">Add Article</h3>
                <form action="" method="POST" class="adduser-form validate-modern" id="addUserForm" autocomplete="false">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-item input-with-label">
                                <label class="input-item-label">Article</label>
                                <select name="article" class="select select-bordered select-block" required="required">
                                    <option default value="">Statute Type</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-item input-with-label">
                        <label class="input-item-label">Text</label>
                        <div class="input-wrap">
                            <input name="text" class="input-bordered" required="required" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="gaps-1x"></div>
                    <button class="btn btn-md btn-primary" type="submit">Add Article</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addSection" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="popup-body popup-body-md">
                <h3 class="popup-title">Add Section</h3>
                <form action="" method="POST" class="adduser-form validate-modern" id="addUserForm" autocomplete="false">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-item input-with-label">
                                <label class="input-item-label">Section</label>
                                <select name="article" class="select select-bordered select-block" required="required">
                                    <option default value="">Statute Type</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-item input-with-label">
                        <label class="input-item-label">Text</label>
                        <div class="input-wrap">
                            <input name="text" class="input-bordered" required="required" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="gaps-1x"></div>
                    <button class="btn btn-md btn-primary" type="submit">Add Section</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addStatute" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="popup-body popup-body-md">
                <h3 class="popup-title">Add Statute Type</h3>
                <form action="" method="POST" class="adduser-form validate-modern" id="addUserForm" autocomplete="false">
                    @csrf
                    
                    <div class="input-item input-with-label">
                        <label class="input-item-label">Statute Type </label>
                        <div class="input-wrap">
                            <input name="text" class="input-bordered" required="required" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="gaps-1x"></div>
                    <button class="btn btn-md btn-primary" type="submit">Add Statute Type</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStatute" tabindex="-1">
    <div class="modal-dialog modal-dialog-md modal-dialog-centered">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
            <div class="popup-body popup-body-md">
                <h3 class="popup-title">Edit Statute Type</h3>
                <form action="" method="POST" class="adduser-form validate-modern" id="addUserForm" autocomplete="false">
                    @csrf
                    
                    <div class="input-item input-with-label">
                        <label class="input-item-label">Statute Type </label>
                        <div class="input-wrap">
                            <input name="text" class="input-bordered" required="required" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="gaps-1x"></div>
                    <button class="btn btn-md btn-primary" type="submit">Add Statute Type</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection