@extends('base')

@section('content')
<table>
    @foreach($genres as $genre)
            <tr>
                <td>
                    <a href="./genre/edit/{{$genre->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="./genre/destroy/{{$genre->id}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$genre->name}}</td>
            </tr>
    @endforeach
</table>
{{$genres->links()}}
@stop
