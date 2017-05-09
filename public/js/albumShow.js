/**
 * Created by dimas on 5/2/17.
 */

$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered

  $('.dropdown-button').dropdown({
      constrainWidth: false // Does not change width of dropdown to that of the activator
    }
  );
});

$("#albumcoverEdit").click(function() {
  $("#coverart").click();
});

$("#test").click(function() {
  $("#albumNameBlock").attr('style', 'display:none');
  $("#albumNameForm").removeAttr("style");
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#img-preview').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$("#coverart").change(function(){
  readURL(this);

  $("#saveButton").removeAttr("hidden").attr('class', 'btn-floating right waves-effect waves-light blue')
    .click(function() {
      $("#coverartForm").submit();

  });

});


