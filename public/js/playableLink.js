$(function () {

  $(".playable-link").click(function(){

    var csrf = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).data('id');
    var artist = $(this).data('artist');
    var title = $(this).data('title');
    var filename = $(this).data('filename');

    var explicit = ($(this).data('explicit') == 1 ? '<i title="This song contains strong language." class="tiny material-icons white-text">explicit</i>' : '');

    var music_item = '<li><a href="'+filename+'"><b>'+artist+'</b> - '+title+' '+explicit+'</a></li>';

    $(".sm2-playlist-bd").html(music_item);

    window.sm2BarPlayers[0].playlistController.playItemByOffset();

    $.ajax({
      type: 'POST',
      url: $(this).data('url'),
      data: {_token: csrf,id : id}

    });

  });

});