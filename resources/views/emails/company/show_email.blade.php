@component('mail::message')
# HI Baby

The body of your message.


@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent