@extends('base')

@section('content')
<table>
    <tr>
        <th>&nbsp;</th>
        <th>Category</th>
        <th>Show Artist?</th>
    </tr>
    @foreach($categories as $category)
            <tr>
                <td>
                    <a href="{{url('category/edit/'.$category->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="{{url('category/destroy/'.$category->id)}}" data-confirm="Do you really want to delete the category"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
                <td>{{$category->name}}</td>
                <td>{{{$category->show_artist?'ja':'nein'}}}</td>
            </tr>
    @endforeach
</table>
{{$categories->links()}}
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/confirm.js'); }}
@stop