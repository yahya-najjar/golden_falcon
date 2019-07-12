@component('mail::message')
@if($data['status'] == 1)
# Regsitration Accepted

we glad to tell you that you'r registration on the Course: {{ $data['course'] }} was accepted.
@else
# Regsitration Declined

unfortunately you'r registration on the Course: {{ $data['course'] }} was Declined.
@endif

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
