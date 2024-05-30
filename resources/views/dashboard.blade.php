<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{ asset('assets/dash.css') }}">
    </head>

    <body>
        <center><h1>-- Welcome to Van der linde band --</h1><center>
        <div class="container">
            <div id="listaUser" class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Activo</th>
                        <th>Actualizar</th>
                        <th>Localizacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <form action="/dashboard/user/{{ $user->id }}" method="POST">
                        @csrf
                        @method('PUT')
                            <td>{{$user->name}}</td>
                            <td>{{$user->lastname_p}}</td>
                            <td>{{$user->lastname_m}}</td>
                            <td><input name="latitude" value="{{$user->latitude}}"></td>
                            <td><input name="longitude" value="{{$user->longitude}}"></td>
                            <td><input name="active" value="{{$user->active}}"></td>
                            <td><button type="submit" class="btn btn-primary">Guardar</button></td>
                            <td>   
                            </form>
                                <form action="/home/mapa/{{ $user->id }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Mapa</button>
                                </form>
                            </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="/home/mundo" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary">Mundo</button>
            </form><br>
            </div>
        </div>
        <form action="/logout" method="GET">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar sesion</button>
        </form>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
