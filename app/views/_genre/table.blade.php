@extends('base')

@section('content')
<table class="table-bordered dataGrid">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>{{trans('messages.Genre')}}</th>
    </tr>
    </thead>
    <tbody>
        @foreach($genres as $genre)
                <tr>
                    <td>
                        <a href="{{url('genre/edit/'.$genre->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="{{url('genre/destroy/'.$genre->id)}}" data-confirm="{{trans('messages.Do you really want to delete the genre?')}}"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                    <td>{{$genre->name}}</td>
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