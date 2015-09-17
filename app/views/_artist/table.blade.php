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
		"ajax": "{{url('artist/index')}}",
		"columns": {{json_encode($tblHeads)}},
                "columnDefs": [{
                        "targets": 2,
                        "render": function(data) {
                                var relLink='<a href="/artist/filter/3"><span class="glyphicon glyphicon-filter"></span></a>';
                                return relLink;
                            }
                        }],
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        var first_name_link = $('<a>').prop({
                            'id': 'first_name',
                            'href': '#'
                        })
                        .data({'type':'text','pk':aData['id']})
                        .text(aData['first_name']);
                        first_name_link.editable({type: 'text', url: '/artist/update'});
                        $('td:eq(0)', nRow).html(first_name_link);

                        var last_name_link = $('<a>').prop({
                            'id': 'last_name',
                            'href': '#'
                        })
                        .data({'type':'text','pk':aData['id']})
                        .text(aData['last_name']);
                        last_name_link.editable({type: 'text', url: '/artist/update'});
                        $('td:eq(1)', nRow).html(last_name_link);
                        
                        var delIcon = $('<span>').addClass('glyphicon glyphicon-trash');
                        var delLink = $('<a>').prop("href", "/artist/destroy/"+aData['id']) 
                                .data("confirm", "Do you really want to delete this artist?")      
                                .append(delIcon);
                        console.log($(delLink).data('confirm'));
                        $(delLink).click(CD);
                        
                        $('td:eq(2)', nRow).append(delLink);

                    }
            });
        });
    </script>
@stop