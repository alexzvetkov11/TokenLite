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
                    {{-- <div style="font-size:1.29em; color:#342d6e"> <b>Entities > {{ $entities->entity_name }} ></b> <span style="font-size:0.8em"> Complete Formation</span></div> --}}
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entities > [Entities Name ] ></b> <span style="font-size:0.8em"> Complete Formation</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('user.entities') }}" class="btn btn-auto btn-sm btn-primary" >
                            <em class="fa fa-arrow-circle-left"> </em><span>Back</span>
                        </a>
                    </div>
                </div>
                <form action="{{ route('user.ajax.entities.add.domiciliation') }}" method="POST" autocomplete="off">
                    @csrf
                    {{-- <input type="hidden" name="entity_id" value="{{ $entities->id }}" /> --}}

                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{__('Share Capital')}}</h4>
                                    <p>{{__('[text]')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <h5>{{ __('Share Classes') }}</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
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
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm mgt-3-5x" data-toggle="modal" data-target="#addShareClass">
                                                <em class="fas fa-plus-circle"> </em><span>{{ __('Add Share Class') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user ">{{ __('Class Code') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Share Type') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Par Value') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Authorized Shares') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Authorized Share Capital') }}</th>
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
                                                    <td class="data-col text-right" style="width:70px">
                                                        <div class="relative d-inline-block">
                                                            <a href="#" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                                <em class="ti ti-more-alt"></em></a>
                                                            <div class="toggle-class dropdown-content dropdown-content-top-left">
                                                                <ul class="dropdown-list more-menu-{{ $office->id }}">
                                                                    <li>
                                                                        <a href="#" data-toggle="modal" data-target="#editJurisdiction" data-id="{{ $office->id }}" class="user-action front editJurisdiction">
                                                                            <em class="fas fa-edit"></em>Edit
                                                                        </a>
                                                                        <a href="#" data-uid="{{ $office->id }}" data-type="delete_user" data-url="{{ route('admin.ajax.juris.delete', $office->id) }}"
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
                                    </table> --}}
                                    <div class="gaps-1x"></div>
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

    <div class="modal fade" tabindex="-1" id="addShareClass">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">{{ __('Add Share Class') }}</h3>
                    <hr/>
                    <form  method="POST" class="adduser-form validate-modern"  autocomplete="off">
                        @csrf
                        {{-- <input type="hidden" name="type" value="add"/> --}}
                        {{-- <input type="hidden" name="entities" value="{{ $entities->id }}" /> --}}
                        <div class="row">
                            <div class="col-sm-6 division">
                                <div class="input-item input-with-label">
                                    <label for="division" class="input-item-label">{{ __('Share Type') }}</label>
                                    <select name="division"  class="select-block select-bordered" required="required">
                                        <option value="ordinary">{{ __('Ordinary Shares') }}</option>
                                        <option value="preference">{{ __('Preference Shares') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <h5>{{ __('Share Capital') }}</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="group" class="input-item-label">{{ __('Par Value') }}</label>
                                    <div class="input-wrap">
                                        <input name="percent" class="input-bordered percent numerical" required="required" type="text" placeholder="Percentage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 class">
                                <div class="input-item input-with-label">
                                    <label for="class" class="input-item-label">{{ __('Authorized Shares') }}</label>
                                    <div class="input-wrap">
                                        <input name="percent" class="input-bordered percent numerical" required="required" type="text" placeholder="Percentage">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 subclass">
                                <div class="input-item input-with-label">
                                    <label for="subclass" class="input-item-label">{{ __('Authorized Share Capital') }}</label>
                                    <div class="input-wrap">
                                        <p> here you are.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <h5>{{ __('Share Capital') }}</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Voting Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="corResidential" type="checkbox" id="corResidential">
                                        <label for="corResidential">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 class">
                                <div class="input-item input-with-label">
                                    <label for="class" class="input-item-label">{{ __('Number of Votes per Share') }}</label>
                                    <div class="input-wrap">
                                        <input name="percent" class="input-bordered percent numerical" required="required" type="text" placeholder="Percentage">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Call and Participate in Meetings') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="corResidential" type="checkbox" id="corResidential">
                                        <label for="corResidential">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Reserve Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="corResidential" type="checkbox" id="corResidential">
                                        <label for="corResidential">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Conversion Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="corResidential" type="checkbox" id="corResidential">
                                        <label for="corResidential">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="division" class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="division"  class="select-block select-bordered" required="required">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="division" class="input-item-label">{{ __('Conversion Ratio') }}</label>
                                    <div class="input-wrap">
                                        <input name="percent" class="input-bordered percent numerical" required="required" type="text" placeholder="Percentage">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Continuous Conversion Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="corResidential" type="checkbox" id="corResidential">
                                        <label for="corResidential">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="start_date" class="input-item-label">{{ __('Conversion Rights Start Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered" type="text" id="start_date" name="start_date"  data-format="alt" min="{{ now()->toDateString('d-m-Y') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="end_date" class="input-item-label">{{ __('Conversion Right End Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered" type="text" id="end_date" name="end_date" data-format="alt" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Pre-emption rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-to-preemption" name="preemption" type="checkbox" id="preemption">
                                        <label for="preemption">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="switch-content switch-to-preemption">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="division" class="input-item-label">{{ __('Pre-emption rights applicable to:') }}</label>
                                        <select name="division"  class="select-block select-bordered" required="required">
                                            <option value="share_type">{{ __('Share Type') }}</option>
                                            <option value="share_class">{{ __('Share Class') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="division" class="input-item-label">{{ __('Calculation Method') }}</label>
                                        <select name="division"  class="select-block select-bordered" required="required">
                                            <option value="number_of_share">{{ __('Number of shares held') }}</option>
                                            <option value="nominal_value">{{ __('Nominal Value') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">{{ __('Add Share Class') }}</button>
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
            // var table = $('.data-table').DataTable({
            //     "destroy":          true,
            //     'scrollY':          300,
            //     "scrollCollapse":   true,
            //     "paging":           false,
            //     "ordering":         false,
            //     "info":             false,
            //     "searching":        false,
            //     "responsive":       true,
            //     "autoWidth":        false,
            // });

            // if($('.editor').length > 0){
            //     $('.editor').trumbowyg({autogrow: true});
            // }
            var $_form = $('form#update_page');
            if ($_form.length > 0) {
                ajax_form_submit($_form, false);
            }

            $("#start_date").on("change", function(){
               var start =new Date( $(this).val());
               start.setDate( start.getDate() + 1);
               $("#end_date").prop('min', start );
            });

            $("#start_date").datepicker({
                minDate: -0, maxDate: new Date(2013, 1, 18)
            });



        })(jQuery);
    </script>

@endpush
