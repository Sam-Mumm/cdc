@extends('base')

@section('content')
<table>
@foreach($datas as $data)
	<tr>
	@foreach($data->toArray() as $col)
		<td>{{$col}}</td>
	@endforeach
	</tr>
@endforeach
</table>
@stop
