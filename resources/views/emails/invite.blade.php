{!! $header !!}

Hello Sir/Mam,<br><br>

I want to invite you to make a proposal for my project.<br><br>

For the further information, please click the invitation below.<br><br>


<a href="{{ route('jobDetail', $slug) }}">Link</a> <br><br>


Thanks in advance,<br>
{{ $employer->first_name}} {{ $employer->last_name}}


{!! $footer !!}