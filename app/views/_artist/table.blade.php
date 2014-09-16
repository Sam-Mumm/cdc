@extends('base')

@section('content')
<table class="table-bordered dataGrid">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>{{trans('messages.Given name/Article')}}</th>
            <th>{{trans('messages.Last Name/Group')}}</th>
        </tr>
    </thead>
    <tbody>
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
    </tbody>
</table>
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/jquery.dataTables.min.js'); }}
    {{ HTML::script('_static/js/confirm.js'); }}
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.dataGrid').dataTable();
        });
    </script>
@stop