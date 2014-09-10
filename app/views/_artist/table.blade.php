@extends('base')

@section('content')
<table>
    @foreach($artists as $artist)
            <tr>
                <td>
                    <a href="{{url('artist/edit/'.$artist->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{url('artist/destroy/'.$artist->id)}}" data-confirm><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$artist->first_name}}</td>
                <td>{{$artist->last_name}}</td>
            </tr>
    @endforeach
</table>
{{$artists->links()}}
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/confirm.js'); }}
@stop
