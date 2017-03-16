$( document ).ready(function() {

  $(".dropdown-button").dropdown({
    hover: false,
    belowOrigin: true
  });


  <!-- Datepicker Script -->
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });

  $('.carousel.carousel-slider').carousel({fullWidth: true});

});