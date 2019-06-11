<h3>You have received an answer to ticket #</h3>
Message: {{$body}}
<br>
<a href="{{route('ingvar.support.tickets.user_edit', ['id' => $ticket_id])}}">see the link</a>
{{$user->email}}
