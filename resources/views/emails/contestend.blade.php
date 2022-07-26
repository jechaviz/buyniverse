{!! $header !!}

Hello Sir/Mam,<br><br>

This is to inform you that the contest ({{ $job->title }}) is ended. We will shortly contact selected candidates.<br><br>

For the further information, please click the link below.<br><br>


<a href="{{ route('showOnGoingJobDetail', $job->slug) }}">Link</a> <br><br>


Thanks in advance,<br>

{!! $footer !!}