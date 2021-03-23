<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<script>
    var MenuItems = document.getElementById("MenuItems");

    MenuItems.style.maxHeight = "0px";

    function menuToggle() {
       if(MenuItems.style.maxHeight == "0px") {
          MenuItems.style.maxHeight = "200px";
       } else {
          MenuItems.style.maxHeight = "0px";
       }
    }

    var scroll = new SmoothScroll('a[href*="#"]', {
       speed: 1000,
       speedAsDuration: true
    });
</script>