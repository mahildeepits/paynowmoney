@component('mail::message')
# Hello {{ $user->name }},

Your OTP code is **{{ $otp_code }}**.  

Please use this code to complete your action. The code is valid for **2 minutes**.

@component('mail::button', ['url' => url(env('APP_URL') . '/member/login')])
Login Now
@endcomponent

Thanks,  
{{ config('app.name') }}

<p align="center">
    <img src="{{ asset('images/54.png') }}" alt="{{ config('app.name') }}">
</p>
@endcomponent