@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'artist/store', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal'))}}
        <div class="form-group">
            {{Form::label('first_name', trans('messages.Given name/Article'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                {{Form::text('first_name', null, array('placeholder'=>trans('messages.Given name/Article'), 'maxlength'=>50));}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('last_name', trans('messages.Last Name/Group'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                {{Form::text('last_name', null, array('placeholder'=>trans('messages.Last Name/Group'), 'required'=>'required', 'maxlength'=>255));}}
            </div>
        </div>
        {{Form::submit(trans('messages.create'), array('class' => 'btn btn-default'));}}
    {{Form::close()}}
@stop