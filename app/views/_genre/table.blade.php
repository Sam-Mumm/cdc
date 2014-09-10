@extends('base')

@section('content')
<table>
    <tr>
        <th>&nbsp;</th>
        <th>Genre</th>
    </tr>
    @foreach($genres as $genre)
            <tr>
                <td>
                    <a href="{{url('genre/edit/'.$genre->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{url('genre/destroy/'.$genre->id)}}" data-confirm="Do you really want to delete the genre?"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$genre->name}}</td>
            </tr>
    @endforeach
</table>
{{$genres->links()}}
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/confirm.js'); }}
@stop