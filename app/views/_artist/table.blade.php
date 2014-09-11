@extends('base')

@section('content')
<table class="table-bordered">
    <tr>
        <th>&nbsp;</th>
        <th>{{trans('messages.Given name/Article')}}</th>
        <th>{{trans('messages.Last Name/Group')}}</th>
    </tr>
    @foreach($artists as $artist)
            <tr>
                <td>
                    <a href="{{url('artist/edit/'.$artist->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{url('artist/destroy/'.$artist->id)}}" data-confirm="{{trans('messages.Do you really want to delete the artist?')}}"><span class="glyphicon glyphicon-trash"></span></a>
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
