$(document).ready(function() {
  $('.sidebar-toggle').click(function() {
    $('.sidebar').toggleClass('open');
  });

  $('.close-button').click(function() {
    $('.sidebar').removeClass('open');
  });

  // Close sidebar when clicked outside in mobile view
  $(document).on('click touchstart', function(e) {
    if ($('.sidebar').hasClass('open') && !$(e.target).closest('.sidebar, .sidebar-toggle').length) {
      $('.sidebar').removeClass('open');
    }
  });
});