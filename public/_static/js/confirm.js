$(function() {
    /**
     * init confirm dialog. You can implement a confirmation dialog on
     * every link, where ever you want.
     * Simple add the HTML Attribute "data-confirm" to a link object.
     */
    $('a[data-confirm]').click(function(ev) {
        ev.preventDefault();
        var target_url = $(this).data('target');
        var modal_html = '<div id="dataConfirmModal" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title">Please confirm</h4></div><div class="modal-body"><p>Are you sure?</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button><button type="button" class="btn btn-primary" id="dataConfirmOK">Yes</button></div></div></div></div>';
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
            $('body').append(modal_html);
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmModal').modal({show: true});

        // confirm dialog closed with ok, open URL
        $('#dataConfirmOK').click(function(e) {
            e.preventDefault();
            $.post(href).done(function() {
                $('#dataConfirmModal').modal('hide');
                $('#dataConfirmModal').on('hidden.bs.modal', function() {
                    $('.modal-backdrop').remove();
                    $('#dataConfirmModal').remove();
                });
                // redirect to target url
                if (target_url !== undefined
                    && typeof(target_url) === 'string'
                    && target_url.length > 0)
                {
                    window.location.href = target_url;
                }
                else
                {
                    // no target url - we reload this shit
                    window.location.reload();
                }
            });
        });
        return false;
    });
});