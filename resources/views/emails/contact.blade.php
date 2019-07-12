@component('mail::message')
# Contact Message From {{ $data['first_name'] }} {{ $data['last_name'] }}

email of sender is: {{ $data['email'] }} <br>
{{ $data['message'] }}

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}
@endcomponent
