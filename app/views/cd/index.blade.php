@extends('base')

@section('content')
<h1>Hallo Welt</h1>
@foreach ($foo as $val)
	{{$val->name}} <br/>
@endforeach
{{$foo->links()}}
@stop
