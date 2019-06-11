@extends('userpanel.app')
@section('content')
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }
        .card-body {
            overflow-y: scroll;
            height: 400px;
        }
        .chat .text-muted {
            color: #20a8d8 !important;
        }


        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon {
            margin-right: 5px;
        }

        .panel-body {
            overflow-y: scroll;
            height: 250px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

    </style>

    <div class="col-md-12">
        <form action="{{route('ingvar.support.tickets.user_update',['id'=>$ticket->id])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <b>{{$ticket->subject}}</b>
                </div>
                <div class="card-body">
                    <ul class="chat">
                        @foreach($messages as $message)

                            @if($message->user->id != $ticket->user_id)
                                <li class="left clearfix">

                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{$message->user->name}} {{$message->user->surname}}</strong>
                                        <small class="pull-right text-muted">{{$message->created_at->diffForHumans()}}</small>
                                    </div>
                                    <p>{!! $message->message !!}</p>
                                </div>
                            @else
                             <li class="right clearfix">

                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">{{$message->created_at->diffForHumans()}}</small>
                                        <strong class="pull-right primary-font">{{$message->user->name}} {{$message->user->surname}}</strong>
                                    </div>
                                    <p>{!! $message->message !!}</p>
                                </div>
                            </li>

                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input class="form-control" id="input2-group2" type="text" name="message"
                               placeholder="{{trans('igs::support.message')}}">
                        <span class="input-group-append">
                              <button class="btn btn-primary" type="submit">{{trans('igs::support.send')}}</button>
                            </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection