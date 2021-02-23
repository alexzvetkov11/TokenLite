<!DOCTYPE html>
@php
    use App\Models\Setting;
$language=Setting::where('field',auth()->id())->first();

@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) /*$language?$language->value:'en'*/ }}" class="js">

<head>
    <meta charset="utf-8">
    <meta name="apps" content="{{ site_whitelabel('apps') }}">
    <meta name="author" content="{{ site_whitelabel('author') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-token" content="{{ site_token() }}">
    <link rel="shortcut icon" href="{{ site_favicon() }}">
    <title>@yield('title') | {{ site_whitelabel('title') }}</title>
    <link rel="stylesheet" href="{{ asset(style_theme('vendor')) }}">
    <link rel="stylesheet" href="{{ asset(style_theme('user')) }}">

    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/selectize.default.css') }}">
    <style>
        label.required::after {
            content: " *";
            color: red;
        }

        .clipboard {
            text-align: center;
            cursor: pointer;
            outline: none;
            color: rgb(255, 255, 255);
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            box-shadow: 0 9px #999;
        }

        .clipboard:hover {background-color: #3e8e41}

        .clipboard:active {
            background-color: #3e8e41;
            box-shadow: 0 5px rgb(185, 185, 185);
            transform: translateY(4px);
        }
        .selectize-input{
            line-height:1.7;
        }
    </style>
    @stack('header')
@if(get_setting('site_header_code', false))
    {{ html_string(get_setting('site_header_code')) }}
@endif
</head>
<style>
    .navbar-menu{
        align-items: center;
        display: contents;
    }
</style>
<body class="user-dashboard page-user theme-modern">
    <div class="topbar-wrap">
        <div class="topbar is-sticky">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="topbar-nav d-lg-none">
                        <li class="topbar-nav-item relative">
                            <a class="toggle-nav" href="#">
                                <div class="toggle-icon">
                                    <span class="toggle-line"></span>
                                    <span class="toggle-line"></span>
                                    <span class="toggle-line"></span>
                                    <span class="toggle-line"></span>
                                </div>
                            </a>
                        </li>{{-- .topbar-nav-item --}}
                    </ul>{{-- .topbar-nav --}}
                    @php
                    $lo= optional(\App\Models\Setting::where('field','site_logo')->first())->value;
                    @endphp

                    @if (isset($lo))
                        <img height="40" src="{{ asset("/images/sitelogo/$lo") }}" >

                    @else
                        @if(site_whitelabel('admin'))
                            <img height="40" src="{{ site_whitelabel('logo-light') }}" srcset="{{ site_whitelabel('logo-light2x') }}" alt="{{ site_whitelabel('name') }}">
                        @else
                            <svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 590 160" xml:space="preserve" height="40"><path d="m134.5 36.8-57.5-33.3c-3.5-2-7.8-2-11.3 0l-57.4 33.3c-3.5 2-5.6 5.8-5.6 9.8v66.7c0 4.1 2.2 7.8 5.6 9.8l57.4 33.3c1.7 1 3.7 1.5 5.6 1.5s3.9-0.5 5.6-1.5l57.4-33.3c3.5-2 5.6-5.8 5.6-9.8v-66.6c0.2-4.1-1.9-7.8-5.4-9.9zm-4.1 9.8v54.5h-24.5l10.8-63.6 12.7 7.4c0.6 0.4 1 1 1 1.7zm-35.9 62.3h35.8v4.4c0 0.2 0 0.3-0.1 0.5h-41l0.8-4.4 13.3-79.6 4 2.3-12.8 76.8zm-83.1 4.5v-56.4h32.9l-12.3 69.5-19.7-11.4c-0.5-0.4-0.9-1-0.9-1.7zm60.5 35.1c-0.6 0.3-1.3 0.3-1.9 0l-16.4-9.5 14.4-82h21.7l1.4-7.8h-32.1l-14.7 84.4-4.1-2.4 14.3-82.1h-43.1v-2.6c0-0.7 0.4-1.3 1-1.7l1.1-0.7h78.3l1.3-7.8h-66.1l42.9-24.9c0.3-0.2 0.6-0.3 1-0.3 0.3 0 0.7 0.1 1 0.3l23.3 13.5-16.4 96.6h39.2l-46.1 27z" fill="{{ style_theme('admin-color', 0) }}"/><path d="m167.4 62.9v-10h44.5v10h-16.3v44.3h-11.9v-44.3h-16.3zm52.1 6.1c1.2-3.5 3-6.5 5.2-9.1 2.3-2.6 5.1-4.6 8.4-6.1s7.1-2.2 11.2-2.2c4.2 0 8 0.7 11.3 2.2s6.1 3.5 8.4 6.1 4 5.6 5.2 9.1 1.8 7.2 1.8 11.3c0 4-0.6 7.6-1.8 11.1-1.2 3.4-3 6.4-5.2 8.9-2.3 2.5-5.1 4.5-8.4 6-3.3 1.4-7 2.2-11.3 2.2-4.2 0-7.9-0.7-11.2-2.2-3.3-1.4-6.1-3.4-8.4-6-2.3-2.5-4-5.5-5.2-8.9s-1.8-7.1-1.8-11.1c0-4.1 0.6-7.9 1.8-11.3zm10.9 17.9c0.5 2.2 1.4 4.1 2.5 5.8 1.2 1.7 2.7 3.1 4.6 4.1s4.2 1.6 6.8 1.6c2.7 0 5-0.5 6.8-1.6 1.9-1 3.4-2.4 4.6-4.1s2-3.7 2.5-5.8c0.5-2.2 0.8-4.4 0.8-6.7 0-2.4-0.3-4.7-0.8-6.9s-1.4-4.2-2.5-6c-1.2-1.7-2.7-3.1-4.6-4.2-1.9-1-4.2-1.6-6.8-1.6-2.7 0-5 0.5-6.8 1.6-1.9 1-3.4 2.4-4.6 4.2-1.2 1.7-2 3.7-2.5 6-0.5 2.2-0.8 4.5-0.8 6.9 0 2.3 0.3 4.6 0.8 6.7zm62.7-34v22.5l21.2-22.5h14.9l-21.2 21.4 23.3 32.9h-15l-16.4-24.4-6.8 6.9v17.5h-11.9v-54.3h11.9zm47 21.7h29.3v9.3h-29.3v-9.3zm0-21.7h29.3v10h-29.3v-10zm0 44.2h29.3v10h-29.3v-10zm51.1-44.2 22.7 36.4h0.2v-36.4h11.2v54.3h-11.9l-22.6-36.4h-0.2v36.4h-11.2v-54.3h11.8z" fill="#fff"/><path d="m445.5 52.9v48.2h28.7v6.1h-36v-54.3h7.3zm44.5 0v54.3h-7.2v-54.3h7.2zm8.3 6.1v-6.1h43.4v6.1h-18.1v48.2h-7.2v-48.2h-18.1zm88.8-6.1v6.1h-30.3v17.3h28.2v6.1h-28.2v18.8h30.5v6.1h-37.7v-54.4h37.5z" fill="#E1E1EB"/></svg>
                        @endif
                    @endif

                   {{-- <a class="topbar-logo" href="{{ url('/') }}">
                        <img height="40" src="{{ site_whitelabel('logo-light') }}" srcset="{{ site_whitelabel('logo-light2x') }}" alt="{{ site_whitelabel('name') }}">
                    </a>--}}
                    <ul class="topbar-nav">
                        <li class="topbar-nav-item relative">
                            <span class="user-welcome d-none d-lg-inline-block">{{__('Welcome!')}} {{ auth()->user()->name }}</span>
                            <a class="toggle-tigger user-thumb" href="#"><em class="ti ti-user"></em></a>
                            <div class="toggle-class dropdown-content dropdown-content-right dropdown-arrow-right user-dropdown">
                                {!! UserPanel::user_balance() !!}
                                {!! UserPanel::user_menu_links() !!}
                                {!! UserPanel::user_logout_link() !!}
                            </div>
                        </li>{{-- .topbar-nav-item --}}
                    </ul>{{-- .topbar-nav --}}
                </div>
            </div>{{-- .container --}}
        </div>{{-- .topbar --}}

        <div class="navbar">
            <div class="container-fluid">
                <div class="container navbar-innr">
                    <ul class="navbar-menu" id="main-nav">
                        <li style="padding:0 0;"><a href="{{ route('user.home') }}"><em class="ikon ikon-dashboard"></em> {{__('Dashboard')}}</a></li>


                        <li class="has-dropdown"><a class="drop-toggle" href="javascript:void(0)"><em class="ikon ikon-user"></em> {{__('Profile')}}</a>
                            <ul class="navbar-dropdown">
                                <li><a href="{{  route('user.account') }}">{{__("Account Details") }}</a></li>
                                <li><a href="{{ route('user.compliance') }}">{{__("Compliance") }}</a></li>
                            </ul>
                        </li>

                        <li style="padding:0 0;"><a href="{{ route('user.entities') }}"><em class="ikon ikon-user"></em> {{__('Entities')}}</a></li>
                        <li style="padding:0 0;"><a href="#"><em class="ikon ikon-user"></em> {{__('Balances&Holdings')}}</a></li>
                        <li style="padding:0 0;"><a href="#"><em class="ikon ikon-user"></em> {{__('CorporateActions')}}</a></li>
                        <li style="padding:0 0;"><a href="#"><em class="ikon ikon-user"></em> {{__('Announcements')}}</a></li>
                        <li style="padding:0 0;"><a href="{{ route('user.transactions') }}"><em class="ikon ikon-transactions"></em> {{__('Transactions')}}</a></li>
                        <li style="padding:0 0;"><a href="#"><em class="ikon ikon-user"></em> {{__('Messages')}}</a></li>
                        <li style="padding:0 0;"><a href="#"><em class="ikon ikon-user"></em> {{__('Funding')}}</a></li>
                        <li style="padding:0 0;"><a href="#"><em class="ikon ikon-user"></em> {{__('Support')}}</a></li>

                        {{--                        <li><a href="{{ route('user.token') }}"><em class="ikon ikon-coins"></em> {{__('Buy Token')}}</a></li>--}}
                        {{--@if(get_page('distribution', 'status') == 'active')
                        <li><a href="{{ route('public.pages', 'distribution') }}"><em class="ikon ikon-distribution"></em> {{ get_page('distribution', 'title') }}</a></li>
                        @endif--}}
                        @if(nio_module()->has('Withdraw') && has_route('withdraw:user.index'))
                        <li {!! ((is_page('withdraw'))? ' class="active"' : '') !!}>
                            <a href="{{ route('withdraw:user.index') }}"><em class="ikon ikon-wallet"></em> Withdraw</a>
                        </li>
                        @endif
                        @if(gws('user_mytoken_page') == 1)
{{--                        <li><a href="{{ route('user.token.balance') }}"><em class="ikon ikon-my-token"></em> {{ __('My Token') }}</a></li>--}}
                        @endif
                        @if(gws('main_website_url') != NULL)
                        <li><a href="{{gws('main_website_url')}}" target="_blank"><em class="ikon ikon-home-link"></em> {{__('Main Site')}}</a></li>
                        @endif
                    </ul>
{{--                    @if(!is_kyc_hide())--}}
{{--                    <ul class="navbar-btns">--}}
{{--                        @if(isset(Auth::user()->kyc_info->status) && Auth::user()->kyc_info->status == 'approved')--}}
{{--                        <li><span class="badge badge-outline badge-success badge-lg"><em class="text-success ti ti-files mgr-1x"></em><span class="text-success">{{__('KYC Approved')}}</span></span></li>--}}
{{--                        @else--}}
{{--                        <li><a href="{{ route('user.kyc') }}" class="btn btn-sm btn-outline btn-light"><em class="text-primary ti ti-files"></em><span>{{__('KYC Application')}}</span></a></li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                    @endif--}}
                </div>{{-- .navbar-innr --}}
            </div>{{-- .container --}}
        </div>{{-- .navbar --}}
    </div>{{-- .topbar-wrap --}}

    <div class="page-content">
        <div class="container">
            <div class="row">
                @php


                /*$has_sidebar = isset($has_sidebar) ? $has_sidebar : false;*/
                $has_sidebar = false;
                $col_side_cls = ($has_sidebar) ? 'col-lg-4' : 'col-lg-12';
                $col_cont_cls = ($has_sidebar) ? 'col-lg-8' : 'col-lg-12';
                $col_cont_cls2 = isset($content_class) ? css_class($content_class) : null;
                $col_side_cls2 = isset($aside_class) ? css_class($aside_class) : null;
                @endphp

                <div class="main-content {{ empty($col_cont_cls2) ? $col_cont_cls : $col_cont_cls2 }}">
                    @if(!has_wallet() && gws('token_wallet_req')==1 && !empty(token_wallet()))
                    <div class="d-lg-none">
                        {!! UserPanel::add_wallet_alert() !!}
                    </div>
                    @endif
{{--                        {{App::setLocale('zh')}}--}}
                    @yield('content')
                </div>

                @if ($has_sidebar==true)
                <div class="aside sidebar-right {{ empty($col_side_cls2) ? $col_side_cls : $col_side_cls2 }}">
                    @if(!has_wallet() && gws('token_wallet_req')==1 && !empty(token_wallet()))
                    <div class="d-none d-lg-block">
                        {!! UserPanel::add_wallet_alert() !!}
                    </div>
                    @endif
                    <div class="account-info card">
                        <div class="card-innr">
                            {!! UserPanel::user_account_status() !!}
                            @if(!empty(token_wallet()))
                            <div class="gaps-2-5x"></div>
                            {!! UserPanel::user_account_wallet() !!}
                            @endif
                        </div>
                    </div>
                    {!! (!is_page(get_slug('referral')) ? UserPanel::user_referral_info('') : '') !!}
                    {!! UserPanel::user_kyc_info('') !!}
                </div> .col
                @else
                    @stack('sidebar')
                @endif

            </div>
        </div>{{-- .container --}}
    </div>{{-- .page-content --}}

    <div class="footer-bar">
        <div class="container">
            @if(is_show_social('site'))
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center order-lg-last text-lg-right pdb-2x pb-lg-0">
                    {!! UserPanel::social_links() !!}
                </div>
                <div class="col-lg-7">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start guttar-15px pdb-1-5x pb-lg-2">
                        {!! UserPanel::copyrights('div') !!}
                        {!! UserPanel::language_switcher() !!}
                    </div>
                    {!! UserPanel::footer_links(null, ['class'=>'align-items-center justify-content-center justify-content-lg-start']) !!}
                </div>
            </div>{{-- .row --}}
            @else
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    {!! UserPanel::footer_links(null, ['class'=>'guttar-20px']) !!}
                </div>
                <div class="col-lg-5 mt-2 mt-sm-0">
                    <div class="d-flex justify-content-between justify-content-lg-end align-items-center guttar-15px">
                        {!! UserPanel::copyrights('div') !!}
                        {!! UserPanel::language_switcher() !!}
                    </div>
                </div>
            </div>{{-- .row --}}
            @endif
        </div>{{-- .container --}}
    </div>{{-- .footer-bar --}}
    @yield('modals')
    <div id="ajax-modal"></div>
    <div class="page-overlay">
        <div class="spinner"><span class="sp sp1"></span><span class="sp sp2"></span><span class="sp sp3"></span></div>
    </div>

@if(gws('theme_custom'))
    <link rel="stylesheet" href="{{ asset(style_theme('custom')) }}">
@endif
    <script>
        var base_url = "{{ url('/') }}",
        {!! (has_route('transfer:user.send')) ? 'user_token_send = "'.route('transfer:user.send').'",' : '' !!}
        {!! (has_route('withdraw:user.request')) ? 'user_token_withdraw = "'.route('withdraw:user.request').'",' : '' !!}
        {!! (has_route('user.ajax.account.wallet')) ? 'user_wallet_address = "'.route('user.ajax.account.wallet').'",' : '' !!}
        csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    <script src="{{ asset('assets/js/jquery.bundle.js').css_js_ver() }}"></script>
    <script src="{{ asset('assets/js/script.js').css_js_ver() }}"></script>
    <script src="{{ asset('assets/js/app.js').css_js_ver() }}"></script>
    <script src="{{ asset('assets/js/custom_client.js').css_js_ver() }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="{{ asset('assets/js/selectize.js').css_js_ver() }}"></script>

    @stack('footer')
    <script type="text/javascript">
        @if (session('resent'))
        show_toast("success","{{ __('A fresh verification link has been sent to your email address.') }}");
        @endif
    </script>
    @if(get_setting('site_footer_code', false))


    {{ html_string(get_setting('site_footer_code')) }}
    @endif
</body>
</html>
