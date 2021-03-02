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
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entities > {{ $entities->entity_name }} ></b> <span style="font-size:0.8em"> Complete Formation/Onboarding</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('user.entities') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>
                <form method="POST" action="{{ route('user.entities.add.purpose_activites') }}" autocomplete="off" id="formid">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Entity Purpose Type')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="purpose_type" id="purpose_type" data-dd-class="search-on">
                                                <option value="" default >Select Option</option>
                                                <option value="Personal Holding Company" >{{ __('Personal Holding Company') }}</option>
                                                <option value="Commercial Holding Company" >{{ __('Commercial Holding Company') }}</option>
                                                <option value="Operating Company" >{{ __('Operating Company') }}</option>
                                                <option value="Single Purpose Vehicle" >{{ __('Single Purpose Vehicle') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="trading_name" class="input-item-label">{{__('Trading Names')}}</label>
                                        <div class="input-wrap">
                                            <input id="trading_name" name="trading_name"  type="text"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr/>
                            <div class="gaps-2x"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
                                        <p> {{ __('Main Business Activities') }}</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBusiness">
                                            <em class="fas fa-plus-circle"></em><span> {{ __('Add Business Activity') }}</span>
                                        </a>
                                    </div>

                                    <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user">{{ __('Division') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Group') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Class') }}</th>
                                                <th class="data-col dt-user">{{ __('Sub-Class') }}</th>
                                                <th class="data-col dt-status">{{ __('Relativve Portion') }}</th>
                                                <th class="data-col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($business as $busi)
                                                <tr class="data-item ">
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $busi->get_division->division_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $busi->get_group->group_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $busi->get_class->class_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $busi->get_subclass->subclass_label }}</span>
                                                    </td>

                                                    <td class="data-col dt-status">
                                                        <span class="lead dt-status">{{ $busi->percent }}</span>
                                                    </td>
                                                    <td class="data-col text-right" style="width:70px">
                                                        <div class="relative d-inline-block">
                                                            <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a>
                                                            <div class="toggle-class dropdown-content dropdown-content-top-left">
                                                                <ul class="dropdown-list more-menu-{{ $busi->id }}">
                                                                    <li>
                                                                        <a href="#" data-toggle="modal" data-target="#editBusiness"
                                                                        data-id="{{ $busi->id }}" data-division="{{ $busi->division_id }}" data-group="{{ $busi->group_id }}" data-class="{{ $busi->class_id }}" data-subclass="{{ $busi->subclass_id }}" data-percent="{{ $busi->percent }}"
                                                                            class="user-action front editJurisdiction"> <em class="fas fa-edit"></em>Edit
                                                                        </a>
                                                                        <a href="#" data-uid="{{ $busi->id }}" class="user-action front" >
                                                                            <em class="fas fa-trash-alt"></em>Delete
                                                                        </a>
                                                                        {{-- <a href="#" data-uid="{{ $busi->id }}" data-type="delete_user"
                                                                            data-url="{{ route('admin.ajax.juris.delete', $busi->id) }}"
                                                                            class="user-action front" data-title="Are you sure you want to delete this Jurisdiction?">
                                                                            <em class="fas fa-trash-alt"></em>Delete
                                                                        </a> --}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr/>
                                    <div class="gaps-3x"></div>
                                    <div class="input-item  input-with-label text-area">
                                        <label for="description" class="input-item-label">
                                            <h5>Activity Description</h5>
                                            <p>Describe here what products/services the new Company will offer, to who, and how. Use 8 words minimum.</p>
                                        </label>
                                        <div class="input-wrap">
                                            <textarea id="description" rows="5" name="description" class="input-bordered input-textarea" ></textarea>
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
                                <div class="col-md-6">
                                    <p>{{ __('Will the Company be providing any kind of Financial (Advisory) Services to Third-Parties?') }}</p>
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="providing" type="checkbox" id="providing">
                                            <label for="providing">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ __('Will the Company be active as an Employment-, Secondment-, or Placement Agency?') }}</p>
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">Yes</span>
                                            <input class="input-switch" name="active" type="checkbox" id="active" >
                                            <label for="active">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5>{{ __('Regulatory Approvals') }}</h5>
                                    <p>{{ __('To the best of your knowledge, do the Business Activities of this Company require any operating licenses, permits, or certificates?') }}</p>
                                    <div class="gaps-2x"></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="align-items-center d-flex pr-3">{{ __('Yes, namely (use ";" as separator)') }}</span>
                                            <input class="input-switch switch-toggle" data-switch="switch-to-yes" name="regulatory_approvals" type="checkbox" id="regulatory_approvals">
                                            <label for="regulatory_approvals">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="switch-content switch-to-yes">
                                        <div class="input-item input-with-label">
                                            <label for="txt_namely" class="input-item-label">{{ __('Please explain') }}</label>
                                            <div class="input-wrap">
                                                <input type="text" class="input-bordered" placeholder="Input text" id="txt_namely" name="txt_namely">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="gaps-2x"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
                                        <a href="javascript:void(0)" class="btn btn-primary">{{ __('Previous Step') }}</a>
                                        <button class="btn btn-primary" type="submit"> {{ __('Next Step') }}</button>
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

    <div class="modal fade" id="addBusiness" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">{{ __('Add Business Activity') }}</h3>
                    <form action="{{ route('user.ajax.change.business_activities') }}" method="POST" class="adduser-form validate-modern" id="addBusinessForm" autocomplete="off">
                        @csrf
                        <input type="hidden" name="type" value="add"/>
                        <input type="hidden" name="entities" value="{{ $entities->id }}" />
                        <div class="row">
                            <div class="col-sm-12 division">
                                <div class="input-item input-with-label">
                                    <label for="division" class="input-item-label">{{ __('Division') }}</label>
                                    <select name="division"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->division_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 group">
                                <div class="input-item input-with-label">
                                    <label for="group" class="input-item-label">{{ __('Group') }}</label>
                                    <select name="group"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" data-id="{{ $group->division_id }}">{{ $group->group_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 class">
                                <div class="input-item input-with-label">
                                    <label for="class" class="input-item-label">{{ __('Class') }}</label>
                                    <select name="class"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" data-id="{{ $class->group_id }}">{{ $class->class_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 subclass">
                                <div class="input-item input-with-label">
                                    <label for="subclass" class="input-item-label">{{ __('Sub-Class') }}</label>
                                    <select name="subclass"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($subclasses as $subclass)
                                            <option value="{{ $subclass->id }}" data-id="{{ $subclass->class_id }}">{{ $subclass->subclass_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <div class="input-item input-with-label">
                            <label class="percent">{{ __('Relative Portion') }}</label>
                            <div class="input-wrap">
                                <input name="percent" class="input-bordered percent" required="required" type="text" placeholder="Percentage">
                            </div>
                        </div>

                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">{{ __('Add Business Activity') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBusiness" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">{{ __('Edit Business Activity') }}</h3>
                    <form action="{{ route('user.ajax.change.business_activities') }}" method="POST" class="adduser-form validate-modern" id="editBusinessForm" autocomplete="false">
                        @csrf
                        <input type="hidden" name="type" value="edit"/>
                        <input type="hidden" name="id" value="" />
                        <input type="hidden" name="entities" value="{{ $entities->id }}" />
                        <div class="row">
                            <div class="col-sm-12 division">
                                <div class="input-item input-with-label">
                                    <label for="division" class="input-item-label">{{ __('Division') }}</label>
                                    <select name="division"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->division_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 group">
                                <div class="input-item input-with-label">
                                    <label for="group" class="input-item-label">{{ __('Group') }}</label>
                                    <select name="group"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" data-id="{{ $group->division_id }}">{{ $group->group_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 class">
                                <div class="input-item input-with-label">
                                    <label for="class" class="input-item-label">{{ __('Class') }}</label>
                                    <select name="class"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" data-id="{{ $class->group_id }}">{{ $class->class_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 subclass">
                                <div class="input-item input-with-label">
                                    <label for="subclass" class="input-item-label">{{ __('Sub-Class') }}</label>
                                    <select name="subclass"  class="form-control" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                        @foreach ($subclasses as $subclass)
                                            <option value="{{ $subclass->id }}" data-id="{{ $subclass->class_id }}">{{ $subclass->subclass_label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <div class="input-item input-with-label">
                            <label class="percent">{{ __('Relative Portion') }}</label>
                            <div class="input-wrap">
                                <input name="percent" class="input-bordered percent" required="required" type="text" placeholder="Percentage">
                            </div>
                        </div>

                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">{{ __('Change Business Activity') }}</button>
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

            $('#formid').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });


            $('#trading_name').selectize({
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
                    $('[name="othername"]').show("slow");
                } else {
                    $('[name="othername"]').hide("slow");
                }
            })




            /// modal settings
            $('.group').hide();
            $('[name="division"]').on('change', function(){
                var id = $(this).val();
                console.log(id);
                if ( id==0) $('.group').hide("slow");
                else{
                    $(".group").show("slow");
                    jQuery(".group option[data-id='" + id + "']").show("slow");
                    jQuery(".group option[data-id!='" + id + "']").hide("slow");
                }
                $(".group option[value='']").show("slow").prop('selected', true);
                $("[name='group']").change();
            });

            $('.class').hide("slow");
            $('[name="group"]').on('change', function(){
                var id = $(this).val();
                if ( id==0) $('.class').hide("slow");
                else{
                    $(".class").show("slow");
                    jQuery(".class option[data-id='" + id + "']").show("slow");
                    jQuery(".class option[data-id!='" + id + "']").hide("slow");
                }
                $(".class option[value='']").show("slow").prop('selected', true);
                $('[name="class"]').change();
            });

            $('.subclass').hide("slow");
            $('[name="class"]').on('change', function(){
                var id = $(this).val();
                if ( id==0) $('.subclass').hide("slow");
                else{
                    $(".subclass").show("slow");
                    jQuery(".subclass option[data-id='" + id + "']").show("slow");
                    jQuery(".subclass option[data-id!='" + id + "']").hide("slow");
                }
                $(".subclass option[value='']").show("slow").prop('selected', true);
                $("[name='subclass']").change();
            })
            $('[data-target="#editBusiness"]').on('click', function(){
                $('[name="division"]').val($(this).data('division')).change();
                $('[name="group"]').val($(this).data('group')).change();
                $('[name="class"]').val($(this).data('class')).change();
                $('[name="subclass"]').val($(this).data('subclass')).change();
                $('[name="percent"]').val($(this).data('percent'));
                $('[name="id"]').val($(this).data('id'));
            });

            $('[data-target="#addBusiness"]').on('click', function(){
                $('[name="division"]').val("").change();
                $('[name="percent"]').val("");
            });
        })(jQuery);
    </script>

@endpush
