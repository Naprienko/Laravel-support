@extends('userpanel.app')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i>
            <b>{{trans('igs::support.all_tickets')}}</b>
            <a class="btn btn-sm btn-outline-secondary" href="{{route('ingvar.support.tickets.user_create')}}">{{trans('igs::support.new')}}</a>
        </div>
        <div class="card-body">

            @if($tickets->count()> 0)
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{trans('igs::support.subject')}}</th>
                        <th>{{trans('igs::support.updated_at')}}</th>
                        <th>{{trans('igs::support.inbox')}}</th>
                        <th width="50"></th>
                        <th width="50"></th>
                        <th width="50"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{$ticket->subject}}</td>
                            <td>{{$ticket->updated_at}}</td>

                            <td>
                                <span class="badge badge-success">{{$ticket->outbox}}</span>
                            </td>

                            <td><a href="{{route('ingvar.support.tickets.user_edit', ['id' => $ticket->id])}}" class="btn  btn-sm btn-block btn-outline-success">{{trans('igb::blog.edit')}}</a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <nav aria-label="...">
                    <div class="pagination">
                        {{ $tickets->links("pagination::bootstrap-4") }}
                    </div>
                </nav>
            @else
                <h5>{{trans('igs::support.no_results')}}</h5>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
