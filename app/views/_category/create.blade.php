@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'category/store', 'method' => 'post'))}}    
        <div class="grid">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('name', 'Kategorie:')}}
                </div>
                <div class="cell w80">
                    {{Form::text('name', null, array('placeholder'=>'Kategoriename', 'required'=>'required', 'maxlength'=>50));}}
                </div>
            </div>
            <div class="clear">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('show_artist', 'K&uuml;nstler anzeigen:')}}
                </div>
                <div class="cell w80">
                    {{Form::select('show_artist', array('0' => 'nein', '1' => 'ja')) }}
                </div>
            </div> 
            <div class="clear">
        </div>
        {{Form::submit('Erstellen');}}
    {{Form::close()}}
@stop
