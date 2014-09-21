@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'ressource/update/'.$data->id, 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal'))}}    
        <div class="form-group">
            {{Form::label('medium', trans('messages.Storage Medium'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                {{Form::text('medium', $data->name, array('placeholder'=>trans('messages.Medium'), 'required'=>'required', 'maxlength'=>50));}}
            </div>
        </div>
        {{Form::submit(trans('messages.update'), array('class' => 'btn btn-default'));}}
    {{Form::close()}}
@stop