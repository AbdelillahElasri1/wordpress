(function ($) {
    let adminAjaxUrl = null;

    $(document).ready(function () {
        /** Set ajax url value **/
        if( typeof stm_lms_starter_theme_data.stm_lms_admin_ajax_url !== 'undefined'
            &&  stm_lms_starter_theme_data.hasOwnProperty('stm_lms_admin_ajax_url') ) {
            adminAjaxUrl = stm_lms_starter_theme_data.stm_lms_admin_ajax_url;
        }
        /** show step 2 **/
        $('#loader').on('click', function (e) {
            e.preventDefault();
            $('#loader .installing').css('display','inline-block');
            $('#loader span').html('Updating ');
            $('#loader').addClass("updating");
            $.ajax({
                url: adminAjaxUrl,
                dataType: 'json',
                context: this,
                method: 'POST',
                data: {
                    action: 'stm_update_starter_theme',
                    slug: 'ms-lms-starter-theme',
                    type: 'theme',
                    nonce: starter_theme_nonces['stm_update_starter_theme'],
                },
                complete: function (data) {
                    $('#loader .installing').css('display','none');
                    $('#loader .downloaded').css('display','inline-block');
                    $('#loader span').html('Successfully Installed');
                }
            });
        });

    });
})(jQuery);