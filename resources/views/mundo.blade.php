<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="map" style="width: 100%; height: 100vh;"></div>

    <script>
        function iniciarMap(){
                var map = new google.maps.Map(document.getElementById('map'),{
                zoom: 10,
                center: {lat:25.59887027853254 ,lng: -103.47985881534363}
                });
                @foreach($users as $user) //el user en verde es el que se manda desde el controlador
                    var coord = {lat:{{$user->latitude}},lng:{{$user->longitude}}}; //se enceirran en doble corchete para que se pueda leer la variable
                    var marker = new google.maps.Marker({
                        position: coord,
                        map: map
                    });
                @endforeach
            
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
    
    
</body>
</html>

