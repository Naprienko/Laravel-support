@extends('admin.app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i>
                <b>{{trans('igs::support.all_tickets')}}</b>

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

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{$ticket->subject}}</td>
                                <td>{{$ticket->updated_at}}</td>

                                <td>
                                    <span class="badge badge-success">{{$ticket->inbox}}</span>
                                </td>

                                <td><a href="{{route('ingvar.support.tickets.edit', ['id' => $ticket->id])}}" class="btn  btn-sm btn-block btn-outline-success">{{trans('igb::blog.edit')}}</a></td>
                                <td>
                                    <form method="post" action ="{{route('ingvar.support.tickets.destroy', ['id' => $ticket->id])}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn  btn-sm btn-block btn-outline-danger">{{trans('igs::support.delete')}}</button>
                                    </form>
                                </td>
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


