@extends('base')

@section('content')
<table class="table-bordered dataGrid">
</table>
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/jquery.dataTables.js'); }}
    {{ HTML::script('_static/js/bootstrap-editable.js'); }}   
    {{ HTML::script('_static/js/confirm.js'); }}
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.dataGrid').dataTable({
		"processing": true,
        	"serverSide": true,
		"ajax": "{{url('genre/index')}}",
		"columns": {{json_encode($tblHeads)}},
                "columnDefs": [{
                    "targets": 1,
                    "render": function (data) {
                            var delLink='<a href="/genre/destroy/3" class="data-confirm" onclick="return confirm(\"bla\");">X</a>';
                            return delLink;
                        }
                    }],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                        var anker = $('<a>').prop({
                                        'id' : 'name',
                                        'href':'#'
			})
                        .data({'type':'text','pk':aData['id']})
                        .text(aData['name']);
                        anker.editable({type: 'text', url: '/genre/update'});
                        $('td:eq(0)', nRow).html(anker);
                    }
            });

        });        
    </script>
@stop