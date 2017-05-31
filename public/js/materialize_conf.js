$( document ).ready(function() {

  $(".dropdown-button").dropdown({
    hover: false,
    // belowOrigin: true,
    constrainWidth: false // Does not change width of dropdown to that of the activator
  });


  <!-- Datepicker Script -->
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });

  $('.carousel.carousel-slider').carousel({fullWidth: true});


  $(".button-collapse").sideNav();
  //
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });

  $(document).ready(function() {
    $('select').material_select();
  });


});