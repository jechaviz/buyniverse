{!! $header !!}
Hello Sir/Mam,<br><br>

I want to invite you to approve changes on my project ({{ $job->title }}).<br><br>

For the further information, please click the invitation below.<br><br>


<a href="{{{ url('/job/approval/'.$job->slug) }}}">Link</a> <br><br>


Thanks in advance,<br><br>



{!! $footer !!}

