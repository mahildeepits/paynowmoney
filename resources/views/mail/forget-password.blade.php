@component('mail::message')
    <h2>Hello {{$userModel->name}},</h2>
    <p>Welcome to the gold grocery shop, you are warm welcome to our family.
        <br/>
    <table>
        <tr>
            <td>User ID:</td>
            <td>{{ $userModel->member_id }} </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>{{ \Illuminate\Support\Facades\Crypt::decrypt($userModel->enc_password) }} </td>
        </tr>
    </table>
    </p>
    <br/>
    <p align="center">Please login your account</p>
    <p> @component('mail::button', ['url' => url('https://mlm-new.bmninfotech.in/member/login')])
            Login Now
        @endcomponent.</p>


    Thanks,<br>
    {{ config('app.name') }}<br>
    <p align="center"><img src="https://tremendousgold.com/wp-content/uploads/2022/10/gold.....logo_.png" alt="{{config('app.name')}}"></p>
@endcomponent
