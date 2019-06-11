@extends('userpanel.app')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <form  action="{{route('ingvar.support.tickets.user_store')}}" method="post">
                {{ csrf_field() }}
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <b>{{trans('igs::support.new_ticket')}}</b>

                </div>
                <div class="card-body">

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="text-input">{{trans('igs::support.subject')}}</label>
                            <div class="col-md-9">
                                <input class="form-control" id="text-input" type="text" name="subject" placeholder="{{trans('igs::support.subject')}}" value="{{old('subject')}}">
                                <span class="help-block">{{trans('igs::support.subject_help')}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="textarea-input">{{trans('igs::support.message')}}</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="textarea-input" name="message" rows="9" placeholder="{{trans('igs::support.message')}}">{{old('message')}}</textarea>
                                <span class="help-block">{{trans('igs::support.message_help')}}</span>
                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button class="btn btn-block btn-outline-success" type="submit">{{trans('igs::support.send')}}</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection