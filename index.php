
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cluster Map</title>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js" type="text/javascript"></script>
    <style>
      body{
        padding:0;
        margin:0;
        font: .8em Verdana, Arial, Tahoma, sans-serif;
      }
      #map{
        height:750px;
        width:100%;
      }
      #map-container {
        padding: 6px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc #ccc #999 #ccc;
        -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
        width: 98%;
      }
      .map-compact{
        max-width:700px;
        max-height:500px;
        border: 2px solid #ccc;
      }
      .map-container-compact{
        max-width:705px;
      }
    </style>
    <script type="text/javascript">
      var map;
      var markers = [];
      var infowindow = new google.maps.InfoWindow();

      var locations = [
            [1176,47.7771162,-116.7955848],
            [1179,43.611205,-116.206492],
            [1180,43.6468282,-116.266549],
            [1184,42.859824,-112.443284],
            [1185,43.5956343,-114.3457667],
            [1187,42.944591,-115.311806],
            [1190,45.1752265,-113.8929893],
            [1194,43.5221362,-114.3172418],
            [1195,43.644232,-116.26701],
            [1196,47.7121524,-116.8032732],
            [1199,43.558423,-116.769645],
            [1204,43.4664344,-116.6676954],
            [1209,43.622482,-116.226826],
            [1212,47.6744292,-116.7838873],
            [1224,47.7032104,-116.7834193],
            [1225,46.4176913,-116.9870599],
            [1232,43.6872404,-114.3682851],
            [1237,43.6851259,-114.3669669],
            [1240,43.6421036,-116.2081372],
            [1243,47.7187013,-116.8942952],
            [1253,42.965614,-115.443908],
            [1261,43.625014,-116.246915],
            [1268,43.596615,-116.718836],
            [1271,47.701837,-116.834145],
            [1280,47.655409,-117.015739],
            [1283,47.712077,-116.799549],
            [1290,43.647386,-116.224156],
            [1295,44.9089252,-116.0975693],
            [1297,43.5997326,-111.1112745],
            [1298,43.578648,-116.78627],
            [1299,46.4265572,-117.0083975],
            [1302,43.632576,-116.275534],
            [1314,43.6176412,-116.2141481],
            [1322,48.2954435,-116.5473894],
            [1323,42.7127802,-114.8553122],
            [1324,42.5874904,-114.8099088],
            [1325,43.671069,-116.402881],
            [1327,42.351836,-114.301682],
            [1328,44.5049268,-114.2355923],
            [1329,44.7292708,-116.4377118],
            [1330,42.8588884,-112.447434],
            [1331,44.0751148,-116.9350504],
            [1332,43.579099,-116.558992],
            [1333,43.647544,-116.27344],
            [1334,42.5763726,-114.4602915],
            [1335,44.0644155,-116.9293831],
            [1336,44.4930619,-116.01261],
            [1337,42.5561028,-114.4682842],
            [1338,44.2466996,-116.9581766],
            [1339,42.5708601,-113.7339578],
            [1340,43.6163922,-116.2027668],
            [1342,43.5866989,-116.5393165],
            [1343,42.7727802,-114.7040982],
            [1344,42.537814,-113.794064],
            [1345,43.6675249,-116.6816121],
            [1346,43.675614,-116.912361],
            [1347,43.686977,-114.371952],
            [1348,42.7242128,-114.5199076],
            [1355,43.616294,-116.2026919],
            [1357,44.0754797,-116.9348668],
            [1358,43.58822,-116.793204],
            [1359,42.564691,-114.604884],
            [1360,43.6697562,-116.6986001],
            [1361,43.4644302,-114.2617445],
            [1364,43.620536,-116.232213],
            [1365,43.6809347,-114.3644168],
            [1366,42.864466,-112.444164],
            [1367,42.9310678,-114.4096664],
            [1368,42.406315,-113.5783814],
            [1369,43.5776876,-116.193464],
            [1370,46.4875605,-115.7989265],
            [1371,42.894036,-112.441027],
            [1373,37.8551833,-96.8499825],
            [1374,43.621254,-116.285467],
            [1375,46.7326183,-117.0246528],
            [1376,43.596208,-116.390291],
            [1377,43.593472,-116.587311],
            [1378,43.608995,-116.197508],
            [1379,43.9002355,-116.20344],
            [1381,43.9746177,-116.90268],
            [1382,43.6805409,-114.3640766],
            [1383,43.607763,-116.603533],
            [1384,43.498837,-112.001354],
            [1385,42.5898024,-114.4601416],
            [1386,42.0130058,-111.8015388],
            [1387,43.5900814,-116.2671316],
            [1388,44.7259041,-116.4394012],
            [1389,42.5631093,-114.4388847],
            [1390,43.6338961,-116.2709102],
            [1392,43.634165,-116.646771],
            [1393,43.8734348,-116.5000284],
            [1394,42.6156871,-113.6720916],
            [1397,43.9661111,-111.6844444],
            [1398,43.5983945,-116.2136108],
            [1399,43.5111207,-112.0161224],
            [1400,46.7330816,-117.0148976],
            [1401,42.548872,-114.450706],
            [1402,42.537649,-113.780903],
            [1403,43.6000219,-116.1933486],
            [1405,42.0941018,-111.876875],
            [1406,45.753452,-116.315653],
            [1407,43.6918859,-116.489992],
            [1408,46.4237243,-117.0009021],
            [1409,43.5900634,-116.2658883],
            [1410,44.7311353,-116.1028401],
            [1411,43.588323,-116.529529],
            [1412,43.669416,-116.67992],
            [1413,43.8376004,-111.7781019],
            [1414,43.2198791,-112.3421011],
            [1415,42.8254335,-114.4335266],
            [1416,44.5147255,-111.2996359],
            [1417,43.630866,-116.202995],
            [1418,43.9037116,-116.9243264],
            [1419,42.550021,-114.478571],
            [1420,43.5760239,-116.274629],
            [1421,42.7241673,-114.5288892],
            [1422,43.9132029,-113.6144736],
            [1423,43.467522,-112.003148],
            [1424,43.6918329,-116.4645991],
            [1425,43.6022386,-116.2371153],
            [1426,42.854228,-112.442169],
            [1428,42.9458958,-112.4665155],
            [1429,42.9250836,-114.9684632],
            [1430,43.566832,-116.5641797],
            [1432,43.679547,-111.906763],
            [1433,43.612178,-116.39125],
            [1434,43.691227,-116.334667],
            [1436,43.48318,-112.056229],
            [1437,43.604975,-116.397312],
            [1438,43.6217852,-116.2186593],
            [1439,43.5930729,-116.193949],
            [1442,43.6043259,-116.2434629],
            [1443,46.3897613,-116.9890981],
            [1444,43.6664249,-116.692909],
            [1446,43.5642228,-116.5728247],
            [1449,43.633387,-116.253689],
            [1450,42.2298678,-111.2634005],
            [1451,43.1877135,-112.3446804],
            [1452,48.2402072,-116.8935579],
            [1453,43.8252487,-111.7895072],
            [1454,42.7241217,-114.5242275],
            [1455,48.2760802,-116.551992],
            [1456,43.5961209,-116.193083],
            [1457,42.8649244,-112.4459673],
            [1458,43.1919721,-112.3414596],
            [1459,43.6647663,-116.6905536],
            [1461,43.6516862,-116.6712311],
            [1462,43.579161,-116.172769],
            [1463,43.6496695,-116.2797695],
            [1464,43.6830057,-114.3643388],
            [1467,42.7231549,-114.5174375],
            [1468,46.4078053,-117.021797],
            [1469,44.9105972,-116.1009361],
            [1470,43.5653015,-116.5729968],
            [1471,43.616768,-116.930722],
            [1473,42.542717,-113.7932431],
            [1474,42.6684043,-113.6011401],
            [1475,42.544867,-113.793648],
            [1476,42.537811,-113.79627],
            [1479,43.4885245,-116.4057607],
            [1480,43.611487,-116.5932059],
            [1481,42.526298,-113.792321],
            [1482,43.583243,-116.556939],
            [1484,43.6145361,-116.2013916],
            [1485,42.5780886,-114.4603468],
            [1486,43.6680225,-116.6810506],
            [1487,46.1403174,-115.9788537],
            [1488,43.1311579,-115.692717],
            [1489,46.3777343,-116.9719947],
            [1490,43.6462179,-116.95169],
            [1492,46.7335277,-117.0013502],
            [1494,43.687671,-116.35495],
            [1495,48.274166,-116.5477179],
            [1497,43.5792901,-116.5594101],
            [1498,45.9268143,-116.128407],
            [1499,42.5336322,-114.364631],
            [1501,43.5902492,-116.3128768],
            [1502,46.7376573,-117.0015188]
          ];


      function initialize() {
        geocoder = new google.maps.Geocoder();
        var center = new google.maps.LatLng(43.474144,-112.03866);
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: center,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        markMultiple();
      }

      function markMultiple(){
        $.getJSON('maps.json', function(data) {
          $.each(data, function(i, obj) {
        var latLng =  new google.maps.LatLng(obj.lat,obj.lng);
        var content = obj.id + ':' + obj.lat + ',' + obj.lng;
        markMap(latLng, content);
    });


    });

        var markerCluster = new MarkerClusterer(map, markers);
      }

      function markMap(position, content){
        var marker = new google.maps.Marker({
          position: position
        });
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(content);
          infowindow.open(map, marker);
        });

        markers.push(marker);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>



  </head>
  <body>
    <div id="map-container">
      <div id="map"></div>
    </div>
  </body>
