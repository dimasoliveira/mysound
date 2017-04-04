(function ($) {

    Drupal.behaviors.islandora_global_sm2_post = {
        attach: function (context, settings) {
            // Clicking (or effectively clicking) in the playlist causes all
            // links to go silent except the one with the right id.
            $(".sm2-playlist-bd a").click( function ( event ) {
                var linkId = $(this).attr("id").replace('-target','');
                $('.gsm2-playable-link').removeClass('playing').addClass('silent');
                $("#" +linkId).removeClass('silent').addClass('playing');
            });
            // Clicking (or effectively clicking) on the pause/play button while playing
            // causes all links to go silent.
            $(".play-pause").click( function ( event ) {
                if ( $('.sm2-bar-ui').hasClass('playing') ) {
                    $(".gsm2-playable-link").removeClass('playing').addClass('silent');
                } else {
                    var linkId = $('.sm2-playlist-bd .selected a').attr('id').replace('-target','');
                    $("#" +linkId).removeClass('silent').addClass('playing');
                }
            });
        },
    };
}(jQuery));