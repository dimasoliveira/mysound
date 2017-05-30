$(function () {

    // var csrf = $('meta[name="csrf-token"]').attr('content');

    $("#playlistPlay").click(function(){

      $(".sm2-playlist-bd").empty();

      $('.playlistItem').each(function(i, obj) {

        var id = $(this).data('id');
        var artist = $(this).data('artist');
        var title = $(this).data('title');
        var filename = $(this).data('filename');
        var explicit = ($(this).data('explicit') == 1 ? '<span class="label">E</span>' : '');

        var music_item = '<li><a href="'+filename+'"><b>'+artist+'</b> - '+title+explicit+'</a></li>';

        $(".sm2-playlist-bd").append(music_item);


      });

      window.sm2BarPlayers[0].playlistController.playItemByOffset();


    });

    // $.ajax({
    //   type: 'POST',
    //   url: $(this).data('url'),
    //   data: {_token: csrf,id : id}
    //
    // });
});