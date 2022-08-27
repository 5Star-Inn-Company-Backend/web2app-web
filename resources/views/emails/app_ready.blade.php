@component('mail::message')
# Hello there!

Your website has been converted to app as requested.
Find the attached files.

{{--@if($apk != "")--}}
{{--    @component('mail::button', ['url' => $apk])--}}
{{--    Download APK--}}
{{--    @endcomponent--}}
{{--@endif--}}

{{--@if($aab != "")--}}
{{--    @component('mail::button', ['url' => $aab])--}}
{{--    Download AAB--}}
{{--    @endcomponent--}}
{{--@endif--}}

{{--@if($ios != "")--}}
    @component('mail::button', ['url' => $ios])
    Download Runner.app.zip
    @endcomponent
{{--@endif--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
