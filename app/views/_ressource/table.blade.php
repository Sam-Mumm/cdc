@extends('base')

@section('content')
<table>
    @foreach($ressources as $ressource)
            <tr>
                <td>
                    <a href="./ressource/edit/{{$ressource->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="./ressource/destroy/{{$ressource->id}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$ressource->name}}</td>
            </tr>
    @endforeach
</table>
{{$ressources->links()}}
@stop
