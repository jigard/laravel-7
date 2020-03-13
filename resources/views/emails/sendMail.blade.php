@component('mail::message')
# Introduction

The body of your message.

@component('mail::panel')
This is the panel content.
@endcomponent

@component('mail::table')
| Field A       | Field B       | Field C  |
| :------------- |:-------------:| --------:|
| Field A1      | Field B1      | Field C1 |
| Field A2      | Field B2      | Field C2 |
@endcomponent


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
