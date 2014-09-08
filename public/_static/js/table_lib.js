function table(){ 
        "use strict";
    var editObj = {
            getData: receiveData()
        };
    
    var fieldDescription = new Array();

    // Markiert eine Zeile in der Tabelle als geloescht
    function deleteRow(event)
    {
        var metadata = $(this).data('meta');
        var id = metadata.field_id;     // ID des Datensatzes
        var row = $(event.currentTarget).parent();
        var data = {};        
        data['id'] = id;

        $('<div></div>').appendTo('body')
         .html('<div>Soll die Zeile wirklich gel&ouml;scht werden?</div>')
         .dialog({
         position: ['top', 100],
         dialogClass:'confirm_delete',
             modal: true, title: '', zIndex: 10000, autoOpen: true,
             width: '200',
             height: '80',
             resizable: false,
             buttons: {
                 Ja: function () {
                        sendData(data, 'delete').success(function(data){
                        messageBox(data.message);
                        
                        // Der Datensatz wurde erfolgreich gelöscht
                        if(data.code=='1004')
                        {
                            row.remove();                         
                        }
                                
                    });
                    $(this).dialog("close");
                 },
                 Nein: function () {
                     $(this).dialog("close");
                 }
             },
             close: function (event, ui) {
                 $(this).remove();
             }
        });
    }

    // Edit a Cell after the onClick-Event
    function editCell(event)
    {        
        // Ermitteln der hinterlegten Datenbank-Referenz        
        var myCell = $(event.target);
        var metadata = myCell.data('meta');
        var fn = metadata.field_name;    // Feldname
        var id = metadata.field_id;     // ID des Datensatzes
        
        // Holen der Eigenschaftes des Feldes
        var desc=fieldDescription[fn];
        var val = jQuery.parseJSON(desc);
        var orginal = myCell.text();

        var input = createElement(desc, fn, orginal);

        myCell.html("");
        myCell.off('click');

        input.appendTo(myCell).focus().on('blur', function (event) {
            var myInputField = $(event.target);
            var parent = myInputField.parent(); 
            var data = {};
            data['id'] = id;
            
            switch(val.type)
            {
                case 'string':
                        var newval = myInputField.val();
                        data[fn] = newval;
                        break;
                        
                case 'checkbox':
                        if(myInputField.prop('checked'))
                        {
                            var value=1; 
                            newval='ja';
                        }
                        else
                        {
                            var value=0;
                            newval='nein';                        
                        }
                        data[fn] = value;
                        break;
            }
            

            sendData(data, 'update').success(function(data){ messageBox(data.message); });

            // insert in success function, empty td and set html
            parent.empty();
            parent.html(newval);            
            parent.on('click', editCell);
        })
        .on('click', function() {}); // necessary to keep td.click to be activated        
    }

    function addRow(event)
    {
        window.submitmystuff = 0;
        window.activatedElements = 0;
        
        var myCell = $(event.target);
        myCell.off('click'); 

        var table = $("table#dataGrid");
        var nRow = $('<tr></tr>');
        var cell = $('<td></td>');

        // Holen der Data-Objekte
        var head = $('th').filter(function (index, element) {
            return $(element).data('meta') != null;
        });
        
        nRow.append(cell);
        
        head.each(function (index, element) {
            var cell=$('<td></td>');
            
            // Holen des JSON-Strings und erstellen des Formular-Elements
            var fn = $(this).data('meta').field_name;
            var desc = fieldDescription[$(this).data('meta').field_name];
            var input = createElement(desc, fn, '');

            $(input).on('focus',function(ev){
                ev.preventDefault();
                window.activatedElements++;
            });            

            $(input).on('blur',function(ev){
                ev.preventDefault();
                window.activatedElements--;
            });

            $(input).on('change',function(ev){
                ev.preventDefault();
                window.submitmystuff = 1;
            });
            
            cell.append(input);
            nRow.append(cell);            
        });
        
        table.append(nRow);
        $(document).scrollTop($("table#dataGrid").height());

        
        var sendFormData = function () { 
            if (window.submitmystuff == 1 && window.activatedElements == 0)
            {
                var data = {};
                
                // Get the Information from the Fields
                $('table#dataGrid input').each(function(index, element){
                    var fn = $(element).attr('name');
                    var desc=fieldDescription[fn];
                    var val = jQuery.parseJSON(desc);

                    switch(val.type)
                    {
                        case 'string':
                                data[fn]=$(element).val();
                                break;

                        case 'checkbox':
                                if($(element).prop('checked'))
                                {
                                    data[fn]=1;
                                }
                                else
                                {
                                    data[fn]=0;
                                }
                                break;
                    }          
                });
                
                // Remove the form
                $('table#dataGrid tr:last').remove();                
                
                sendData(data, 'save').success(function(data){ messageBox(data.message); });

                // Reload
                $("table#dataGrid").children().remove();
             receiveData();
             window.activatedElements = 0;
             window.submitmystuff = 0;
            }            
        }
        setInterval(sendFormData, 1500);
    }

    // Generate the whole Table from the result
    function generateTable(result) {
        "use strict";
        var $data = jQuery.parseJSON(result);
    
        var icon = '<span class="Icon Icon32"></span>';
        var editable = $data.description['Editable'];
    
        // Schreiben der Spaltenkoepfe
        var table = $("#dataGrid");
        var tableHeading = $('<thead>');
        var row = $('<tr>');
        var headerCell = $('<th>');

        if(editable === true)
        {
            headerCell.addClass('NoEdit control_row');
            headerCell.append($(icon).addClass('AddIcon'));
            headerCell.on('click', addRow);
            row.append(headerCell);
        }

        // iteriere über Spalten
        $.each($data.description, function(key) {
            if($data.description[key]['visible'] === true)
            {                
                fieldDescription[key]=JSON.stringify($data.description[key]);
                headerCell=$('<th>');
                headerCell.addClass('NoEdit');
                
                switch($data.description[key]['type'])
                {
                    case 'checkbox':
                            headerCell.addClass('boolean');
                            break;

                }
                headerCell.data('meta', { field_name: key });
                headerCell.text($data.description[key]['heading']);
                row.append(headerCell);
            }
        });

        tableHeading.append(row);
        table.append(tableHeading);

        // Schreiben der Tabellen-Daten
        var tableBody=$('<tbody>');

        // iteriere Ã¼ber datensÃ¤tze
        $.each($data.data, function(key, value) {
            var row = $('<tr>');
            var bodyCell = $('<td>');

            if(editable === true)
            {
                bodyCell.addClass('NoEdit');
                bodyCell.data('meta', { field_id: value[$data.description['Primary_Key']]});

                var actionIcon = 'DeleteIcon';
                bodyCell.append($(icon).addClass('DeleteIcon'));
                bodyCell.on('click', deleteRow);
                
                row.append(bodyCell);
            }

            $.each(value, function(key) {
                if($data.description[key]['visible'] === true)
                {
                    bodyCell=$('<td>');
                    bodyCell.data('meta', { field_name: key, field_id: value[$data.description['Primary_Key']]});

                    switch($data.description[key]['type'])
                    {
                        case 'string':
                                if ( typeof(value[key]) !== "undefined" && value[key] !== null )
                                {
                                    bodyCell.text(value[key]);                                                    
                                }
                                break;
                                
                        case 'checkbox':
                                bodyCell.addClass('boolean');
                                if(value[key] == '1')
                                {
                                    bodyCell.text('ja');
                                }
                                else
                                {
                                    bodyCell.text('nein');                            
                                }
                                break;
                    }
                    
                    bodyCell.on('click', editCell);
                    row.append(bodyCell);
                }
            });
            tableBody.append(row);
            table.append(tableBody);
        });        

    }
    
    function receiveData() {    
        $.ajax({
            url: $('#base_url').val()+'/ajax/',
            success: generateTable
        });        
    }
        
    return editObj;
}

// Hilfs-Methode zur Erstellung Formular-Elementen anhand des übergebenen
// JSON-Strings 
function createElement(desc, name, field_val)
{
    var val = jQuery.parseJSON(desc);
            
    // Fallunterscheidung für den Typ des Elements
    switch(val.type)
    {
        case 'string':         
                var field=$('<input />');
                field.attr('type', 'text');
                field.attr('name', name);
                field.attr('maxlength', val.size);
                field.val(field_val);
                break;
        
        case 'checkbox':
                var field=$('<input />');
                field.attr('type', 'checkbox');
                field.attr('name', name);
                field.attr('value', 'show_artist')
                
                if(field_val == "ja")
                {
                    field.prop('checked', true);
                }
                break;
    }
    return field;
}

// Schnittstelle zur REST-API zum senden der Daten
function sendData(data, controller)
{
    var url=$('#base_url').val()+ "/" + controller;

    var promise = $.ajax(
    {
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        error: function(a,b){
            console.log('failed: ',data);
        }
    });

    return promise;
}

function messageBox(message)
{
    $('body').prepend($('<div>').addClass('messagebox').html(message))
}
