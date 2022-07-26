{!! $header !!}
Hello Sir/Mam,<br><br>

I want to invite you to make a changes on my project ({{ $job->title }}).<br><br>

For the further information, please click the invitation below.<br><br>


<a href="{{ route('showOnGoingJobTeamDetail', $job->slug) }}">Link</a> <br><br>


Thanks in advance,<br><br>



{!! $footer !!}

