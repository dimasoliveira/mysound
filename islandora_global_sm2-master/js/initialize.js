(function ($) {

    Drupal.behaviors.islandora_global_sm2 = {
        attach: function (context, settings) {
            var playlist = '';
            $( ".sm2-bar-ui" ).hide();
            $( ".gsm2-playable-link" ).each( function ( index ) {
                $( ".sm2-bar-ui" ).show();
                var source, label, targetId;
                // Add the id
                $( this ).attr('id', 'gsm2-link' +index);
                // Create a playlist item
                source = $(this).attr('data-source');
                label = $(this).text();
                targetId = 'gsm2-link' + index.toString() + '-target';
                playlist += '<li><a href="' + source + '" id="' + targetId + '" type="audio/mpeg">' + label + '</a></li>';
                // Add the onclick to point to targetID
                $(this).click  (function( event ) {
                    event.preventDefault();

                    if ($(this).hasClass('silent')) {
                        $('.gsm2-playable-link').removeClass('playing').addClass('silent');
                        $(this).removeClass('silent').addClass('playing');
                        $("#" + targetId)[0].click();
                    } else {
                        $(this).removeClass('playing').addClass('silent');
                        $(".sm2-inline-button.play-pause")[0].click();

                    }


                });
            });
            $('#gsm2-playlist').append(playlist);
        }
    };
}(jQuery));