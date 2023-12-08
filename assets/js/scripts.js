document.addEventListener("DOMContentLoaded", function () {
  var navItems = document.querySelectorAll('.navbar-nav .nav-link');

  navItems.forEach(function (item) {
      item.addEventListener('click', function () {
          var navbarToggler = document.querySelector('.navbar-toggler');
          if (window.innerWidth < 992) { // Check if it's a mobile view
              navbarToggler.click(); // Simulate a click on the navbar toggler button to close the menu
          }
      });
  });
});