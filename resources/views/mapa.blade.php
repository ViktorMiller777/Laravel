<!DOCTYPE html>
<html>
<head>
	<title>Maps</title>
    <link rel="stylesheet" href="{{ asset('assets/estilo.css') }}">
</head>
<body>
	<div id="map"></div>

<script>
    function iniciarMap(){
    var coord = {lat:-34.5956145 ,lng: -58.4431949};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}
</script>
<script src="script.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
</body>
</html>