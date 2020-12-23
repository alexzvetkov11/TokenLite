@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])

            @php
                $lo= optional(\App\Models\Setting::where('field','site_logo')->first())->value;
            @endphp

            @if (isset($lo))
                <div class="page-ath-header">
                    <a class="page-ath-logo" href="'.url('/').'">
                        <img class="page-ath-logo-img" src="{{ asset("/images/sitelogo/$lo") }}" >
                    </a>
                </div>

            @else
                @if(site_whitelabel('admin'))
                    <img height="40" src="{{ site_whitelabel('logo-light') }}" srcset="{{ site_whitelabel('logo-light2x') }}" alt="{{ site_whitelabel('name') }}">
                @else
                    <svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 590 160" xml:space="preserve" height="40"><path d="m134.5 36.8-57.5-33.3c-3.5-2-7.8-2-11.3 0l-57.4 33.3c-3.5 2-5.6 5.8-5.6 9.8v66.7c0 4.1 2.2 7.8 5.6 9.8l57.4 33.3c1.7 1 3.7 1.5 5.6 1.5s3.9-0.5 5.6-1.5l57.4-33.3c3.5-2 5.6-5.8 5.6-9.8v-66.6c0.2-4.1-1.9-7.8-5.4-9.9zm-4.1 9.8v54.5h-24.5l10.8-63.6 12.7 7.4c0.6 0.4 1 1 1 1.7zm-35.9 62.3h35.8v4.4c0 0.2 0 0.3-0.1 0.5h-41l0.8-4.4 13.3-79.6 4 2.3-12.8 76.8zm-83.1 4.5v-56.4h32.9l-12.3 69.5-19.7-11.4c-0.5-0.4-0.9-1-0.9-1.7zm60.5 35.1c-0.6 0.3-1.3 0.3-1.9 0l-16.4-9.5 14.4-82h21.7l1.4-7.8h-32.1l-14.7 84.4-4.1-2.4 14.3-82.1h-43.1v-2.6c0-0.7 0.4-1.3 1-1.7l1.1-0.7h78.3l1.3-7.8h-66.1l42.9-24.9c0.3-0.2 0.6-0.3 1-0.3 0.3 0 0.7 0.1 1 0.3l23.3 13.5-16.4 96.6h39.2l-46.1 27z" fill="{{ style_theme('admin-color', 0) }}"/><path d="m167.4 62.9v-10h44.5v10h-16.3v44.3h-11.9v-44.3h-16.3zm52.1 6.1c1.2-3.5 3-6.5 5.2-9.1 2.3-2.6 5.1-4.6 8.4-6.1s7.1-2.2 11.2-2.2c4.2 0 8 0.7 11.3 2.2s6.1 3.5 8.4 6.1 4 5.6 5.2 9.1 1.8 7.2 1.8 11.3c0 4-0.6 7.6-1.8 11.1-1.2 3.4-3 6.4-5.2 8.9-2.3 2.5-5.1 4.5-8.4 6-3.3 1.4-7 2.2-11.3 2.2-4.2 0-7.9-0.7-11.2-2.2-3.3-1.4-6.1-3.4-8.4-6-2.3-2.5-4-5.5-5.2-8.9s-1.8-7.1-1.8-11.1c0-4.1 0.6-7.9 1.8-11.3zm10.9 17.9c0.5 2.2 1.4 4.1 2.5 5.8 1.2 1.7 2.7 3.1 4.6 4.1s4.2 1.6 6.8 1.6c2.7 0 5-0.5 6.8-1.6 1.9-1 3.4-2.4 4.6-4.1s2-3.7 2.5-5.8c0.5-2.2 0.8-4.4 0.8-6.7 0-2.4-0.3-4.7-0.8-6.9s-1.4-4.2-2.5-6c-1.2-1.7-2.7-3.1-4.6-4.2-1.9-1-4.2-1.6-6.8-1.6-2.7 0-5 0.5-6.8 1.6-1.9 1-3.4 2.4-4.6 4.2-1.2 1.7-2 3.7-2.5 6-0.5 2.2-0.8 4.5-0.8 6.9 0 2.3 0.3 4.6 0.8 6.7zm62.7-34v22.5l21.2-22.5h14.9l-21.2 21.4 23.3 32.9h-15l-16.4-24.4-6.8 6.9v17.5h-11.9v-54.3h11.9zm47 21.7h29.3v9.3h-29.3v-9.3zm0-21.7h29.3v10h-29.3v-10zm0 44.2h29.3v10h-29.3v-10zm51.1-44.2 22.7 36.4h0.2v-36.4h11.2v54.3h-11.9l-22.6-36.4h-0.2v36.4h-11.2v-54.3h11.8z" fill="#fff"/><path d="m445.5 52.9v48.2h28.7v6.1h-36v-54.3h7.3zm44.5 0v54.3h-7.2v-54.3h7.2zm8.3 6.1v-6.1h43.4v6.1h-18.1v48.2h-7.2v-48.2h-18.1zm88.8-6.1v6.1h-30.3v17.3h28.2v6.1h-28.2v18.8h30.5v6.1h-37.7v-54.4h37.5z" fill="#E1E1EB"/></svg>
                @endif
            @endif


{{--            @if(! empty(site_logo('mail')))--}}
{{--            <img height="50" src="{{ site_logo('mail') }}" alt="{{ site_info('name') }}">--}}
{{--            @else--}}
{{--            {{ config('settings.site_name', config('app.name', 'Mercer Worth')) }}--}}
{{--            @endif--}}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            Copyright &copy; {{ date('Y') }} {{ config('settings.site_name', config('app.name', 'Mercer Worth')) }}. {{ get_setting('site_copyright', 'All Rights Reserved.') }}
        @endcomponent
    @endslot
@endcomponent
