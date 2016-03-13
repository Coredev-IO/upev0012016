<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>


      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }

      #map-canvas{
        margin-top: 50px;
      }

      @media (max-width: 767px) {

        #map-canvas{
        margin-top: 50px;
      }

    }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
function initialize() {

var styles = [
  {
    stylers: [
      { hue: "#0ABF6D" },
      { saturation: 20 }
    ]
  },{
    featureType: "road",
    elementType: "geometry",
    stylers: [
      { lightness: 100 },
      { visibility: "simplified" }
    ]
  },{
    featureType: "road",
    elementType: "labels",
    stylers: [
      { visibility: "on" }
    ]
  }
];



  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng(19.395718, -99.091387),
    styles: styles
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>