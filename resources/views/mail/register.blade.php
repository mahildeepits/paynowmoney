@component('mail::message')
<h2>Hello {{ $userModel->name }},</h2>

<p>{{ $message }}</p>

<table>
    <tr>
        <td>User ID:</td>
        <td>{{ $userModel->member_id }}</td>
    </tr>
    <tr>
        <td>{{ $dynamic_title }}:</td>
        <td>{{ $dynamic_value }}</td>
    </tr>
</table>

@if ($coupon_code !== null)
    <p align="center">Please login to your account</p>
    @component('mail::button', ['url' => url(env('APP_URL') . '/member/login')])
        Login Now
    @endcomponent
@endif

Thanks,  
{{ config('app.name') }}

<p align="center">
    <img src="{{ asset('images/54.png') }}" alt="{{ config('app.name') }}">
</p>
@endcomponent
