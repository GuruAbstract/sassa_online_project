@component('mail::message')

    @component('mail::panel')
        This is the panel content.
        # Introduction

        The body of your message.
    @endcomponent



@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
