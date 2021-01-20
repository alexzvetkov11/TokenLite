@extends('layouts.admin')
@section('title', 'Edit Article')
@section('content')

    <div class="page-content">
        <div class="container">
            @include('layouts.messages')
            @include('vendor.notice')
            <div class="card content-area content-area-mh">
                <div class="card-innr">
                    <div class="card-head has-aside">
                        <div style="font-size:1.29em; color:#342d6e"> <b>Entities > {{ $article->article_label }} ></b>
                            <span style="font-size:0.8em">Edit Article Text </span>
                        </div>
                        <div class="card-opt data-action-list d-md-inline-flex">
                            <a href="{{route('admin.articles')}}"  class="btn btn-auto btn-sm btn-primary">
                                <em class="fas fa-arrow-left"> </em><span>Back </span>
                            </a>
                        </div>
                    </div>

                    <hr />


                    <div class="card-head has-aside">
                        <div class="input-item input-with-label">
                            <label class="input-item-label">Entity Type</label>
                            <div class="input-wrap">
                                <select name="token_wallet_opt[]" class="select select-block select-bordered" value=""
                                    data-placeholder="Entity Type" multiple="multiple">
                                    @foreach ($entity_types as $key => $en)
                                        <option value="{{ $en->entity_type_name }}">{{ $en->entity_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-opt data-action-list d-md-inline-flex">
                            <a href="#" data-toggle="modal" data-target="#addArticle"
                                class="btn btn-auto btn-lg btn-primary pdl-4x pdr-4x">
                                <em class="fas fa-plus-circle"> </em><span>Add </span>
                            </a>
                        </div>
                    </div>
                    <div class="gaps-1x"></div>

                    @if (count($entity_types) > 0)
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Extn.</th>
                                    <th>E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger</td>
                                    <td>Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                    <td>5421</td>
                                    <td>t.nixon@datatables.net</td>
                                </tr>
                                <tr>
                                    <td>Garrett</td>
                                    <td>Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                    <td>8422</td>
                                    <td>g.winters@datatables.net</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        {{-- <div class="bg-light text-center rounded pdt-5x pdb-5x">
                            <p><em
                                    class="ti ti-server fs-24"></em><br>{{ $is_page == 'all' ? 'No investor / user found!' : 'No ' . $is_page . ' user here!' }}
                            </p>
                            <p><a class="btn btn-primary btn-auto" href="{{ route('admin.users', 'user') }}">View All
                                    Users</a></p>
                        </div> --}}
                    @endif


                </div>
            </div>{{-- .card --}}
        </div>{{-- .container --}}
    </div>{{-- .page-content --}}

@endsection

@section('modals')

    <div class="modal fade" id="addJurisdiction" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Add New Jurisdiction</h3>
                    <div class="gaps-1x"></div>
                    <form method="POST" class="adduser-form validate-modern" id="addJurisForm" autocomplete="false"
                        action="{{ route('admin.ajax.juris.add') }}">
                        @csrf
                        <div class="input-item input-with-label">
                            <label class="input-item-label">Jurisdiction</label>
                            <div class="input-wrap">
                                <input name="juris_name" class="input-bordered" required="required" type="text"
                                    placeholder="Add Jurisdiction">
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">Add Jurisdiction</button>
                    </form>
                </div>
            </div>
            {{-- .modal-content --}}
        </div>
        {{-- .modal-dialog --}}
    </div>

    <div class="modal fade" id="addArticle" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Add Article</h3>
                    <div class="gaps-1x"></div>
                    <form method="Post" class="adduser-form validate-modern" id="addArticletForm" autocomplete="false"
                        action="{{ route('admin.ajax.juris.edit') }}">
                        @csrf
                        <div class="input-item input-with-label">
                            <label class="input-item-label">Article Title</label>
                            <div class="input-wrap">
                                <input name="article_title" class="input-bordered" required="required" type="text"
                                    placeholder="Article Title">
                                <input name="article_id" type="hidden">
                            </div>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="input-item-label">Statue Type</label>
                            <div class="input-wrap">
                                <input name="statue_type" class="input-bordered" required="required" type="text"
                                    placeholder="Statue Type">
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">Add Article</button>
                    </form>
                </div>
            </div>
            {{-- .modal-content --}}
        </div>
        {{-- .modal-dialog --}}
    </div>

    <div class="modal fade" id="EmailUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Send Email to User </h3>
                    <div class="msg-box"></div>
                    <form class="validate-modern" id="emailToUser" action="{{ route('admin.ajax.users.email') }}"
                        method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Email Subject</label>
                            <div class="input-wrap">
                                <input type="text" name="subject" class="input-bordered cls" placeholder="New Message">
                            </div>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Email Greeting</label>
                            <div class="input-wrap">
                                <input type="text" name="greeting" class="input-bordered cls" placeholder="Hello User">
                            </div>
                        </div>
                        <div class="input-item input-with-label">
                            <label class="clear input-item-label">Your Message</label>
                            <div class="input-wrap">
                                <textarea required="required" name="message"
                                    class="input-bordered cls input-textarea input-textarea-sm" type="text"
                                    placeholder="Write something..."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </form>
                </div>
            </div>{{-- .modal-content --}}
        </div>{{-- .modal-dialog --}}
    </div>

@endsection

@push('footer')
    <link rel="stylesheet" href="{{ asset('assets/plugins/trumbowyg/ui/trumbowyg.min.css') }}?ver=1.0">
    <script src="{{ asset('assets/plugins/trumbowyg/trumbowyg.min.js') }}?ver=101"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        (function($) {
            if ($('.editor').length > 0) {
                $('.editor').trumbowyg({
                    autogrow: true
                });
            }
            var $_form = $('form#update_page');
            if ($_form.length > 0) {
                ajax_form_submit($_form, false);
            }

            $('#example').DataTable({
                "scrollX": true
            });
            $('#example_length').hide();
            $('#example_filter').hide();
        })(jQuery);

    </script>



@endpush
