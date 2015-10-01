@extends('base')

@section('content')
    <form class="form-horizontal" role="form">
        <div class="form-group">
            {{Form::label('artist_album', 'Künstler:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                {{Form::select('artist_album', $artist, null, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('title_album', 'Titel:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                {{Form::text('title_album', null, ['class' => 'form-control', 'required' => 'required', 'maxlength'=>'50'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('release_year', 'Erscheinungsjahr:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                {{Form::selectYear('release_year', date("Y"), 1960, null, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('ressource', 'Medium:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                {{Form::select('ressource', $ressource, null, ['class' => 'form-control'])}}                
            </div>
        </div>
        <div class="form-group">
            {{Form::label('genre', 'Genre:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                {{Form::select('genre', $genre, null, ['class' => 'form-control'])}}                                
            </div>
        </div>
        <div class="form-group">
            {{Form::label('category', 'Kategorie:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                <select class="form-control">
                    @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" data-show_artist="{{ $cat->show_artist }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {{Form::label('cover', 'Cover:', ['class' => 'control-label col-sm-2'])}}
            <div class="col-sm-10">
                {{Form::file('cover', ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#cd1">CD 1</a></li>
<!---                <li><a data-toggle="tab" href="#cd2">CD 2</a></li> -->
            </ul>
            <div class="tab-content">
                <div id="cd1" class="tab-pane fade in active">
                    CD 1
                </div>
                
<!---                  <div id="menu1" class="tab-pane fade">
    <h3>Menu 1</h3>
    <p>Some content in menu 1.</p>
  </div> -->
            </div>
        </div>
    </form>
@stop
