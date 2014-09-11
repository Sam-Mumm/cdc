@extends('base')

@section('content')
<table class="table-bordered">
    <tr>
        <th>&nbsp;</th>
        <th>{{trans('messages.Category')}}</th>
        <th>{{trans('messages.show artist')}}</th>
    </tr>
    @foreach($categories as $category)
            <tr>
                <td>
                    <a href="{{url('category/edit/'.$category->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{url('category/destroy/'.$category->id)}}" data-confirm="{{trans('messages.Do you really want to delete the category?')}}"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$category->name}}</td>
                <td>{{{$category->show_artist?trans('messages.yes'):trans('messages.no')}}}</td>
            </tr>
    @endforeach
</table>
{{$categories->links()}}
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/confirm.js'); }}
@stop