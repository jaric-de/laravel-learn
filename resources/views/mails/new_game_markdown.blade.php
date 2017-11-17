@component('mail::message')
    Welcome, {{ $user->name }}.
    You have already created the new game '{{ $title }}'.

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
