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
                <form id="tt" class="tt" method="POST" 
                    action="{{ isset($associations)? route('admin.ajax.entype.editAssociations') : route('admin.ajax.entype.addAssociations')}}">
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
                                            <input required type="number" class="input-bordered" id="minmember" name="minmember" required placeholder="Only whole numbers allowed."
                                             value="{{ isset($associations)? $associations->members_min : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-with-label">
                                        <label for="maxmember"  class="input-item-label">{{__('Minimum Number of Members')}}</label>
                                        <div class="input-wrap">
                                            <input required type="number" class="input-bordered" id="maxmember" name="maxmember" required placeholder="Only whole numbers allowed."
                                            value="{{ isset($associations)? $associations->members_max : ''}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <input type="hidden" name="entypeId" value="{{$entype->id}}">
                    <input type="hidden" name="associationId" value="{{isset($associations)?$associations->id:''}}">

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
