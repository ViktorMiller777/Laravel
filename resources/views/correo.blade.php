<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Codigo de verificacion</h1>
        <form action="/home/correo/bd" method="POST">
            @csrf
            <div class="mb-3">
                <label for="verificationCode" class="form-label">Código de Verificación</label>
                <input type="text" class="form-control" id="verificationCode" name="verificationCode" maxlength="4" required>
                @if (session('error'))
                    <div class="text-danger">{{ session('error') }}</div>
                @endif  
            </div>
            <button type="submit" class="btn btn-primary">Verificar</button>
        </form>
    
</body>
</html>