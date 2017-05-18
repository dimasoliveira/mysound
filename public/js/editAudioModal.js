$(function () {

  $(".edit-audio").click(function(){

    $('#editAudioForm input[name="title"]').val($(this).data('title'));
    $('#editAudioForm input[name="artist"]').val($(this).data('artist'));
    $('#editAudioForm input[name="tracknumber"]').val($(this).data('tracknumber'));
    $('#editAudioForm input[name="album"]').val($(this).data('album'));
    $('#editAudioForm input[name="year"]').val($(this).data('year'));
    $('#editAudioForm input[name="genre"]').val($(this).data('genre'));


    $('#editAudioForm label').not('#editAudioForm label[for="explicit2"]').not('#editAudioForm label[for="published2"]').addClass('active');

    if ($(this).data('explicit')){
      $('#editAudioForm input[name="explicit"]').attr("checked","checked");
    }
    if ($(this).data('published')){
      $('#editAudioForm input[name="published"]').attr("checked","checked");
    }

    var route = "http://mysound.dev/myaudio/edit/"+$(this).data('id');

    $("#editAudioForm").attr("action", route);

    $('#editAudio').modal().modal('open');
  });

});

  