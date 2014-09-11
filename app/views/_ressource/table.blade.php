@extends('base')

@section('content')
<table class="table-bordered">
    <tr>
        <th>&nbsp;</th>
        <th>{{trans('messages.Medium')}}</th>
    </tr>    
    @foreach($ressources as $ressource)
            <tr>
                <td>
                    <a href="{{url('ressource/edit/'.$ressource->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{url('ressource/destroy/'.$ressource->id)}}" data-confirm="{{trans('messages.Do you really want to delete the medium?')}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$ressource->name}}</td>
            </tr>
    @endforeach
</table>
{{$ressources->links()}}
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/confirm.js'); }}
@stop