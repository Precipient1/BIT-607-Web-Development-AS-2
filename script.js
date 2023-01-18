// Get the carousel element
const carousel = document.getElementById("bg-carousel");

// Next button
const nextButton = document.getElementById("next-button");
nextButton.addEventListener("click", () => {
  carousel.carousel("next");
});

// Prev button
const prevButton = document.getElementById("prev-button");
prevButton.addEventListener("click", () => {
  carousel.carousel("prev");
});

// Pause button
const pauseButton = document.getElementById("pause-button");
pauseButton.addEventListener("click", () => {
  carousel.carousel("pause");
});

// Play button
const playButton = document.getElementById("play-button");
playButton.addEventListener("click", () => {
  carousel.carousel("cycle");
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

window.addEventListener('load', initMap);

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: keriKeriLat, lng: keriKeriLng},
    zoom: 15
  });

  function handleError(){
    document.getElementById("map-error").innerHTML = "An error occurred while loading the map. Please try again later.";
  }

  keriKeriMarker = new google.maps.Marker({
    position: {lat: keriKeriLat, lng: keriKeriLng},
    map: map,
    animation: google.maps.Animation.BOUNCE,
    icon: "C:\Users\Laptop\OneDrive\Desktop\BIT 607 Web Development AS 2\img\location icon.gif"
  });
  keriKeriMarker.setTitle("Keri Keri, Bay of Islands, New Zealand");
  keriKeriMarker.setMap(map);
}
google.maps.event.addListener(keriKeriMarker, 'click', function() {
  var infowindow = new google.maps.InfoWindow({
    content: "Keri Keri is a small town located in the Bay of Islands, New Zealand. It's known for its beautiful beaches, historic sites, and marine activities."
  });
  infowindow.open(map, keriKeriMarker);
});
