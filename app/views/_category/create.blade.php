@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'category/store', 'method' => 'post'))}}    
        <div class="form-group">
            {{Form::label('name', trans('messages.Category'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
               {{Form::text('name', null, array('placeholder'=>trans('messages.Category'), 'required'=>'required', 'maxlength'=>50));}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('show_artist', trans('messages.show artist'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                {{Form::select('show_artist', array('0' => trans('messages.no'), '1' => trans('messages.yes'))) }}
            </div>
        </div>
        {{Form::submit(trans('messages.create'), array('class' => 'btn btn-default'));}}
    {{Form::close()}}
@stop
