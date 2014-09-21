@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'genre/update/'.$data->id, 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal'))}}    
        <div class="form-group">
            {{Form::label('name', trans('messages.Genre'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                {{Form::text('name', $data->name, array('placeholder'=>trans('messages.Genre'), 'required'=>'required', 'maxlength'=>50));}}
            </div>
        </div>
        {{Form::submit(trans('messages.update'), array('class' => 'btn btn-default'));}}
    {{Form::close()}}
@stop