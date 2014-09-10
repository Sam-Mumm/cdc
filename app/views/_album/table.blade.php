@extends('base')

@section('content')
<table>
    @foreach($albums as $album)
            <tr>
                <td>
                    <a href="./artist/destroy/{{$album->id}}"><span class="glyphicon glyphicon-trash"></span></a>
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
