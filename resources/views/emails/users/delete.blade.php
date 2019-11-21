@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::promotion')
  The reason why you were removed is:
@endcomponent

@component('mail::subcopy')
  {{ $reason }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
