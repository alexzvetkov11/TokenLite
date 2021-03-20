@extends('layouts.user')
@section('title', __('Add Entity Type'))
    @php
    $has_sidebar = false;
    @endphp

@section('content')

    <div class="row justify-content-center">
        <h4>{{ __("I am changing my original page for your changed design with backend. So It don't works now. Will make it on next step.") }}
        </h4>
        <div class="col-lg-12 col-xl-11">
            @include('layouts.messages')
            <div class="card mx-lg-4">
                <div class="card-head has-aside pd-2x">
                    {{-- <div style="font-size:1.29em; color:#342d6e"> <b>Entities > {{ $entities->entity_name }} ></b> <span style="font-size:0.8em"> Complete Formation</span></div> --}}
                    <div style="font-size:1.29em; color:#342d6e"> <b>Entities > {{ $entities->entity_name }} ></b> <span
                            style="font-size:0.8em"> Complete Formation</span></div>
                    <div class="card-opt data-action-list d-md-inline-flex">
                        <a href="{{ route('user.entities') }}" class="btn btn-auto btn-sm btn-primary">
                            <em class="fa fa-arrow-circle-left"> </em><span>{{ __('Back') }}</span>
                        </a>
                    </div>
                </div>
                <form autocomplete="off">
                    @csrf
                    {{-- <input type="hidden" name="entity_id" value="{{ $entities->id }}" /> --}}
                    <div class="form-step form-step1">
                        <div class="form-step-head card-innr">
                            <div class="step-head">
                                <div class="step-number">01</div>
                                <div class="step-head-text">
                                    <h4>{{ __('Share Capital') }}</h4>
                                    <p>{{ __('Share Capital') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-step-fields card-innr">
                            <h5>{{ __('Share Capital Currency') }}</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between pdt-1x">
                                        <div class="col-md-6">
                                            <div class="input-item input-with-label">
                                                <label for="purpose_type"
                                                    class="input-item-label">{{ __('Currency') }}</label>
                                                <div class="input-wrap">
                                                    <select class="select-block select-bordered" name="purpose_type"
                                                        id="purpose_type" data-dd-class="search-on">
                                                        <option value="" default>{{ __('Select Option') }}</option>
                                                        @foreach ($currencies as $cur)
                                                            <option value="{{ $cur->id }}"> {{ $cur->cur_label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div>
                                            <a href="#" class="btn btn-primary btn-sm mgt-3-5x" data-toggle="modal"
                                                data-target="#addShareClass">
                                                <em class="fas fa-plus-circle">
                                                </em><span>{{ __('Add Share Class') }}</span>
                                            </a>
                                        </div> --}}
                                    </div>
                                    <hr />

                                    <p>{{ __('Standard Ordinary Share Class') }}</p>

                                    <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user ">{{ __('Class Code') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Share Type') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Par Value') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Authorized Shares') }}
                                                </th>
                                                <th class="data-col filter-data dt-user">
                                                    {{ __('Authorized Share Capital') }}
                                                </th>
                                                <th class="data-col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shareclasses as $class)
                                                @if ($class->class_code == 'A' && $class->share_type == 'ordinary')
                                                    <tr class="data-item ">
                                                        <td class="data-col dt-user">
                                                            <span class="lead user-name">
                                                                {{ $class->class_code }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span class="lead user-name">{{ $class->share_type }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span class="lead user-name">{{ $class->par_value }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span
                                                                class="lead user-name">{{ $class->authorized_shares }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span
                                                                class="lead user-name">{{ floatval($class->authorized_shares) * floatval($class->par_value) }}</span>
                                                        </td>
                                                        <td class="data-col text-right" style="width:70px">
                                                            <div class="relative d-inline-block">
                                                                <a href="#"
                                                                    class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                                    <em class="ti ti-more-alt"></em></a>
                                                                <div
                                                                    class="toggle-class dropdown-content dropdown-content-top-left">
                                                                    <ul
                                                                        class="dropdown-list more-menu-{{ $class->id }}">
                                                                        <li>
                                                                            <a href="javascript:void(0)" data-toggle="modal"
                                                                                data-target="#editPrimary"
                                                                                data-id="{{ $class->id }}"
                                                                                class="user-action front editJurisdiction">
                                                                                <em class="fas fa-edit"></em>Edit
                                                                            </a>
                                                                            {{-- <a href="javascript:void(0)"
                                                                                data-uid="{{ $class->id }}"
                                                                                data-type="delete_user" data-url=""
                                                                                class="user-action front"
                                                                                data-title="Are you sure you want to delete this Jurisdiction?">
                                                                                <em class="fas fa-trash-alt"></em>Delete
                                                                            </a> --}}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr />

                                    <div class="d-flex justify-content-between pdt-1x">
                                        <p>{{ __('Add Share Class') }}</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#addBusiness">
                                            <em class="fas fa-plus-circle"></em>
                                            <span>{{ __('Add Share Class') }}</span>
                                        </a>
                                    </div>
                                    <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user ">{{ __('Class Code') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Share Type') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Par Value') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Authorized Shares') }}
                                                </th>
                                                <th class="data-col filter-data dt-user">
                                                    {{ __('Authorized Share Capital') }}
                                                </th>
                                                <th class="data-col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shareclasses as $class)
                                                @if ($class->class_code != 'A' && $class->share_type != 'ordinary')
                                                    <tr class="data-item ">
                                                        <td class="data-col dt-user">
                                                            <span class="lead user-name">
                                                                {{ $class->class_code }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span class="lead user-name">{{ $class->share_type }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span class="lead user-name">{{ $class->par_value }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span
                                                                class="lead user-name">{{ $class->authorized_shares }}</span>
                                                        </td>
                                                        <td class="data-col dt-user">
                                                            <span
                                                                class="lead user-name">{{ floatval($class->authorized_shares) * floatval($class->par_value) }}</span>
                                                        </td>
                                                        <td class="data-col text-right" style="width:70px">
                                                            <div class="relative d-inline-block">
                                                                <a href="#"
                                                                    class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                                    <em class="ti ti-more-alt"></em></a>
                                                                <div
                                                                    class="toggle-class dropdown-content dropdown-content-top-left">
                                                                    <ul
                                                                        class="dropdown-list more-menu-{{ $class->id }}">
                                                                        <li>
                                                                            <a href="javascript:void(0)" data-toggle="modal"
                                                                                data-target="#editJurisdiction"
                                                                                data-id="{{ $class->id }}"
                                                                                class="user-action front editJurisdiction">
                                                                                <em class="fas fa-edit"></em>Edit
                                                                            </a>
                                                                            <a href="javascript:void(0)"
                                                                                data-uid="{{ $class->id }}"
                                                                                data-type="delete_user" data-url=""
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
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr />

                                    <div class="d-flex justify-content-between pdt-1x">
                                        <p>{{ __('Corporate Bodies: Shareholders') }}</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#addBusiness">
                                            <em class="fas fa-plus-circle"></em>
                                            <span>{{ __('Add Shareholder Corporate Body') }}</span>
                                        </a>
                                    </div>
                                    <table class="data-table dt-filter-init user-list pt-3">
                                        <thead>
                                            <tr class="data-item data-head">
                                                <th class="data-col filter-data dt-user ">{{ __('Body Name') }}</th>
                                                <th class="data-col filter-data dt-user">{{ __('Type') }}</th>
                                                <th class="data-col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bodies as $body)
                                                <tr class="data-item ">
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $body->body_label }}</span>
                                                    </td>
                                                    <td class="data-col dt-user">
                                                        <span class="lead user-name">{{ $body->body_type }}</span>
                                                    </td>
                                                    <td class="data-col text-right" style="width:70px">
                                                        <div class="relative d-inline-block">
                                                            @if (strtolower($body->body_type) == 'optional')
                                                                <a href="#"
                                                                    class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                                                    <em class="ti ti-more-alt"></em></a>

                                                                <div
                                                                    class="toggle-class dropdown-content dropdown-content-top-left">
                                                                    <ul
                                                                        class="dropdown-list more-menu-{{ $body->id }}">
                                                                        <li>
                                                                            <a href="javascript:void(0)" data-toggle="modal"
                                                                                data-target="#editJurisdiction"
                                                                                data-id="{{ $body->id }}"
                                                                                class="user-action front editJurisdiction">
                                                                                <em class="fas fa-edit"></em>Edit
                                                                            </a>
                                                                            <a href="javascript:void(0)"
                                                                                data-uid="{{ $body->id }}"
                                                                                data-type="delete_user" data-url=""
                                                                                class="user-action front"
                                                                                data-title="Are you sure you want to delete this Jurisdiction?">
                                                                                <em class="fas fa-trash-alt"></em>Delete
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                    <hr />
                    <form action="{{ route('user.ajax.entities.add.shareclass') }}" method="POST"
                        class="adduser-form validate-modern" autocomplete="off">
                        @csrf
                        <input type="hidden" name="type" value="add" />
                        <input type="hidden" name="entities" value="{{ $entities->id }}" />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="shareoption" class="input-item-label">{{ __('Share Type') }}</label>
                                    <select name="shareoption" id="shareoption" class="select-block select-bordered">
                                        <option value="ordinary">{{ __('Ordinary Shares') }}</option>
                                        <option value="preference">{{ __('Preference Shares') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <h5>{{ __('Share Capital') }}</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="parvalue" class="input-item-label">{{ __('Par Value') }}</label>
                                    <div class="input-wrap">
                                        <input name="parvalue" id="parvalue" class="input-bordered commadouble" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 class">
                                <div class="input-item input-with-label">
                                    <label for="class" class="input-item-label">{{ __('Authorized Shares') }}</label>
                                    <div class="input-wrap">
                                        <input name="authorizedshares" class="input-bordered percent comma" type="text"
                                            placeholder="Percentage">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 subclass">
                                <div class="input-item input-with-label">
                                    <label for="subclass"
                                        class="input-item-label">{{ __('Authorized Share Capital') }}</label>
                                    <div class="input-wrap">
                                        <p> here you are.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <h5>{{ __('Votting & Metting') }}</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Voting Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-votting-right"
                                            type="checkbox" id="chvotingright" name="chvotingright">
                                        <label for="chvotingright">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 class">
                                <div class="switch-content switch-votting-right">
                                    <div class="input-item input-with-label">
                                        <label for="class"
                                            class="input-item-label">{{ __('Number of Votes per Share') }}</label>
                                        <div class="input-wrap">
                                            <input name="votingRightNumber" class="input-bordered commadouble" type="text"
                                                placeholder="3 decimal" id="votingRightNumber">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chMeetingRight">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Meetings Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="chMeetingRight" type="checkbox"
                                            id="chMeetingRight">
                                        <label for="chMeetingRight">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <h5 class="ordinary">{{ __('Reserves') }}</h5>
                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Reserves Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="chReserveRight" type="checkbox"
                                            id="chReserveRight" checked>
                                        <label for="chReserveRight">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ordinary" />


                        <h5 class="ordinary"> {{ __('Conversion') }}</h5>
                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Conversion Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="chConversionRight" type="checkbox"
                                            id="chConversionRight">
                                        <label for="chConversionRight">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="conversionshare"
                                        class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="conversionshare" id="conversionshare"
                                        class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="conversionratio"
                                        class="input-item-label">{{ __('Conversion Ratio') }}</label>
                                    <div class="input-wrap">
                                        <input name="conversionratio" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Continuous Conversion Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-continue"
                                            name="continueconversion" type="checkbox" id="continueconversion">
                                        <label for="continueconversion">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="switch-content switch-continue">
                            <div class="row ordinary">
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="start_date"
                                            class="input-item-label">{{ __('Conversion Rights Start Date') }}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered date-picker" type="text" id="start_date"
                                                name="start_date" date-format="alt" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="end_date"
                                            class="input-item-label">{{ __('Conversion Right End Date') }}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered date-picker" type="text" id="end_date"
                                                name="end_date" date-format="alt" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ordinary" />

                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Pre-emption rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-to-preemption"
                                            name="preemption" type="checkbox" id="preemption">
                                        <label for="preemption">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="switch-content switch-to-preemption">
                            <div class="row ordinary">
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="pre_emption_apply"
                                            class="input-item-label">{{ __('Pre-emption rights applicable to:') }}</label>
                                        <select name="pre_emption_apply" class="select-block select-bordered">
                                            <option value="share_type">{{ __('Share Type') }}</option>
                                            <option value="share_class">{{ __('Share Class') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="preference">{{ __('Reserves & Preferred Dividend') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="reserveoption"
                                        class="input-item-label">{{ __('Preferred Dividend Calculation') }}</label>
                                    <select name="reserveoption" id="reserveoption" class="select-block select-bordered">
                                        <option value="fixed">{{ __('Fixed') }}</option>
                                        <option value="floating">{{ __('Floating') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row floating">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="benchmark" class="input-item-label">{{ __('Benchmark') }}</label>
                                    <select name="benchmark" id="benchmark" class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="premium" class="input-item-label">{{ __('Premium') }}</label>
                                    <select name="premium" id="premium" class="select-block select-bordered">
                                        <option value="fixed">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="annual"
                                        class="input-item-label">{{ __('Preferential Annual Dividend Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="annual" id="annual" class="input-bordered percent" type="text"
                                            placeholder="Percent">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="frequency" class="input-item-label">{{ __('Payment Frequency') }}</label>
                                    <select name="frequency" id="frequency" class="select-block select-bordered">
                                        <option value="manthly">{{ __('Monthly (save as "12")') }}</option>
                                        <option value="quarterly">{{ __('Quarterly ("4")') }}</option>
                                        <option value="semi">{{ __('Semi-Annually ("2")') }}</option>
                                        <option value="annual">{{ __('Annual ("1")') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Cumulative') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" type="checkbox" id="chCumulative" name="chCumulative">
                                        <label for="chCumulative">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Participating in Reserves') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" type="checkbox" id="chParticipating"
                                            name="chParticipating">
                                        <label for="chParticipating">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />

                        <h5 class="preference">{{ __('Maturity') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Maturity Type') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Perpetual') }}</span>
                                        <input class="input-switch" type="checkbox" id="chPerpetual" name="chPerpetual">
                                        <label for="chPerpetual">{{ __('Non-Perpetual') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chPerpetual">
                                <div class="input-item input-with-label">
                                    <label for="maturity_date" class="input-item-label">{{ __('Maturity Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="maturity_date"
                                            name="maturity_date" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chPerpetual">
                                <div class="input-item input-with-label">
                                    <label for="settlement" class="input-item-label">{{ __('Settlement') }}</label>
                                    <select name="settlement" class="select-block select-bordered">
                                        <option value="buyback">{{ __('Buy-Back') }}</option>
                                        <option value="conversion">{{ __('Conversion') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="settlement"
                                        class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="settlement" class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                        <option value="ordinary_rights_voting">{{ __('ordinary_rights_voting') }}
                                        </option>
                                        <option value="ordinary_rights_regular_dividend">
                                            {{ __('ordinary_rights_regular_dividend') }}</option>
                                        <option value="preference_dividend_rate">{{ __('preference_dividend_rate') }}
                                        </option>
                                        <option value="preference_cumulative">{{ __('preference_cumulative') }}</option>
                                        <option value="preference_maturity_type">{{ __('preference_maturity_type') }}
                                        </option>
                                        <option value="preference_maturity_date">{{ __('preference_maturity_date') }}
                                        </option>
                                        <option value="preference_redemption_rights">
                                            {{ __('preference_redemption_rights') }}</option>
                                        <option value="preference_redemption_rate">
                                            {{ __('preference_redemption_rate') }}
                                        </option>
                                        <option value="preference_redemption_start_date">
                                            {{ __('preference_redemption_start_date') }}</option>
                                        <option value="preference_redemption_end_date">
                                            {{ __('preference_redemption_end_date') }}</option>
                                        <option value="preference_conversion_rights">
                                            {{ __('preference_conversion_rights') }}</option>
                                        <option value="preference_conversion_rate">
                                            {{ __('preference_conversion_rate') }}
                                        </option>
                                        <option value="preference_conversion_start_date">
                                            {{ __('preference_conversion_start_date') }}</option>
                                        <option value="preference_conversion_end_date">
                                            {{ __('preference_conversion_end_date') }}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="maturityrate"
                                        class="input-item-label">{{ __('Conversion Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="maturityrate" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />


                        <h5 class="preference">{{ __('Redemption') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Redemption Rights (Issuer)') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chRedemption" name="chRedemption">
                                        <label for="chRedemption">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chRedemption">
                                <div class="input-item input-with-label">
                                    <label for="maturity_date"
                                        class="input-item-label">{{ __('Continuous Redemption Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chContinueRedemption"
                                            name="chContinueRedemption">
                                        <label for="chContinueRedemption">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chRedemption">
                                <div class="input-item input-with-label">
                                    <label for="redemptionrate"
                                        class="input-item-label">{{ __('Redemption Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="redemptionrate" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chContinueRedemption">
                                <div class="input-item input-with-label">
                                    <label for="redstart_date"
                                        class="input-item-label">{{ __('Redemption Rights Start Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="redstart_date"
                                            name="redstart_date" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chContinueRedemption">
                                <div class="input-item input-with-label">
                                    <label for="redend_date"
                                        class="input-item-label">{{ __('Redemption Right End Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="redend_date"
                                            name="redend_date" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />

                        <h5 class="preference">{{ __('Conversion') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Conversion Rights (Holder)') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chPreconversion"
                                            name="chPreconversion">
                                        <label for="chPreconversion">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chPreconversion">
                                <div class="input-item input-with-label">
                                    <label for="preconversionshare"
                                        class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="preconversionshare" id="preconversionshare"
                                        class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 chPreconversion">
                                <div class="input-item input-with-label">
                                    <label for="preconversionrate"
                                        class="input-item-label">{{ __('Conversion Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="preconversionrate" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Continuous Conversion Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chPrecontinue" name="chPrecontinue">
                                        <label for="chPrecontinue">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chPrecontinue">
                                <div class="input-item input-with-label">
                                    <label for="preconversion_start"
                                        class="input-item-label">{{ __('Conversion Rights Start Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="preconversion_start"
                                            name="preconversion_start" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chPrecontinue">
                                <div class="input-item input-with-label">
                                    <label for="preconversion_end"
                                        class="input-item-label">{{ __('Conversion Right End Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="preconversion_end"
                                            name="preconversion_end" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />


                        <h5 class="preference">{{ __('Liquidation Preferences') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="settlement" class="input-item-label">{{ __('Ranking') }}</label>
                                    <select name="settlement" class="select-block select-bordered">
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                    </select>
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
    <div class="modal fade" tabindex="-1" id="editPrimary">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">{{ __('Edit Primary Ordinary Share Class') }}</h3>
                    <hr />
                    <form action="{{ route('user.ajax.entities.add.shareclass') }}" method="POST"
                        class="adduser-form validate-modern" autocomplete="off">
                        @csrf
                        <input type="hidden" name="type" value="add" />
                        <input type="hidden" name="entities" value="{{ $entities->id }}" />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="shareoption" class="input-item-label">{{ __('Share Type') }}</label>
                                    <select name="shareoption" id="shareoption" class="select-block select-bordered">
                                        <option value="ordinary">{{ __('Ordinary Shares') }}</option>
                                        <option value="preference">{{ __('Preference Shares') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <h5>{{ __('Share Capital') }}</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="parvalue" class="input-item-label">{{ __('Par Value') }}</label>
                                    <div class="input-wrap">
                                        <input name="parvalue" id="parvalue" class="input-bordered commadouble" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 class">
                                <div class="input-item input-with-label">
                                    <label for="class" class="input-item-label">{{ __('Authorized Shares') }}</label>
                                    <div class="input-wrap">
                                        <input name="authorizedshares" class="input-bordered percent comma" type="text"
                                            placeholder="Percentage">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 subclass">
                                <div class="input-item input-with-label">
                                    <label for="subclass"
                                        class="input-item-label">{{ __('Authorized Share Capital') }}</label>
                                    <div class="input-wrap">
                                        <p> here you are.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <h5>{{ __('Voting & Metting') }}</h5>

                        <table class="data-table dt-filter-init user-list pt-3">

                            <tbody>
                                <tr class="data-item ">
                                    <td class="data-col dt-user">
                                        <span class="lead user-name"></span>
                                    </td>
                                    <td class="data-col dt-user">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="lead user-name">{{ __('Meeting Rights') }}</span>
                                        </div>
                                    </td>
                                    <td class="data-col dt-user">
                                        <div class="input-wrap input-wrap-switch">
                                            <span class="lead user-name">{{ __('Voting Rights') }}</span>
                                        </div>
                                    </td>
                                    <td class="data-col dt-user">
                                        <div class="input-item input-with-label">
                                            <span class="lead user-name">{{ __('Number of Votes per Share') }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($bodies as $body)
                                    <tr class="data-item ">
                                        <td class="data-col dt-user">
                                            <span class="lead user-name">{{ $body->body_label }}</span>
                                        </td>
                                        <td class="data-col dt-user">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">Yes</span>
                                                <input class="input-switch" name="chReserveRight" type="checkbox"
                                                    id="chReserveRight" checked>
                                                <label for="chReserveRight">No</label>
                                            </div>
                                        </td>
                                        <td class="data-col dt-user">
                                            <div class="input-wrap input-wrap-switch">
                                                <span class="align-items-center d-flex pr-3">Yes</span>
                                                <input class="input-switch" name="chReserveRight" type="checkbox"
                                                    id="chReserveRight" checked>
                                                <label for="chReserveRight">No</label>
                                            </div>
                                        </td>
                                        <td class="data-col dt-user">
                                            <div class="input-item input-with-label">
                                                <label for="parvalue"
                                                    class="input-item-label">{{ __('Par Value') }}</label>
                                                <div class="input-wrap">
                                                    <input name="parvalue" id="parvalue" class="input-bordered commadouble"
                                                        type="text" placeholder="Number">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="row">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Voting Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-votting-right"
                                            type="checkbox" id="chvotingright" name="chvotingright">
                                        <label for="chvotingright">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 class">
                                <div class="switch-content switch-votting-right">
                                    <div class="input-item input-with-label">
                                        <label for="class"
                                            class="input-item-label">{{ __('Number of Votes per Share') }}</label>
                                        <div class="input-wrap">
                                            <input name="votingRightNumber" class="input-bordered commadouble" type="text"
                                                placeholder="3 decimal" id="votingRightNumber">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chMeetingRight">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Meetings Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="chMeetingRight" type="checkbox"
                                            id="chMeetingRight">
                                        <label for="chMeetingRight">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr /> --}}


                        <h5 class="ordinary">{{ __('Reserves') }}</h5>
                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Reserves Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="chReserveRight" type="checkbox"
                                            id="chReserveRight" checked>
                                        <label for="chReserveRight">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ordinary" />


                        <h5 class="ordinary"> {{ __('Conversion') }}</h5>
                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Conversion Rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" name="chConversionRight" type="checkbox"
                                            id="chConversionRight">
                                        <label for="chConversionRight">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="conversionshare"
                                        class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="conversionshare" id="conversionshare"
                                        class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="conversionratio"
                                        class="input-item-label">{{ __('Conversion Ratio') }}</label>
                                    <div class="input-wrap">
                                        <input name="conversionratio" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Continuous Conversion Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-continue"
                                            name="continueconversion" type="checkbox" id="continueconversion">
                                        <label for="continueconversion">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="switch-content switch-continue">
                            <div class="row ordinary">
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="start_date"
                                            class="input-item-label">{{ __('Conversion Rights Start Date') }}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered date-picker" type="text" id="start_date"
                                                name="start_date" date-format="alt" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="end_date"
                                            class="input-item-label">{{ __('Conversion Right End Date') }}</label>
                                        <div class="input-wrap">
                                            <input class="input-bordered date-picker" type="text" id="end_date"
                                                name="end_date" date-format="alt" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ordinary" />

                        <div class="row ordinary">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Pre-emption rights') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch switch-toggle" data-switch="switch-to-preemption"
                                            name="preemption" type="checkbox" id="preemption">
                                        <label for="preemption">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="switch-content switch-to-preemption">
                            <div class="row ordinary">
                                <div class="col-sm-6">
                                    <div class="input-item input-with-label">
                                        <label for="pre_emption_apply"
                                            class="input-item-label">{{ __('Pre-emption rights applicable to:') }}</label>
                                        <select name="pre_emption_apply" class="select-block select-bordered">
                                            <option value="share_type">{{ __('Share Type') }}</option>
                                            <option value="share_class">{{ __('Share Class') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="preference">{{ __('Reserves & Preferred Dividend') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="reserveoption"
                                        class="input-item-label">{{ __('Preferred Dividend Calculation') }}</label>
                                    <select name="reserveoption" id="reserveoption" class="select-block select-bordered">
                                        <option value="fixed">{{ __('Fixed') }}</option>
                                        <option value="floating">{{ __('Floating') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row floating">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="benchmark" class="input-item-label">{{ __('Benchmark') }}</label>
                                    <select name="benchmark" id="benchmark" class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="premium" class="input-item-label">{{ __('Premium') }}</label>
                                    <select name="premium" id="premium" class="select-block select-bordered">
                                        <option value="fixed">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="annual"
                                        class="input-item-label">{{ __('Preferential Annual Dividend Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="annual" id="annual" class="input-bordered percent" type="text"
                                            placeholder="Percent">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="frequency"
                                        class="input-item-label">{{ __('Payment Frequency') }}</label>
                                    <select name="frequency" id="frequency" class="select-block select-bordered">
                                        <option value="manthly">{{ __('Monthly (save as "12")') }}</option>
                                        <option value="quarterly">{{ __('Quarterly ("4")') }}</option>
                                        <option value="semi">{{ __('Semi-Annually ("2")') }}</option>
                                        <option value="annual">{{ __('Annual ("1")') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Cumulative') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" type="checkbox" id="chCumulative" name="chCumulative">
                                        <label for="chCumulative">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Participating in Reserves') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">Yes</span>
                                        <input class="input-switch" type="checkbox" id="chParticipating"
                                            name="chParticipating">
                                        <label for="chParticipating">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />

                        <h5 class="preference">{{ __('Maturity') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Maturity Type') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Perpetual') }}</span>
                                        <input class="input-switch" type="checkbox" id="chPerpetual" name="chPerpetual">
                                        <label for="chPerpetual">{{ __('Non-Perpetual') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chPerpetual">
                                <div class="input-item input-with-label">
                                    <label for="maturity_date"
                                        class="input-item-label">{{ __('Maturity Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="maturity_date"
                                            name="maturity_date" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chPerpetual">
                                <div class="input-item input-with-label">
                                    <label for="settlement" class="input-item-label">{{ __('Settlement') }}</label>
                                    <select name="settlement" class="select-block select-bordered">
                                        <option value="buyback">{{ __('Buy-Back') }}</option>
                                        <option value="conversion">{{ __('Conversion') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="settlement"
                                        class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="settlement" class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                        <option value="ordinary_rights_voting">{{ __('ordinary_rights_voting') }}
                                        </option>
                                        <option value="ordinary_rights_regular_dividend">
                                            {{ __('ordinary_rights_regular_dividend') }}</option>
                                        <option value="preference_dividend_rate">{{ __('preference_dividend_rate') }}
                                        </option>
                                        <option value="preference_cumulative">{{ __('preference_cumulative') }}</option>
                                        <option value="preference_maturity_type">{{ __('preference_maturity_type') }}
                                        </option>
                                        <option value="preference_maturity_date">{{ __('preference_maturity_date') }}
                                        </option>
                                        <option value="preference_redemption_rights">
                                            {{ __('preference_redemption_rights') }}</option>
                                        <option value="preference_redemption_rate">
                                            {{ __('preference_redemption_rate') }}
                                        </option>
                                        <option value="preference_redemption_start_date">
                                            {{ __('preference_redemption_start_date') }}</option>
                                        <option value="preference_redemption_end_date">
                                            {{ __('preference_redemption_end_date') }}</option>
                                        <option value="preference_conversion_rights">
                                            {{ __('preference_conversion_rights') }}</option>
                                        <option value="preference_conversion_rate">
                                            {{ __('preference_conversion_rate') }}
                                        </option>
                                        <option value="preference_conversion_start_date">
                                            {{ __('preference_conversion_start_date') }}</option>
                                        <option value="preference_conversion_end_date">
                                            {{ __('preference_conversion_end_date') }}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="maturityrate"
                                        class="input-item-label">{{ __('Conversion Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="maturityrate" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />


                        <h5 class="preference">{{ __('Redemption') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Redemption Rights (Issuer)') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chRedemption" name="chRedemption">
                                        <label for="chRedemption">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chRedemption">
                                <div class="input-item input-with-label">
                                    <label for="maturity_date"
                                        class="input-item-label">{{ __('Continuous Redemption Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chContinueRedemption"
                                            name="chContinueRedemption">
                                        <label for="chContinueRedemption">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chRedemption">
                                <div class="input-item input-with-label">
                                    <label for="redemptionrate"
                                        class="input-item-label">{{ __('Redemption Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="redemptionrate" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chContinueRedemption">
                                <div class="input-item input-with-label">
                                    <label for="redstart_date"
                                        class="input-item-label">{{ __('Redemption Rights Start Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="redstart_date"
                                            name="redstart_date" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chContinueRedemption">
                                <div class="input-item input-with-label">
                                    <label for="redend_date"
                                        class="input-item-label">{{ __('Redemption Right End Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="redend_date"
                                            name="redend_date" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />

                        <h5 class="preference">{{ __('Conversion') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Conversion Rights (Holder)') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chPreconversion"
                                            name="chPreconversion">
                                        <label for="chPreconversion">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chPreconversion">
                                <div class="input-item input-with-label">
                                    <label for="preconversionshare"
                                        class="input-item-label">{{ __('Conversion Share Class') }}</label>
                                    <select name="preconversionshare" id="preconversionshare"
                                        class="select-block select-bordered">
                                        <option value="">{{ __('Select Option') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 chPreconversion">
                                <div class="input-item input-with-label">
                                    <label for="preconversionrate"
                                        class="input-item-label">{{ __('Conversion Rate') }}</label>
                                    <div class="input-wrap">
                                        <input name="preconversionrate" class="input-bordered percent numerical" type="text"
                                            placeholder="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label class="input-item-label">{{ __('Continuous Conversion Right') }}</label>
                                    <div class="input-wrap input-wrap-switch">
                                        <span class="align-items-center d-flex pr-3">{{ __('Yes') }}</span>
                                        <input class="input-switch" type="checkbox" id="chPrecontinue" name="chPrecontinue">
                                        <label for="chPrecontinue">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row preference">
                            <div class="col-sm-6 chPrecontinue">
                                <div class="input-item input-with-label">
                                    <label for="preconversion_start"
                                        class="input-item-label">{{ __('Conversion Rights Start Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="preconversion_start"
                                            name="preconversion_start" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 chPrecontinue">
                                <div class="input-item input-with-label">
                                    <label for="preconversion_end"
                                        class="input-item-label">{{ __('Conversion Right End Date') }}</label>
                                    <div class="input-wrap">
                                        <input class="input-bordered date-picker" type="text" id="preconversion_end"
                                            name="preconversion_end" date-format="alt" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="preference" />


                        <h5 class="preference">{{ __('Liquidation Preferences') }}</h5>
                        <div class="row preference">
                            <div class="col-sm-6">
                                <div class="input-item input-with-label">
                                    <label for="settlement" class="input-item-label">{{ __('Ranking') }}</label>
                                    <select name="settlement" class="select-block select-bordered">
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                    </select>
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
    <link rel="stylesheet" href="{{ asset('assets/plugins/trumbowyg/ui/trumbowyg.min.css') }}?ver=1.0">
    <script src="{{ asset('assets/plugins/trumbowyg/trumbowyg.min.js') }}?ver=101"></script>

    <script type="text/javascript">
        (function($) {
            var table = $('.data-table').DataTable({
                "destroy": true,
                'scrollY': 300,
                // "scrollCollapse":   true,
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,
                "responsive": true,
                "autoWidth": false,
            });

            if ($('.editor').length > 0) {
                $('.editor').trumbowyg({
                    autogrow: true
                });
            }
            var $_form = $('form#update_page');
            if ($_form.length > 0) {
                ajax_form_submit($_form, false);
            }

            // $("#start_date").on("change", function(){
            //    var start =new Date( $(this).val());
            //    start.setDate( start.getDate() + 1);

            //     var dd = start.getDate();
            //     var mm = start.getMonth()+1; //January is 0 so need to add 1 to make it 1!
            //     var yyyy = start.getFullYear();
            //     if(dd<10) dd='0'+dd
            //     if(mm<10) mm='0'+mm

            //     end = yyyy+'-'+mm+'-'+dd;
            //     document.getElementById("end_date").setAttribute("min", end);
            //     console.log(end)
            // });

            changeShareoption();
            $("#shareoption").change(changeShareoption);

            function changeShareoption() {
                if ($("#shareoption").val() == "ordinary") {
                    $(".ordinary").show("slow");
                    $(".preference").hide("slow");
                } else {
                    $(".ordinary").hide("slow");
                    $(".preference").show("slow");
                }
            }
            showMeetingRight();
            $("#chvotingright").click(function(e) {
                if ($("#chReserveRight").is(':checked') == false && $("#chvotingright").is(":checked") ==
                    false) {
                    e.preventDefault();
                    return false;
                }
                showMeetingRight(e);
            });

            function showMeetingRight() {
                if ($("#chvotingright").is(":checked")) $(".chMeetingRight").hide("slow");
                else $(".chMeetingRight").show("slow");
            }

            $("#chReserveRight").click(function(e) {
                if ($("#chReserveRight").is(':checked') == false && $("#chvotingright").is(":checked") ==
                    false) {
                    e.preventDefault();
                    return false;
                }
            });

            $("[name='votingRightNumber']").on("keydown", function(e) {
                var keycode = (event.which) ? event.which : event.keyCode;
                var parts = this.value.split('.');
                var parts = this.value.split('.');
                if (parts.length > 1 && parts[1].length >= 3) {
                    if ([8, 39, 37, 46].indexOf(keycode) >= 0) return true;
                    return false;
                }
            });

            changeReserveoption();
            $("#reserveoption").change(changeReserveoption);

            function changeReserveoption() {
                if ($("#reserveoption").val() == "floating") {
                    $(".floating").show("slow");
                } else {
                    $(".floating").hide("slow");
                }
            }

            changePerpetual();
            $("#chPerpetual").click(changePerpetual);

            function changePerpetual() {
                if ($("#chPerpetual").is(":checked")) $(".chPerpetual").hide("slow");
                else $(".chPerpetual").show("slow");
            }

            changeRedemption();
            $("#chRedemption").click(changeRedemption);

            function changeRedemption() {
                if ($("#chRedemption").is(":checked")) $(".chRedemption").show("slow");
                else $(".chRedemption").hide("slow");
            }
            changeContinueRedemption();
            $("#chContinueRedemption").click(changeContinueRedemption);

            function changeContinueRedemption() {
                if ($("#chContinueRedemption").is(":checked")) $(".chContinueRedemption").hide("slow");
                else $(".chContinueRedemption").show("slow");
            }

            changePreconversion();
            $("#chPreconversion").click(changePreconversion);

            function changePreconversion() {
                if ($("#chPreconversion").is(":checked")) $(".chPreconversion").show("slow");
                else $(".chPreconversion").hide("slow");
            }

            changePrecontinue();
            $("#chPrecontinue").click(changePrecontinue);

            function changePrecontinue() {
                if ($("#chPrecontinue").is(":checked")) $(".chPrecontinue").hide("slow");
                else $(".chPrecontinue").show("slow");
            }

        })(jQuery);

    </script>

@endpush
