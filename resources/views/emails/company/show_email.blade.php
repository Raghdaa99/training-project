@component('mail::message')
# Al-Aqsa University

Application for approval of field training students from Al-Aqsa University


@component('mail::button', ['url' => $url])
Continue
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
