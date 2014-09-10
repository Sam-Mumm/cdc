@extends('base')

@section('content')
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach


    {{Form::open(array('url' =>'artist/update/'.$data->id, 'method' => 'post'))}}    
        <div class="grid">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('first_name', 'Vorname/Artikel')}}
                </div>
                <div class="cell w80">
                    {{Form::text('first_name', $data->first_name, array('placeholder'=>'Vorname/Artikel', 'maxlength'=>50));}}
                </div>
            </div>
            <div class="clear">
            <div class="row">
                <div class="cell w20">
                    {{Form::label('last_name', 'Name/Gruppe:')}}
                </div>
                <div class="cell w80">
                    {{Form::text('last_name', $data->last_name, array('placeholder'=>'Name/Gruppenname', 'required'=>'required', 'maxlength'=>255));}}
                </div>
            </div> 
            <div class="clear">
        </div>
        {{Form::submit('aktualisieren');}}
    {{Form::close()}}
@stop