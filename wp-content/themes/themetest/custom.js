jQuery(document).ready(function($) {
  $('.variable-width').slick({
    dots: true,
    infinite: true,
    speed: 1500,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true,
    autoplay: true,
    autoplaySpeed: 2500,
});





  window.onscroll = function() {
    myFunction();
    scrollFunction();
  };

  let navbar = document.getElementById("logo");
  var sticky = navbar.offsetTop;
  var test = document.getElementsByClassName('test');
  var gotop = document.getElementById("myBtn");

  test[0].classList.add("testbay");
  function myFunction() {
    var testvalue = window.scrollY;
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
    }else {
        navbar.classList.remove("sticky");
    }
  }
  function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 500) {
      gotop.classList.add("testanimation");
    } else {
      gotop.classList.remove("testanimation");
    }
  }

})

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
