@extends('layouts.user')
@section('title', __('Add Entity Type'))
    @php
    $has_sidebar = false;
    @endphp

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-11">
            @include('layouts.messages')
            <div class="card mx-lg-4">
                <div class="card-head has-aside pd-2x">
                    {{-- <div style="font-size:1.29em; color:#342d6e"> <b>Entities > <!--{{ $entities->entity_name }}--> ></b> <span style="font-size:0.8em"> Complete Formation/Onboarding</span></div> --}}
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entities > {{ $entities->entity_name }} ></b> <span style="font-size:0.8em"> Complete Formation/Onboarding</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('user.entities') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>
                <form action="{{ route('user.entities.add.domiciliation') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="entity_id" value="{{ $entities->id }}" />

                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{__('Domiciliation & Office')}}</h4>
                                    <p>{{__('[text]')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <p>{{ __('Current Office Situation') }}</p>
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="pt-2">{{ __('This Entity wishes to obtain physical office space in this Jurisdiction which it currently does not have yet.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="registered_office" type="checkbox" id="registered_office">
                                            <label for="registered_office">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 physical" >
                                    <div class="pt-2">{{ __('This Entity will then register itself at the physical office space that it wishes to obtain.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6 physical">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="register_new" type="checkbox" id="register_new">
                                            <label for="register_new">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 register" >
                                    <div class="pt-2">{{ __('This Entity already has an address at which it can register and which complies with the requirements set for a Registered Address.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6 register">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="obtain_new" type="checkbox" id="obtain_new">
                                            <label for="obtain_new">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <p class="office_selection">{{ __('Registered Office Selection') }}</p>
                            <div class="row office_selection">
                                <ul class="document-list guttar-vr-10px">
                                    <div class="col-md-6">
                                        <li class="document-item">
                                            <div class="input-wrap">
                                                <input class="document-type" type="radio" name="regiOffice" value="mail" id="full_functionality" data-title="Passport" checked>
                                                <label for="full_functionality"><span>{{ __('Registered Office Address + Mail Forwarding Amsterdam €95 / month') }}</span></label>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-md-6">
                                        <li class="document-item">
                                            <div class="input-wrap">
                                                <input class="document-type" type="radio" name="regiOffice" id="listing_only" value="different" data-title="National ID Card">
                                                <label for="listing_only"><span>{{ __('This Entity will obtain a different Registered Address for itself at a later stage.') }}</span></label>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                            <hr class="office_selection" />

                            <p class="address">{{ __('Registered Address') }}</p>
                            <div class="row address">
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="regiCountry" class="input-item-label">{{__('Country')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" value="{{ $entities->check_juris->jurisdiction_name }}" disabled>>
                                            <input name="regiCountry" type="hidden" value="{{ $entities->check_juris->jurisdiction_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="regiProvince" class="input-item-label">{{__('Municipality, Province')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="regiProvince" id="regiProvince" data-dd-class="search-on">
                                                <option value="" >{{ __('Select Options') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="regiTown" class="input-item-label">{{__('City / Town / Village')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" name="regiTown" id="regiTown" type="text" placeholder="Input text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label class="input-item-label">{{__('Postal / Zip Code')}}</label>
                                        <div class="input-wrap">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <input class="input-bordered" name="regiPostal" type="text" placeholder="Input text" value="">
                                                </div>
                                                <div class="col-md-5">
                                                    <input class="input-bordered" name="regiZip" type="text" placeholder="Input text" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="regiStreet" class="input-item-label">{{__('Street')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" name="regiStreet" type="text" placeholder="Input text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-item input-with-label">
                                        <label for="regiNumber" class="input-item-label">{{__('Number')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" name="regiNumber" type="text" placeholder="Input text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-item input-with-label">
                                        <label for="regiUnit" class="input-item-label">{{__('Unit')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" name="regiUnit" type="text" placeholder="Input text" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="pt-2">{{ __('This is a Residential Address.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="residental1" type="checkbox" id="residental1">
                                            <label for="residental1">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="pt-2">{{ __('The Registered Address is also the preferred Correspondence Address.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="residental2" type="checkbox" id="residental2">
                                            <label for="residental2">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="pt-2">{{ __('The Registered Address is also the address of the physical Local Head Office of this Entity.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="residental3" type="checkbox" id="residental3">
                                            <label for="residental3">No</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="address" />

                            <p>{{ __('Electronic Correspondence') }}</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="trading_name" class="input-item-label">{{__('Phone Number')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="phone" placeholder="Input text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="trading_name" class="input-item-label">{{__('Email Address')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="email" placeholder="Input text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="trading_name" class="input-item-label">{{__('Website')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="website" placeholder="Input text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <p>{{ __('Local Head Office') }}</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="trading_name" class="input-item-label">{{__('Country')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" value="{{ $entities->check_juris->jurisdiction_name }}" disabled>
                                            <input name="localCountry" type="hidden" value="{{ $entities->check_juris->jurisdiction_name }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Municipality, Province')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="localProvince" id="localProvince" data-dd-class="search-on">
                                                <option value="" >{{ __('Select Options') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('City / Town / Village')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="localCity" placeholder="Input text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Postal / Zip Code')}}</label>
                                        <div class="input-wrap">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <input class="input-bordered" type="text" name="localPostal" placeholder="Input text" >
                                                </div>
                                                <div class="col-md-5">
                                                    <input class="input-bordered" type="text" name="localZip" placeholder="Input text" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Street')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="localStreet" placeholder="Input text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Number')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="localNumber" placeholder="Input text" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Unit')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="localUnit" placeholder="Input text" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="pt-2">{{ __('This is a Residential Address.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="local1" type="checkbox" id="local1">
                                            <label for="local1">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 local2">
                                    <div class="pt-2">{{ __('The Local Head Office address is also the preferred Correspondence Address.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6 local2">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="local2" type="checkbox" id="local2">
                                            <label for="local2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <p>{{ __('Branches') }}</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
                                        <p> {{ __('This Entity will, in addition to its Local Head Office, have one or more branches in this Jurisdiction.') }}</p>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-auto btn-md" data-toggle="modal" data-target="#addBranches"> {{ __('Add Branch') }}</a>
                                        </div>
                                    </div>
                                    <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user ">{{ __('Branch Name') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Province') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Municipality') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('City / Town / Village') }}</th>
                                                <th class="data-col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($addresses as $key => $address)
                                                <tr class="data-item ">
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $branches[$key]->branch_name }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $address->state_province }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{" "  }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{  " "}}</span>
                                                    </td>
                                                    <td class="data-col text-right" style="width:70px">
                                                        <div class="relative d-inline-block">
                                                            <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                                <em class="ti ti-more-alt"></em></a>
                                                            <div class="toggle-class dropdown-content dropdown-content-top-left">
                                                                    <ul class="dropdown-list more-menu-{{ $address->id }}">
                                                                    <li>
                                                                        <a href="#" data-toggle="modal" data-target="#editJurisdiction" data-id="{{  $address->id  }}" class="user-action front editJurisdiction">
                                                                            <em class="fas fa-edit"></em>Edit
                                                                        </a>
                                                                        <a href="#" data-uid="{{ $address->id }}" data-type="delete_user___"
                                                                            {{-- data-url="{{ route('admin.ajax.juris.delete', $office->id) }}" --}}
                                                                            class="user-action front" data-title="Are you sure you want to delete this Jurisdiction?">
                                                                            <em class="fas fa-trash-alt"></em>Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="gaps-1x"></div>
                                </div>
                            </div>
                            <hr/>

                            <p class="correspondence">{{ __('Correspondence Address') }}</p>
                            <div class="row correspondence">
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="corCountry" class="input-item-label">{{__('Country')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" value="{{ $entities->check_juris->jurisdiction_name }}" disabled>
                                            <input type="hidden" name="corCountry" value="{{ $entities->check_juris->jurisdiction_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="corProvince" class="input-item-label">{{__('State / Province / Region')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="corProvince" id="corProvince" data-dd-class="search-on">
                                                <option value="" >{{ __('Select Options') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="corCity" class="input-item-label">{{__('City / Town / Village')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="corCity" placeholder="Input text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="corPostal" class="input-item-label">{{__('Postal / Zip Code')}}</label>
                                        <div class="input-wrap">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <input class="input-bordered" type="text" placeholder="Input text" name="corPostal">
                                                </div>
                                                <div class="col-md-5">
                                                    <input class="input-bordered" type="text" placeholder="Input text" name="corZip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-item input-with-label">
                                        <label for="corStreet" class="input-item-label">{{__('Street')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" name="corStreet" placeholder="Input text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-item input-with-label">
                                        <label for="corNumber" class="input-item-label">{{__('Building Number')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" placeholder="Input text" name="corNumber">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-item input-with-label">
                                        <label for="corUnit" class="input-item-label">{{__('Unit')}}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered" type="text" placeholder="Input text" name="corUnit">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" name="share">
                                    <div class="pt-2">{{ __('This is a Residential Address.') }}</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="corResidential" type="checkbox" id="corResidential">
                                            <label for="corResidential">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="gaps-2x"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
                                        <a href="javascript:void(0)" class="btn btn-primary">{{ __('Previous Step') }}</a>
                                        <button class="btn btn-primary" type="submit" >{{ __('Next Step') }}</button>
                                        {{-- <button class="btn btn-primary" type="submit"> {{ __('Next Step') }}</button> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="gaps-3x"></div>
                        </div>
                    </div>

                    <div class="form-step form-step-final"></div>
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
    <div class="modal fade" tabindex="-1" id="addBranches">
        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">{{ __('Add Branch') }}</h3>
                    <form method="POST" action="{{ route('user.ajax.entities.add.branches') }}" autocomplete="off" id="formid">
                        @csrf
                        <input type="hidden" name="entity_id" value="{{ $entities->id }}" />
                        <div class="form-step form-step1">
                            <div class="form-step-head card-innr">
                                <div class="step-head">
                                    <div class="step-number">01</div>
                                    <div class="step-head-text">
                                        <h4>{{__('Purpose & Activities')}}</h4>
                                        <p>{{__('[text]')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-step-fields card-innr">
                                <h5>{{ __('Branch Name') }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="branchName" class="input-item-label">{{__('Name')}}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" name="branchName" type="text" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5>{{ __('Branch Trading Names') }}</h5>
                                <div class="row">
                                    <div class="col-md-6" name="share">
                                        <div class="pt-2">{{ __('This Branche will use one or more (slightly) different Trading Names than the Entity itself.') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                                <input class="input-switch switch-toggle" data-switch="switch-to-trading" name="branch_trading" type="checkbox" id="branch_trading">
                                                <label for="branch_trading">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="switch-content switch-to-trading">
                                            <div class="input-item input-with-label">
                                                <label for="trading_name1" class="input-item-label">{{__('Names')}}</label>
                                                <div class="input-wrap">
                                                    <input id="trading_name1" type="text"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>

                                <h5>{{ __('Physical Address of Branch') }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="regiCountry" class="input-item-label">{{__('Country')}}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" value="{{ $entities->check_juris->jurisdiction_name }}" disabled>
                                                <input  name="phyCountry" type="hidden" value="{{ $entities->check_juris->jurisdiction_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="phyProvince" class="input-item-label">{{__('Municipality, Province')}}</label>
                                            <div class="input-wrap">
                                                <select class="select-bordered select-block" name="phyProvince" id="phyProvince" data-dd-class="search-on">
                                                    <option value="" >{{ __('Select Options') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="phyCity" class="input-item-label">{{__('City / Town / Village')}}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" name="phyCity" id="phyCity" type="text" placeholder="Input text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label class="input-item-label">{{__('Postal / Zip Code')}}</label>
                                            <div class="input-wrap">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input class="input-bordered" name="phyPostal" type="text" placeholder="Input text" >
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="input-bordered" name="phyZip" type="text" placeholder="Input text" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="purpose_type" class="input-item-label">{{__('Street')}}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" placeholder="Input text" name="phyStreet">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-item input-with-label">
                                            <label for="purpose_type" class="input-item-label">{{__('Number')}}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" placeholder="Input text" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-item input-with-label">
                                            <label for="purpose_type" class="input-item-label">{{__('Unit')}}</label>
                                            <div class="input-wrap">
                                                <input class="input-bordered" type="text" placeholder="Input text" name="phyUnit">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="pt-2">{{ __('This is a Residential Address.') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                                <input class="input-switch switch-toggle" data-switch="switch-to-resiAddress" name="resiAddress" type="checkbox" id="resiAddress">
                                                <label for="resiAddress">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pt-2">{{ __('This Address is also the Correspondence Address for this Branch.') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                                <input class="input-switch switch-toggle" data-switch="switch-to-corAddress" name="corAddress" type="checkbox" id="corAddress">
                                                <label for="corAddress">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>

                                <div class="switch-content switch-to-corAddress">
                                    <h5>{{ __('Correspondence Address of Branch') }}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="corCountry" class="input-item-label">{{__('Country')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" value="{{ $entities->check_juris->jurisdiction_name }}" disabled>
                                                    <input name="corCountry" type="hidden" value="{{ $entities->check_juris->jurisdiction_name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="corProvince" class="input-item-label">{{__('Municipality, Province')}}</label>
                                                <div class="input-wrap">
                                                    <select class="select-bordered select-block" name="corProvince" id="corProvince" data-dd-class="search-on">
                                                        <option value="" >{{ __('Select Options') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="corCity" class="input-item-label">{{__('City / Town / Village')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" name="corCity" id="corCity" type="text" placeholder="Input text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label class="input-item-label">{{__('Postal / Zip Code')}}</label>
                                                <div class="input-wrap">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input class="input-bordered" name="corPostal" type="text" placeholder="Input text">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="input-bordered" name="corZip" type="text" placeholder="Input text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="" class="input-item-label">{{__('Street')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" name="corStreet" placeholder="Input text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-item input-with-label">
                                                <label for="purpose_type" class="input-item-label">{{__('Number')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" name="corNumber" placeholder="Input text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-item input-with-label">
                                                <label for="purpose_type" class="input-item-label">{{__('Unit')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" placeholder="Input text" name="corUnit">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr/>
                                </div>

                                <h5>{{ __('Electronic Correspondence') }}</h5>
                                <div class="row">
                                    <div class="col-md-9" name="share">
                                        <div class="pt-2">{{ __('The Electronic Correspondence details for the Branch are the same as for the Local Head Office.') }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-item input-with-label">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                                <input class="input-switch switch-toggle" data-switch="switch-electronic" name="electronic" type="checkbox" id="electronic">
                                                <label for="electronic">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="switch-content switch-electronic">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-item input-with-label">
                                                <label for="trading_name" class="input-item-label">{{__('Phone Number')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" name="phone" placeholder="Input text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-with-label">
                                                <label for="trading_name" class="input-item-label">{{__('Email Address')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" name="email" placeholder="Input text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-with-label">
                                                <label for="trading_name" class="input-item-label">{{__('Website')}}</label>
                                                <div class="input-wrap">
                                                    <input class="input-bordered" type="text" name="website" placeholder="Input text" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>

                                <h5>{{ __('Activity Description') }}</h5>
                                <div class="row">
                                    <div class="col-md-9" name="share">
                                        <div class="pt-2">{{ __('The Electronic Correspondence details for the Branch are the same as for the Local Head Office.') }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-item input-with-label">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                                <input class="input-switch switch-toggle" data-switch="switch-activity" name="activity" type="checkbox" id="activity">
                                                <label for="activity">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="switch-content switch-activity">
                                            <div class="gaps-2x"></div>
                                            <div class="input-item  input-with-label text-area">
                                                <label for="description" class="input-item-label">{{ __('Describe here what products/services the new Company will offer, to who, and how. Use 8 words minimum.') }}</label>
                                                <div class="input-wrap"><grammarly-extension data-grammarly-shadow-root="true" style="position: absolute; top: 0px; left: 0px; pointer-events: none;" class="cGcvT"></grammarly-extension>
                                                    <textarea id="description" rows="5" name="description" class="input-bordered input-textarea" spellcheck="false"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5> {{ __('Customer & Offering Type') }}</h5>
                                        <p>{{ __('Will this Company have customers?') }}</p>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-radio input-radio-sm" type="radio" id='no_customer' name="customer" value="no" checked >
                                                <label for="no_customer">{{ __('No, it will have no customers.') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-radio input-radio-sm" type="radio" id='yes_customer' name="customer" value="yes">
                                                <label for="yes_customer">{{ __('Yes, it will have customers.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 yes">
                                            <div class="input-item text-left">
                                                <div class="input-wrap">
                                                    <input class="input-checkbox input-checkbox-sm switch-toggle" data-switch="switch-to-b2b" type="checkbox" id='b2b' name="chB2B">
                                                    <label for="b2b">{{ __('Business to Business') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="switch-content switch-to-b2b">
                                                    <div class="input-item text-left">
                                                        <div class="input-wrap">
                                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='b2bservice' name="b2b" value="b2bservice" checked >
                                                            <label for="b2bservice">{{ __('Offering Services') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="input-item text-left">
                                                        <div class="input-wrap">
                                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='b2bproduct' name="b2b" value="b2bproduct">
                                                            <label for="b2bproduct">{{ __('Offering Products') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 yes">
                                            <div class="input-item text-left">
                                                <div class="input-wrap">
                                                    <input class="input-checkbox input-checkbox-sm switch-toggle" data-switch="switch-to-b2c" type="checkbox" id='b2c' name="chB2C">
                                                    <label for="b2c">{{ __('Business to Consumers') }}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="switch-content switch-to-b2c">
                                                    <div class="input-item text-left">
                                                        <div class="input-wrap">
                                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='b2cservice' name="b2c" value="b2cservice" checked >
                                                            <label for="b2cservice">{{ __('Offering Services') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="input-item text-left">
                                                        <div class="input-wrap">
                                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='b2cproduct' name="b2c" value="b2cproduct">
                                                            <label for="b2cproduct">{{ __('Offering Products') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 business_model">
                                            <p> {{ __('Product Business Model') }}</p>
                                            <div class="input-item text-left">
                                                <div class="input-wrap">
                                                    <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='manufacture' name="manufacture">
                                                    <label for="manufacture">{{ __('Manufacture / Grow / Breed / Catch') }}</label>
                                                </div>
                                            </div>
                                            <div class="input-item text-left">
                                                <div class="input-wrap">
                                                    <input class="input-checkbox input-checkbox-sm" type="checkbox" id='import' name="import">
                                                    <label for="import">{{ __('Import (including parts, from one Custom Union to another)') }}</label>
                                                </div>
                                            </div>
                                            <div class="input-item text-left">
                                                <div class="input-wrap">
                                                    <input class="input-checkbox input-checkbox-sm" type="checkbox" id='export' name="export">
                                                    <label for="export">{{ __('Export (including parts, from one Custom Union to another)') }}</label>
                                                </div>
                                            </div>
                                            <div class="input-item text-left">
                                                <div class="input-wrap">
                                                    <input class="input-checkbox input-checkbox-sm" type="checkbox" id='domestic' name="domestic">
                                                    <label for="domestic">{{ __('Domestic Trade (with in Custom Union)') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 product_offering">
                                        <p> {{ __('Places of Product Offering') }}</p>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='outlet' name="outlet" >
                                                <label for="outlet">{{ __('In a physical Retail Outlet (example: shop or kiosk)') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='market' name="market">
                                                <label for="market">{{ __('On an Organized Market or Fair.') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='street'  name="street">
                                                <label for="street">{{ __('Via Street Trade or Door-to-Door Sales') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='internet'  name="internet" >
                                                <label for="internet">{{ __('Via the Internet') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='home' name="home">
                                                <label for="home">{{ __('From Home') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='mail' name="mail">
                                                <label for="mail">{{ __('By Mail Order') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm" type="checkbox" id='namely'  name="namely">
                                                <label for="namely">{{ __('Other, namely') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="input-bordered" type="text" name="othername" placeholder="Input text" >
                                        </div>
                                    </div>
                                </div>
                                <hr/>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between pdt-1x">
                                            <button class="btn btn-primary" type="submit"> {{ __('Add Branche') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="gaps-3x"></div>
                            </div>
                        </div>

                        <div class="form-step form-step1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <link rel="stylesheet" href="{{ asset('assets/plugins/trumbowyg/ui/trumbowyg.min.css')}}?ver=1.0">
    <script src="{{ asset('assets/plugins/trumbowyg/trumbowyg.min.js') }}?ver=101"></script>

    <script type="text/javascript">
        (function($) {
            var table = $('.data-table').DataTable({
                "destroy":          true,
                'scrollY':          300,
                // "scrollCollapse":   true,
                "paging":           false,
                "ordering":         false,
                "info":             false,
                "searching":        false,
                "responsive":       true,
                "autoWidth":        false,
            });

            if($('.editor').length > 0){
                $('.editor').trumbowyg({autogrow: true});
            }
            var $_form = $('form#update_page');
            if ($_form.length > 0) {
                ajax_form_submit($_form, false);
            }

            physicalclick();
            $('#registered_office').on('click', function(){
                physicalclick();
            });
            registerclick();
            $('#register_new').on('click', function(){
                registerclick();
            });
            existclick();
            $('#obtain_new').on('click', function(){
                existclick();
            })

            function physicalclick(){
                if ( $('#registered_office').prop('checked') ) $('.physical').show();
                else $('.physical').hide();
            }
            function registerclick(){
                if ( $('#register_new').prop('checked') ) {
                    $('.register').hide();
                    $('.correspondence').show()
                }
                else {
                    $('.register').show();
                    $('.correspondence').hide()
                }
            }
            function existclick(){
                if ( $('#obtain_new').prop('checked') ) {
                    $('.office_selection').hide();
                    $('.address').show();
                } else {
                    $('.office_selection').show();
                    $('.address').hide();
                }
            }

            showLocal1();
            $("#residental2").on("click",function(){
                showLocal1();
            });
            function showLocal1(){
                if ($("#residental2").prop('checked')) $(".local2").hide();
                else $(".local2").show();
            }

            showCorrespondence();
            $("#local2").on("click",function(){
                showCorrespondence();
            });
            function showCorrespondence(){
                if ($("#local2").prop('checked')) $(".correspondence").hide();
                else $(".correspondence").show();
            }




            $('#formid').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            $('#trading_name1').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });





            $('.yes').hide();
            $('input[name="customer"]').on('click', function(){
                if ($(this).val()=="yes"){
                    $('.yes').show("slow");
                } else{
                    $('.yes').hide("slow");
                }
            });

            $('input[name="customer"]').on("click", function(){
                if ($(this).val() =="no" ){
                    $(".business_model").hide("slow");
                    $(".product_offering").hide("slow");
                    $("#b2b").prop('checked', false).change();
                    $("#b2c").prop('checked', false).change();
                    $("#b2bservice").prop('checked', true).change();
                    $("#b2cservice").prop('checked', true).change();
                }
            });

            $(".business_model").hide();
            $('input[name="b2b"]').on('click', function(){
                if ($(this).val()=="b2bproduct")    {
                    $(".business_model").show("slow");
                }
                else {
                    if ( ($('#b2cservice').prop('checked')==true && $('#b2c').prop('checked')==true) || $('#b2c').prop('checked')==false )
                        $(".business_model").hide("slow");

                }
            });

            $(".product_offering").hide("slow");
            $('input[name="b2c"]').on('click', function(){
                if ($(this).val()=="b2cproduct")    {
                    $(".business_model").show("slow");
                    $(".product_offering").show("slow");
                }
                else {
                    $(".product_offering").hide("slow");
                    if ( ($('#b2bservice').prop('checked')==true && $('#b2b').prop('checked')==true) || $('#b2b').prop('checked')==false)
                        $(".business_model").hide("slow");
                }
            });

            $('[name="othername"]').hide();
            $('#namely').on('click', function(){
                if ($(this).is(":checked")){
                    $('[name="othername"]').show();
                } else {
                    $('[name="othername"]').hide();
                }
            })
        })(jQuery);
    </script>

@endpush
