@component('mail::message')
# This is a test email

We sent you this email in purpose of testing our mailing system.

### Congrats it's working....!

Regards,<br>
{{ getSetting('app_name') }}.
@endcomponent
