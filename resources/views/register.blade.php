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
        <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    </head>

    <body>
    <section class="vh-120 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-1">Register</h2>
                            <p class="text-white-50 mb-5">Porfavor ingresa tus datos!</p>
                            <form action="{{ route('registerpost') }}" method="POST">
                                @csrf
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="text" name="name" id="name" class="form-control form-control-lg" />
                                    <label class="form-label" for="name">Nombre</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="text" name="lastname_p" id="lastname_p" class="form-control form-control-lg" />
                                    <label class="form-label" for="lastname_p">Apellido paterno</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="text" name="lastname_m" id="lastname_m" class="form-control form-control-lg" />
                                    <label class="form-label" for="lastname_m">Apellido materno</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="number" name="age" id="age" class="form-control form-control-lg" />
                                    <label class="form-label" for="age">Edad</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="date" name="birthdate" id="birthdate" class="form-control form-control-lg" />
                                    <label class="form-label" for="birthdate">Cumpleaños</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" />
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="password">Constraseña</label>
                                </div>
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg" />
                                    <label class="form-label" for="phone">Telefono</label>
                                </div>
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Registrar</button>
                            </form>
                        </div>
                        <div>
                        <p class="mb-0">Ya tienes una cuenta? <a href="/" class="text-white-50 fw-bold">Iniciar sesion!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    </body>
</html>
