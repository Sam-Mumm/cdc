@extends('base')

@section('content')
<table class="table-bordered dataGrid">     
</table>
@stop

@section('javascript')
    @parent
    {{ HTML::script('_static/js/jquery.dataTables.min.js'); }}
    {{ HTML::script('_static/js/bootstrap-editable.js'); }}
    {{ HTML::script('_static/js/confirm.js'); }}
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.dataGrid').dataTable({
		"processing": true,
        	"serverSide": true,
		"ajax": "{{url('category/data')}}",
		"columns": {{json_encode($tblHeads)}},
                "columnDefs": [{
                        "targets": 2,
                        "render": function(data) {
                                var relLink='<a href="/genre/destroy/3"><span class="glyphicon glyphicon-filter"></span></a>';
                                return relLink;
                            }
                    }],
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    var name_link = $('<a>').prop({
                                    'id': 'name',
                                    'href': '#'
                        })
                        .data({'type': 'text', 'pk': aData['id']})
                        .text(aData['name']);
                    name_link.editable({type: 'text', url: '/category/update'});
                    $('td:eq(0)', nRow).html(name_link);
                                        
                    var show_artist_link = $('<a>').prop({
                                    'id': 'show_artist',
                                    'href': '#'
                        })
                        .data({'value': aData['show_artist'], 'type': 'select', 'pk': aData['id'], 'source': "{'0': 'no', '1': 'yes'}"})
                        .text(aData['show_artist'] == "1" ? 'yes' : 'no');
                    show_artist_link.editable({type: 'select', url: '/category/update'});
                    $('td:eq(1)', nRow).html(show_artist_link);
                    
                    var delIcon = $('<span>').addClass('glyphicon glyphicon-trash');
                    var delLink = $('<a>')
                                    .prop("href", "/category/destroy/"+aData['id']) 
                                    .data("confirm", "Do you really want to delete this category?")      
                                    .append(delIcon);
                    $(delLink).click(CD);
                    $('td:eq(2)', nRow).append(delLink);
                }
            });
        });
    </script>
@stop