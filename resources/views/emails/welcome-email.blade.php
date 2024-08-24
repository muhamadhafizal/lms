@component('mail::message')
<h1 class="text-main">Welcome to {{ config('app.name') }}</h1>

<br>
<p>
Hi {{ $user_name ?? '-' }},
</p>
<br>

<p>You have been added in
{{ config('app.name') }}. You can now login to your account using credentials below:</p>
<br>

<p>
<b>Email</b>: {{ $user_email ?? '-' }}<br>
<b>Temporary Password</b>: {{ $password ?? '-' }}
</p>
<br>

<p>
Please update your password after you have login to the system. Thank you
</p>
<br>

@component('mail::button', ['url' => config('app.url'), 'color' => 'main'])
Login Now
@endcomponent

<p class="text-center">
{{ config('app.name') }}
</p>
@endcomponent
