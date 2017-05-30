$(function () {

  $(".addToPlaylist").click(function(){

    var id = $(this).data('id');

    $('.addToPlaylistForm').each(function(i, obj) {

      var url = $(this).attr("action")+'/'+id;

      $(this).attr("action", url);

    });

    $('#addToPlaylist').modal({

        complete: function() {

          $('.addToPlaylistForm').each(function(i, obj) {

            var url = 'http://mysound.dev/playlist/'+$(this).data('id');
            $(this).attr("action",url);

          });
        }
      }
    );
  });
});