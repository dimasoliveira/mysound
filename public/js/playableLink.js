$(function () {

  $(".playable-link").click(function(){



    var $csrf = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {_token: $csrf}

    });


    $.post(url, {_token: $csrf}).success().error();


    if ($(this).data('explicit')){
      var explicit = '<span class="label">E</span>';
    }
    else {
      var explicit = ''
    }
    var music_item = '<li><a href="'+ $(this).data('filename')+'"><b>'+ $(this).data('artist')+'</b> - '+$(this).data('title')+explicit+'</a></li>';


    $(".sm2-playlist-bd").html(music_item);

    window.sm2BarPlayers[0].playlistController.playItemByOffset();




  });

});