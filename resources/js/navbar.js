document.ready(function() {
    // Toggle menu on click
    $("#menu-toggler").onclick(function() {
      toggleBodyClass("menu-active");
    });

    function toggleBodyClass(className) {
      document.body.classList.toggle(className);
    }

   });
