window.onload = function() {

    jQuery(function($) {

        $(document).on('submit_success', function(e, data) {

            if (data.data.success_text) {
                //console.log(data.data.success_text)
                to_put = data.data.success_text
                $('.custom_success_action').empty().append(to_put);

            } else {

                $('.custom_success_action').empty();
                // console.log(data.data.success_popup)
                elementorProFrontend.modules.popup.showPopup({
                    id: data.data.success_popup
                }, event);

            }

        });

    });
    
}