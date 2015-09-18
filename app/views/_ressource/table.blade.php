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
		"ajax": "{{url('ressource/index')}}",
		"columns": {{json_encode($tblHeads)}},
                "columnDefs": [{
                    "targets": 1,
                    "render": function (data) {
                            var relLink='<a href="/genre/destroy/3"><span class="glyphicon glyphicon-filter"></span></a>';
                            return relLink;
                        }
                    }],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                        var anker = $('<a>').prop({
                                        'id' : 'name',
                                        'href':'#'
                        })
                        .data({'type':'text','pk':aData['id']})
                        .text(aData['name']);
                        anker.editable({type: 'text', url: '/ressource/update'});
                        $('td:eq(0)', nRow).html(anker);
                        
                        var delIcon = $('<span>').addClass('glyphicon glyphicon-trash');
                        var delLink = $('<a>').prop("href", "/ressource/destroy/"+aData['id']) 
                                .data("confirm", "Do you really want to delete this medium?")      
                                .append(delIcon);
                        $(delLink).click(CD);
                        
                        $('td:eq(1)', nRow).append(delLink);

                    }
                });
        });
    </script>
@stop
