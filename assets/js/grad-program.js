$(document).ready(function() {
  // initializing carousel slick plugin on grad-program page
  //$('#carousel-awards').slick({
  //	speed: 1500
  //});
  /*
	$.fn.exists = function(){return this.length>0;}
	if ( $('#carousel-awards').exists()) {
		$('#carousel-awards').slick({
			speed: 1500
		});
	}
*/
  // accordion functionality
  var acc = document.getElementsByClassName("acc");

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }

  // open overviw tab when page loads
  if ($("#tabDefaultOpen")[0]) {
    document.getElementById("tabDefaultOpen").click();
  }
  /*
    // tab scrolls to content on mobile
    $(".overview-btn").click(function() {
      if ($(window).width() < 769) {
        $("html, body").animate(
          {
            scrollTop: $("#Overview").offset().top
          },
          1000
        );
      }
    });

    $(".courses-btn").click(function() {
      if ($(window).width() < 769) {
        $("html, body").animate(
          {
            scrollTop: $("#Courses").offset().top
          },
          1000
        );
      }
    });

    $(".tuition-btn").click(function() {
      if ($(window).width() < 769) {
        $("html, body").animate(
          {
            scrollTop: $("#Tuition").offset().top
          },
          1000
        );
      }
    });

    $(".apply-btn").click(function() {
      if ($(window).width() < 769) {
        $("html, body").animate(
          {
            scrollTop: $("#Apply").offset().top
          },
          1000
        );
      }
    });

    $(".why-messiah-btn").click(function() {
      if ($(window).width() < 769) {
        $("html, body").animate(
          {
            scrollTop: $("#Messiah").offset().top
          },
          1000
        );
      }
    });
  });
  */
  $(".tab-btn").click(function () {
    if ($(window).width() < 769) {
      $('html, body').animate({
        scrollTop: $("#Content").offset().top
      }, 1000);
    }
  });

// tab functionality
  function openTabContent(evt, eventName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(eventName).style.display = "block";
    evt.currentTarget.className += " active";
  }

});