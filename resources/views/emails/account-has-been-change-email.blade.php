<x-mail::message>
# Hello there!

Your Account has been change by the administrator, below are your new default password/username. 

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
