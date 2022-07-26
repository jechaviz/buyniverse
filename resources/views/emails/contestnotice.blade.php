{!! $header !!}

Hello Sir/Mam,<br><br>

This is to inform you that we are starting the contest shortly on ({{ $job->title }}). Please join contest.<br><br>

For the further information, please click the invitation below.<br><br>


<a href="{{ route('showOnGoingJobDetail', $job->slug) }}">Link</a> <br><br>


Thanks in advance,<br>

{!! $footer !!}