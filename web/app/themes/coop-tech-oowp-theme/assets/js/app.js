$(document).foundation();

var elem = new Foundation.Sticky($('.top-bar'));

window.app = {
  apiUrl: 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw',

  tileLayerOptions: {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' + '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: 'mapbox.streets'
  },

  createMapSingleMarker: function(mapId, lat, lng, zoom, markerText) {
    var mymap = L.map(mapId).setView([lat, lng], zoom);

    L.tileLayer(window.app.apiUrl, window.app.tileLayerOptions).addTo(mymap);

    var marker = L.marker([lat, lng]).addTo(mymap);
    marker.bindPopup(markerText);
  },

  createMapMultiMarker: function(mapId, lat, lng, zoom, markersArray) {
    var mymap = L.map(mapId).setView([lat, lng], zoom);

    L.tileLayer(window.app.apiUrl, window.app.tileLayerOptions).addTo(mymap);

    markersArray.forEach(function(markerVar) {
      var marker = L.marker([markerVar.lat, markerVar.lng]).addTo(mymap);
      marker.bindPopup(markerVar.markerText);
    });
  }

};
