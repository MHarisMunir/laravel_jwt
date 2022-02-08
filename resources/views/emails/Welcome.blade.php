@component('mail::message')
Hello! 

The body of your message.
Click the button below to verify your account.
@component('mail::button', ['url' => ''])
Verify now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
