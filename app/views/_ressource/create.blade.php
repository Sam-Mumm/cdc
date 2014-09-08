@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'ressource/store', 'method' => 'post'))}}    
        <div class="grid">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('medium', 'Tontr&auml;ger:')}}
                </div>
                <div class="cell w80">
                    {{Form::text('medium', null, array('placeholder'=>'Medium', 'required'=>'required', 'maxlength'=>50));}}
                </div>
            </div>
        </div>
        {{Form::submit('Erstellen');}}
    {{Form::close()}}
@stop
