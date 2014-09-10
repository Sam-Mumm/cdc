@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'ressource/update/'.$data->id, 'method' => 'post'))}}    
        <div class="grid">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('medium', 'Tontr&auml;ger:')}}
                </div>
                <div class="cell w80">
                    {{Form::text('medium', $data->name, array('placeholder'=>'Medium', 'required'=>'required', 'maxlength'=>50));}}
                </div>
            </div>
        </div>
        {{Form::submit('aktualisieren');}}
    {{Form::close()}}
@stop