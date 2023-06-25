<x-mail::message>
# Hello there!

A new account has been created for you, you can now access and update your profile in CES Online Website using your email and your default password below. Also please take note of your auto generated username. 

### Default Password:
<x-mail::panel>
{{ $default_password }}
</x-mail::panel>

### Username:
<x-mail::panel>
{{ $generated_username }}
</x-mail::panel>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
