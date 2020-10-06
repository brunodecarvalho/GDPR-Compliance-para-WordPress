$( document ).ready(function() {
    if ($('.button_text').length) {
        $('.button_text').on('click', function(event) {

            event.preventDefault();
            var $this = $(this),
                nonce = $this.data('nonce'),
                ajaxurl = $this.data('ajax-url'),
                saved_cookie = $this.data('saved-cookie');

            var data = {
                'nonce': nonce,
                'action': 'my_action_name',
                'saved_cookie': saved_cookie
            };

            $.ajax({
                type: 'post',
                url: ajaxurl,
                data: data,
                success: function(response) {
                    $('.panel_out').hide();
                    if (response === "Aceito") {
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    }
});