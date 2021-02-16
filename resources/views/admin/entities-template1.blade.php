@extends('layouts.admin')
@section('title', __('Add Entity Type'))
    @php
    $has_sidebar = false;
    @endphp

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            @include('layouts.messages')
            <div class="card mx-lg-4">
                <div class="card-head has-aside pd-2x">
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entities > [ENTITY_NAME] ></b> <span style="font-size:0.8em"> Complete Formation/Onboarding</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="javascript:void(0)" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.ajax.entities.template1') }}" method="POST">
                    @csrf
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
                                        <label for="trading_name" class="input-item-label">{{__('Trading Names')}}</label>
                                        <div class="input-wrap">
                                            <select class="select-bordered select-block" name="trading_name" id="trading_name" data-dd-class="search-on" multiple="multiple" data-placeholder="Select Option">
                                                <option value="Ethereum" >{{ __('Ethereum') }}</option>
                                                <option value="Bitcoin" >{{ __('Bitcoin') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="purpose_type" class="input-item-label">{{__('Purpose Type')}}</label>
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
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
                                        <p> {{ __('Main Business Activities') }}</p>
                                        <button class="btn btn-primary btn-sm"> {{ __('Add Business Activity') }}</button>
                                    </div>

                                    <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user ">Section</th>
                                                <th class="data-col filter-data dt-user">Division</th>
                                                <th class="data-col filter-data dt-user">Group</th>
                                                <th class="data-col filter-data dt-user">Class</th>
                                                <th class="data-col dt-user">Sub-Class</th>
                                                <th class="data-col dt-status">Percent</th>
                                                <th class="data-col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($offices as $office)
                                                <tr class="data-item ">
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $office->section_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $office->division_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $office->group_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $office->class_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $office->subclass_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-status">
                                                        <span class="lead user-name">{{ $office->percent }}</span>
                                                    </td>
                                                    <td class="data-col text-right" style="width:70px">
                                                        <div class="relative d-inline-block">
                                                            <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                                <em class="ti ti-more-alt"></em></a>
                                                            <div class="toggle-class dropdown-content dropdown-content-top-left">
                                                                <ul class="dropdown-list more-menu-{{ $office->id }}">
                                                                    <li>
                                                                        <a href="#" data-toggle="modal" data-target="#editJurisdiction" data-id="{{ $office->id }}"
                                                                            class="user-action front editJurisdiction">
                                                                            <em class="fas fa-edit"></em>Edit
                                                                        </a>
                                                                        <a href="#" data-uid="{{ $office->id }}" data-type="delete_user"
                                                                            data-url="{{ route('admin.ajax.juris.delete', $office->id) }}"
                                                                            class="user-action front"
                                                                            data-title="Are you sure you want to delete this Jurisdiction?">
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
                                    <div class="gaps-3x"></div>
                                    <div class="input-item  input-with-label text-area">
                                        <label for="description" class="input-item-label">
                                            <h5>Activity Description</h5>
                                            <p>Describe here what products/services the new Company will offer, to who, and how. Use 8 words minimum.</p>
                                        </label>
                                        <div class="input-wrap">
                                            <textarea id="description" rows="5" name="description" class="input-bordered input-textarea editor" >dddd</textarea>
                                        </div>
                                    </div>

                                    <div class="gaps-1x"></div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-md-6">
                                    <p> {{ __('Customer Descriptions') }}</p>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-checkbox input-checkbox-sm all_methods" type="radio" id='business_consumers' >
                                            <label for="business_consumers">{{ __('Business to Consumers') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-checkbox input-checkbox-sm all_methods" type="radio" id='business_business' >
                                            <label for="business_business">{{ __('Business to Business') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-checkbox input-checkbox-sm all_methods" type="radio" id='no_customers' >
                                            <label for="no_customers">{{ __('No Customers') }}</label>
                                        </div>
                                    </div>

                                    <p> {{ __('Offering Type') }}</p>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='service' >
                                            <label for="service">{{ __('Service') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='products' >
                                            <label for="products">{{ __('Products') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='manufacture' >
                                                <label for="manufacture">{{ __('Manufacture') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='import' >
                                                <label for="import">{{ __('Import (including parts, from one Custom Union to another)') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='export' >
                                                <label for="export">{{ __('Export (including parts, from one Custom Union to another)') }}</label>
                                            </div>
                                        </div>
                                        <div class="input-item text-left">
                                            <div class="input-wrap">
                                                <input class="input-checkbox input-checkbox-sm all_methods" type="checkbox" id='domestic' >
                                                <label for="domestic">{{ __('Domestic Trade (within Custom Union)') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p> {{ __('Places of Product Offering') }}</p>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='outlet' name="product_offering" >
                                            <label for="outlet">{{ __('In a physical Retail Outlet (example: shop or kiosk)') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='market' name="product_offering">
                                            <label for="market">{{ __('On an Organized Market or Fair.') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='street' name="product_offering">
                                            <label for="street">{{ __('Via Street Trade or Door-to-Door Sales') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='internet' name="product_offering" >
                                            <label for="internet">{{ __('Via the Internet') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='home' name="product_offering">
                                            <label for="home">{{ __('From Home') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='mail' name="product_offering">
                                            <label for="mail">{{ __('By Mail Order') }}</label>
                                        </div>
                                    </div>
                                    <div class="input-item text-left">
                                        <div class="input-wrap">
                                            <input class="input-radio input-radio-sm all_methods" type="radio" id='namely' name="product_offering">
                                            <label for="namely">{{ __('Other, namely') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input class="input-bordered" type="text" placeholder="Input text" >
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
                                <div class="col-md-6">
                                    <div class="switch-content switch-to-yes">
                                        <div class="input-item input-with-label switch-to-yes">
                                            <input type="text" class="input-bordered" placeholder="Input text" name="txt_namely">
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

@push('footer')
    <link rel="stylesheet" href="{{ asset('assets/plugins/trumbowyg/ui/trumbowyg.min.css')}}?ver=1.0">
    <script src="{{ asset('assets/plugins/trumbowyg/trumbowyg.min.js') }}?ver=101"></script>

    <script type="text/javascript">
        (function($) {
            var table = $('.data-table').DataTable({
                "destroy":          true,
                'scrollY':          300,
                "scrollCollapse":   true,
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
        })(jQuery);
    </script>

@endpush
