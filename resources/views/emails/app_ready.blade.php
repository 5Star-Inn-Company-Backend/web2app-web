@component('mail::message')
# Hello there!

Your website has been converted to app as requested.
Find the attached files.

@component('mail::button', ['url' => $apk])
Download APK
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
