$(function () {
  var map;
  map = new google.maps.Map(document.getElementById('mapid'), {
    center: { lat: 37.746199373382595, lng: -3.91077589888214 },
    zoom: 13,
  });
  var marker = new google.maps.Marker({
    position: { lat: 37.746199373382595, lng: - 3.91077589888214},
    map: map,
    title: "AlquiGame",
  });
});
