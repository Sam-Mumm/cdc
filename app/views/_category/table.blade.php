@extends('base')

@section('content')
<table class="table-bordered dataGrid">     
</table>
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/jquery.dataTables.min.js'); }}
    {{ HTML::script('_static/js/confirm.js'); }}
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.dataGrid').dataTable({
		"processing": true,
        	"serverSide": true,
		"ajax": "{{url('category/index')}}",
		"columns": {{json_encode($tblHeads)}},
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    $('td:eq(1)', nRow).html(aData['show_artist'] == "1" ? 'yes' : 'no');
                }
            });
        });
    </script>
@stop