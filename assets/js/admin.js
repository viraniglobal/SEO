jQuery(function ($) {

    $('#vsap-start-audit').on('click', function () {

        const button = $(this);

        button.prop('disabled', true).text('Scanning...');

        $('#vsap-audit-log').html('<p>Starting SEO Audit...</p>');

        $.post(vsap_admin.ajax_url, {
            action: 'vsap_start_audit',
            nonce: vsap_admin.nonce
        }, function (response) {

            if (response.success) {
                $('#vsap-audit-log').html('<p style="color:green;">' + response.data.message + '</p>');
            } else {
                $('#vsap-audit-log').html('<p style="color:red;">' + response.data + '</p>');
            }

            button.prop('disabled', false).text('🚀 Start Full SEO Audit');

        });

    });

});