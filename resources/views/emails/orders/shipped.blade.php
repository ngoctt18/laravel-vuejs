@component('mail::message')
# Introduction

The body of your message. {{$user->message}}

@component('mail::button', ['url' => '', 'color' => 'success'])
    View Order
@endcomponent

@component('mail::panel')
    This is the panel content.
@endcomponent

@component('mail::table')
    | Laravel       | Table          | Example          |
    | ------------- |:-------------: | --------:        |
    |{{$user->name}}|{{$user->email}}|{{$user->message}}|
    | Col 3 is      | Right-Aligned  | $20              |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
