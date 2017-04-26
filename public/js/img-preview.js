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
});