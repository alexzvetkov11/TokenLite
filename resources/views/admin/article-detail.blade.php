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
                        <div style="font-size:1.29em; color:#342d6e"> <b>Articles > {{ $article->article_label }} ></b>
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
                        <div class="input-item input-with-label col-md-4">
                            <label class="input-item-label">Entity Type</label>
                            <div class="input-wrap">
                                <select name="token_wallet_opt[]" class="select select-block select-bordered" value=""
                                    data-placeholder="Entity Type" multiple="multiple">
                                    @foreach ($entity_types as $key => $en)
                                        <option value="{{ $en->entity_type_id }}">{{ $en->entity_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-opt data-action-list d-md-inline-flex">
                            <a href="#" data-toggle="modal" data-target="#editArticle" 
                            class="btn btn-auto btn-lg btn-primary pdl-4x pdr-4x" data-selector="empty">
                                <em class="fas fa-plus-circle"> </em><span>Add </span>
                            </a>
                        </div>
                    </div>
                    <div class="gaps-1x"></div>

                    @if (count($contents) > 0)
                        <table id="example" class="display text-center wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    @foreach( $entity_types as $en)
                                    <th style="word-wrap: break-word;">
                                        {{ $en->entity_type_name .' ('. $en->jurisdiction_name.')'}}
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for( $i=1; $i<=$section_num; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    @foreach( $entity_types as $en)
                                        <td class="text-center">
                                            @php
                                                $flag=false;
                                                foreach($contents as $content){
                                                    if ($content->section == $i && $content->entity_types==$en->entity_type_id){
                                                        $flag = true; break;
                                                    }
                                                }
                                            @endphp

                                            @if( $flag==true)
                                            <a href="#" name="articleEdit" data-toggle="modal" data-target="#editArticle" data-selector="content-{{$i}}-{{$en->entity_type_id}}"
                                                class="btn btn-auto btn-sm btn-info pdl-4x pdr-4x">
                                                    Edit
                                            </a>
                                            <input type="hidden" id="content-{{$i}}-{{$en->entity_type_id}}" value="{{ $content->text }}">
                                            @else
                                            <a href="#" data-toggle="modal" data-target="#editArticle" style="opacity: 0.6" data-selector="content-{{$i}}-{{$en->entity_type_id}}"
                                                class="btn btn-auto btn-sm btn-info pdl-4x pdr-4x">
                                                    Add
                                            </a>
                                            <input type="hidden" id="content-{{$i}}-{{$en->entity_type_id}}" value="null">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    @else
                        <div class="bg-light text-center rounded pdt-5x pdb-5x">
                            <p><em class="ti ti-server fs-24"></em><br>No investor / user found!  user here! </p>
                            <p><a class="btn btn-primary btn-auto" href="{{ route('admin.users', 'user') }}">View All
                                    Users
                                </a>
                            </p>
                        </div>
                    @endif
                    <div class="gaps-3x"></div>
                    <button class="btn btn-md btn-primary" type="submit">
                        <i class="ti ti-reload"></i><span>Update</span>
                    </button>
                    <div class="gaps-3x"></div>
                </div>
            </div>{{-- .card --}}
        </div>{{-- .container --}}
    </div>{{-- .page-content --}}

@endsection

@section('modals')
    {{-- <div class="modal fade" id="addArticle" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Add Article</h3>
                    <div class="gaps-1x"></div>
                    <form method="Post" class="adduser-form validate-modern" id="addArticleForm" autocomplete="false"
                        action="{{ route('admin.ajax.juris.edit') }}">
                        @csrf
                       
                        <div class="input-item input-with-label">
                            <label class="input-item-label">Select Entity Type</label>
                            <div class="input-wrap">
                                <select name="token_wallet_opt[]" class="select select-block select-bordered" value="" data-placeholder="Entity Type">
                                    @foreach ($entity_types as $key => $en)
                                        <option value="{{ $en->entity_type_name }}">{{ $en->entity_type_name .' ('. $en->jurisdiction_name .')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-item  input-with-label">
                            <label for="textAdd" class="input-item-label">Article Content</label>
                            <div class="input-wrap">
                                <textarea id="textAdd" name="textAdd" class="input-bordered input-textarea editor" ></textarea>
                                <input type="hidden" id="textAddHide" name="textAddHide" value="">
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">Add Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="editArticle" tabindex="-1">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="popup-body popup-body-md">
                    <h3 class="popup-title">Edit Article</h3>
                    {{-- <div class="gaps-1x"></div> --}}
                    <hr/>
                    <form method="Post" class="adduser-form validate-modern" id="editArticleForm" autocomplete="false"
                        action="{{ route('admin.ajax.article.edit') }}">
                        @csrf
                        {{-- <h4> Article Title: {{ $article->article_label }}</h4> --}}
                        <div class="input-item input-with-label" id="entityAll">
                            <label class="input-item-label">Select Entity Type</label>
                            <div class="input-wrap">
                                <select name="entityAll" class="select select-block select-bordered" value="" data-placeholder="Entity Type">
                                    @foreach ($entity_types as $en)
                                        <option value="{{ $en->entity_type_id }}">{{ $en->entity_type_name .' ('. $en->jurisdiction_name .')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-item input-with-label" id="articleAll">
                            <label class="input-item-label">Article Type</label>
                            <div class="input-wrap">
                                <select name="articleAll" class="select select-block select-bordered" value="" data-placeholder="Article Type">
                                    @foreach ($articlesAll as $ar)
                                        <option value="{{ $ar->id }}">{{ $ar->article_label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input name="type" id="type" value="" type="hidden">
                        <input name="articleId" type="hidden" value="{{ $article->id}}" >
                        <div class="input-item  input-with-label">

                            <label for="textEdit" class="input-item-label">Article Content</label>
                            <div class="input-wrap">
                                <textarea id="textEdit" name="textEdit" class="input-bordered input-textarea editor" ></textarea>
                                <input type="hidden" id="textEditHide" name="textEditHide" value="">
                            </div>
                        </div>
                        <div class="gaps-1x"></div>
                        <button class="btn btn-md btn-primary" type="submit">Edit Article</button>
                    </form>
                </div>
            </div>
        </div>
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
                    autogrow: true,
                    changeActiveDropdownIcon: true,
                    autogrowOnEnter: true,
                    fullscreen: false,
                });
            }
            // var $_form = $('form#editArticleForm');
            // if ($_form.length > 0) {
            //     ajax_form_submit($_form, false);
            // }

            $('#example').DataTable({
                "scrollX":      true,
                // "scrollY":      200,
                "scrollCollapse": true,
                "ordering":     false,
                "searching":    false,
                "paging":       true,
                "info":         true,
                "deferRender":  true,
                // "data":         dataList,
                // "autoWidth":    false,
            });

            $('#example_length').hide();
        })(jQuery);

    </script>



@endpush
