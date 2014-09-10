@extends('base')

@section('content')
<table>
    @foreach($artists as $artist)
            <tr>
                <td>
                    <a href="./artist/edit/{{$artist->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="./artist/destroy/{{$artist->id}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$artist->first_name}}</td>
                <td>{{$artist->last_name}}</td>
            </tr>
    @endforeach
</table>
{{$artists->links()}}
@stop
