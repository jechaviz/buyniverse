{!! $header !!}
Hello {{ $user->first_name}},<br><br>

I want to invite you to make a changes on my project ({{ $job->title }}).<br><br>

For the further information, please click the invitation below.<br><br>


<a href="{{{ url('/proposal/'.$job->slug.'/'.$job->status) }}}">Link</a> <br><br>




Thanks in advance,<br><br>

Note : To login, please use your email and password is 'password'. Also, Please change your password upon login to secure your account.


{!! $footer !!}

