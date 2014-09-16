@extends('base')

@section('content')
<table class="table-bordered dataGrid">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>{{trans('messages.Artist/Group')}}</th>
            <th>{{trans('messages.Title')}}</th>
            <th>{{trans('messages.Category')}}</th>
            <th>{{trans('messages.Genre')}}</th>
            <th>{{trans('messages.Storage Medium')}}</th>
            <th>{{trans('messages.Year')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($albums as $album)
                <tr>
                    <td>
                        <a href="{{url('album/destroy/'.$album->id)}}" data-confirm="{{trans('messages.Do you really want to delete the album?')}}"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                    <td>
                        @if(!$album->category->show_artist)
                            {{$album->artist->first_name.' '.$album->artist->last_name}}
                        @endif
                    </td>
                    <td>{{$album->title}}</td>
                    <td>{{$album->category->name}}</td>
                    <td>{{$album->genre->name}}</td>
                    <td>{{$album->ressource->name}}</td>
                    <td>{{$album->year}}</td>
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