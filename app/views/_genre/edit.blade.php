@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'genre/update/'.$data->id, 'method' => 'post'))}}    
        <div class="grid">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('name', 'Genre:')}}
                </div>
                <div class="cell w80">
                    {{Form::text('name', $data->name, array('placeholder'=>'Genrebezeichnung', 'required'=>'required', 'maxlength'=>50));}}
                </div>
            </div>
        </div>
        {{Form::submit('aktualisieren');}}
    {{Form::close()}}
@stop