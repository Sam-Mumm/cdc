@extends('base')

@section('content')
<table>
    <tr>
        <th>&nbsp;</th>
        <th>Artist/Group</th>
        <th>Title</th>
        <th>Category</th>
        <th>Genre</th>
        <th>Medium</th>
        <th>Year</th>
    </tr>
    @foreach($albums as $album)
            <tr>
                <td>
                    <a href="{{url('album/destroy/'.$album->id)}}" data-confirm="Do you really want to delete the album?"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>
                    @if(!$album->category->show_artist)
                        {{$album->artist->first_name.' '.$album->artist->last_name}}
                    @endif
                </td>
                <td>{{$album->title}}</td>
                <td>{{$album->category->name}}</td>
                <td>{{$album->genre->name}}</td>
                <td>{{$album->ressource->name}}</td>
                <td>{{$album->year}}</td>
            </tr>
    @endforeach
</table>
{{$albums->links()}}
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/confirm.js'); }}
@stop