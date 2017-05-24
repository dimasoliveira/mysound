$(function () {

  $(".playable-link").click(function(){

    $.ajax({
        type: 'POST',
        url: 'myaudio.dev/js/script.php',
      success: function(data) {
      alert(data);
    }});



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