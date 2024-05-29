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
                        <td>{{$user->name}}</td>
                        <td>{{$user->lastname_p}}</td>
                        <td>{{$user->lastname_m}}</td>
                        <td><input type="text" name="latitude" value="{{$user->latitude}}"></td>
                        <td><input type="text" name="longitude" value="{{$user->longitude}}"></td>
                        <td><input type="number" name="active" value="{{$user->active}}" min="0" max="1"></td>
                        <td>
                            <form action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="latitude" value="{{$user->latitude}}">
                                <input type="hidden" name="longitude" value="{{$user->longitude}}">
                                <input type="hidden" name="active" value="{{$user->active}}">
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </td>
                        <td>
                            <form action="#" method="GET">
                                <a href="mapa"><button type="button" class="btn btn-primary">Mapa</button></a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

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
