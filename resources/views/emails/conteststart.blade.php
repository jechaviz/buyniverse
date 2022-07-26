{!! $header !!}

Hello Sir/Mam,<br><br>

This is to inform you that we have started the contest on ({{ $job->title }}). Please join contest.<br><br>

For the further information, please click the invitation below.<br><br>


<a href="{{ route('showOnGoingJobDetail', $job->slug) }}">Link</a> <br><br>


Thanks in advance,<br>

{!! $footer !!}