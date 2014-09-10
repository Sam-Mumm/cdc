@extends('base')

@section('content')
<table>
    @foreach($categories as $category)
            <tr>
                <td>
                    <a href="./category/edit/{{$category->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="./category/destroy/{{$category->id}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$category->name}}</td>
                <td>{{{$category->show_artist?'ja':'nein'}}}</td>
            </tr>
    @endforeach
</table>
{{$categories->links()}}
@stop
