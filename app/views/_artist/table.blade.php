@extends('base')

@section('content')
<table class="table-bordered dataGrid">
</table>
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/jquery.dataTables.js'); }}
    {{ HTML::script('_static/js/confirm.js'); }}
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.dataGrid').dataTable({
		"processing": true,
        	"serverSide": true,
		"ajax": "{{url('artist/index')}}",
		"columns": {{json_encode($tblHeads)}}
            });
        });
    </script>
@stop