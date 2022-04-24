$(document).ready(function () {
  setupProductMenu();
  toggleProductMenu();
  setupIntroductionBanner();
  var startTime = "2021-03-30  19:00:00";
  makeTimer(startTime);
  setInterval(function () {
    makeTimer(startTime);
  }, 1000);
  setupFlashSaleSlider();
  setupOldBookshelfSlider();
  setupHotSaleSlider();

  setupTabButton("hot-sale-tab", "hot-sale-item");
  setupTabButton("suggest-tab", "suggest-item");
});

function setupProductMenu() {
  //setup
  // var subMenu = $('.product-menu .content .sub-menu');

  setupLastTextColor();
  let productElement = $(".product-menu .content>ul>li");
  productElement.hover(
    function () {
      // over
      $(this).children().css("color", "#f0f0f0");
      $(this).css("background", "#001486");
      let currentSubMenu = $(this).find(".sub-menu");
      toggleSubMenu(currentSubMenu, 1);
    },
    function () {
      // out
      $(this).children().css("color", "#000");
      $(this).css("background", "#f8f8f8");
      let currentSubMenu = $(this).find(".sub-menu");
      toggleSubMenu(currentSubMenu, 0);
    }
  );
}
function setupLastTextColor() {
  // Change Last Text of Mega Menu
  let contentMegaMenu = $(" .mega-menu>ul>li>a");
  $.each(contentMegaMenu, function (key, value) {
    if (value.textContent == "Xem Thêm...") {
      $(this).css("color", "#000097");
    }
  });
}
function toggleSubMenu(currentSubMenu, isToggle) {
  if (isToggle == 1) {
    currentSubMenu.css("display", "block");
    currentSubMenu.find(".mega-menu").css("display", "block");
  } else {
    currentSubMenu.css("display", "none");
    currentSubMenu.find(".mega-menu").css("display", "none");
  }
}
function toggleProductMenu() {
  $(".product-menu .container").hover(
    function () {
      // over
      $(".product-menu").toggleClass("toggle");
      $(".product-menu .content").css("display", "block");
    },
    function () {
      // out
      $(".product-menu").toggleClass("toggle");
      $(".product-menu .content").css("display", "none");
    }
  );
}

function setupIntroductionBanner() {
  var swiper = new Swiper(".s1", {
    speed: 160,
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: true,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}

function setupFlashSaleSlider() {
  var swiper = new Swiper(".s2", {
    slidesPerView: 1,
    centeredSlides: false,
    slidesPerGroupSkip: 1,
    grabCursor: true,
    keyboard: { enabled: true },
    breakpoints: { 769: { slidesPerView: 2, slidesPerGroup: 2 } },
    scrollbar: { el: ".swiper-scrollbar" },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}

function makeTimer(startTime) {
  //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
  var endTime = new Date(startTime.toString());
  endTime = Date.parse(endTime) / 1000;

  var now = new Date();
  now = Date.parse(now) / 1000;

  var timeLeft = endTime - now;

  var days = Math.floor(timeLeft / 86400);
  var hours = Math.floor((timeLeft - days * 86400) / 3600);
  var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
  var seconds = Math.floor(
    timeLeft - days * 86400 - hours * 3600 - minutes * 60
  );

  if (hours < "10") {
    hours = "0" + hours;
  }
  if (minutes < "10") {
    minutes = "0" + minutes;
  }
  if (seconds < "10") {
    seconds = "0" + seconds;
  }
  // $("#days").html(days );
  $("#hours").html("<p>" + hours + "</p>");
  $("#minutes").html("<p>" + minutes + "</p>");
  $("#seconds").html("<p>" + seconds + "</p>");
}

function setupFlashSaleSlider() {
  $("#flash-sale-slider").multislider({
    interval: 0,
    autoSlide: false,
    slideAll: true,
    duration: 800,
  });
}
function setupOldBookshelfSlider() {
  $("#old-bookshelf-slider").multislider({
    interval: 0,
    autoSlide: false,
    slideAll: true,
    duration: 800,
  });
}
function setupHotSaleSlider() {
  $("#hot-sale-slider").multislider({
    interval: 0,
    autoSlide: false,
    slideAll: true,
    duration: 800,
  });
}
function setupTabButton(tabLayout, tabItem) {
  var tabButton = $("."+tabLayout+">button");
  tabButton.click(function (e) {
    tabButton.each(function() {
      if( $(this).hasClass('tab-layout-active'))
      {
        $(this).removeClass('tab-layout-active');
      }
    });
    $(this).addClass('tab-layout-active');
    var tabName = $(this).attr('data-tab');
    var tab = $("."+tabItem);
    tab.each(function () {
       $(this).hide();
    });
    $("#"+tabName).show();
  });
}


