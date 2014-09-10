@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'genre/store', 'method' => 'post'))}}    
        <div class="grid">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('name', 'Genre:')}}
                </div>
                <div class="cell w80">
                    {{Form::text('name', null, array('placeholder'=>'Genrebezeichnung', 'required'=>'required', 'maxlength'=>50));}}
                </div>
            </div>
        </div>
        {{Form::submit('erstellen');}}
    {{Form::close()}}
@stop
