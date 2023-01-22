// Get the carousel element
const carousel = document.getElementById("bg-carousel");

$(document).ready(function(){
    $("#bg-carousel").carousel();
  });

$(document).ready(function(){
  $('.carousel').on('swipeleft', function() {
    $(this).carousel('next');
  });
  $('.carousel').on('swiperight', function() {
    $(this).carousel('prev');
  });
});

document.getElementById("back-to-top").addEventListener("click", function () {
    window.scrollTo(0, 0);
});

document.addEventListener("scroll", function () {
    if (window.scrollY > 100) {
      document.getElementById("back-to-top").classList.add("show");
    } else {
      document.getElementById("back-to-top").classList.remove("show");
    }
});

// form validation
const form = document.getElementById("reservationForm");
form.addEventListener("submit", (e) => {
  e.preventDefault();
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const phone = document.getElementById("phone").value;
  const date = document.getElementById("date").value;
  const time = document.getElementById("time").value;
  const guests = document.getElementById("guests").value;

  if (name === "" || email === "" || phone === "" || date === "" || time === "" || guests === "")
    {
        alert("Please fill out all required fields.");
    }
    else
    {
    form.submit();
    alert("Reservation submitted successfully!");
    }
}
);

var keriKeriLat = -35.2278;
var keriKeriLng = 174.3447;
var keriKeriMarker;

// Initialize and add the map
function initMap() {
  // The location of Uluru
  const haukai = { lat: keriKeriLat, lng: 174.3447 };
  // The map, centered at haukai restaurant
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: haukai,
  });

  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: haukai,
    map: map,
  });
}

window.initMap = initMap;