</html>




<html>
<head>
<title>Eg. Google Maps Marker using External JSON</title>
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0 }
#map_canvas { height: 100% }
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbz87GBJdm8uhf8kLMRD4i7TBRFyQRbQ4&callback=initMap">
</script>

</script>
<script type="text/javascript">
function initialize() {

var infoWindow = new google.maps.InfoWindow();

var map = new google.maps.Map(document.getElementById("map_canvas"), {
  center: new google.maps.LatLng(57.9, 14.6),
  zoom: 6,
  mapTypeId: google.maps.MapTypeId.ROADMAP

});


for (var i = 0, length = json.length; i < length; i++) {
  var data = json[i],
      latLng = new google.maps.LatLng(data.lat, data.lng);

  // Creating a marker and putting it on the map
  var marker = new google.maps.Marker({
    position: latLng,
    map: map,
    title: data.title
  });
}


// Creating a closure to retain the correct data
//Note how I pass the current data in the loop into the closure (marker, data)
(function(marker, data) {

  // Attaching a click event to the current marker
  google.maps.event.addListener(marker, "click", function(e) {
    infoWindow.setContent(data.description);
    infoWindow.open(map, marker);
  });

})(marker, data);
// Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
          });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});




}

</script>
</head>
<body onload="initialize()">
<form id="form1" runat="server">
<div id="map_canvas" style="width: 100%; height: 100vh"></div>
</form>
<script>
var json = [
  {
    "title": "Erfaren Webudvikler",
    "lat":55.403756,
    "lng": 10.402370,
    "description": "Radoor & Co søger erfaren webudvikler til webbuerau i Odense"
  },
  {
    "title": "EAL Ny Miko søges",
    "lat": 55.403743,
    "lng": 10.379666,
    "description": "Vi skal bruge en ny 12-tal Miko"
  },
  {
    "title": "Copenhagen",
    "lat": 55.7,
    "lng": 12.6,
    "description": "Copenhagen is the capital of Denmark and its most populous city, with a metropolitan population of 1,931,467 (as of 1 January 2012)."
  }
]
</script>

</body>

</html>
