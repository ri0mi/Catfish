<?php

require_once "conecta.php";
$conexion=conecta();
$sql = "SELECT * FROM maestros";
    $resultado = pg_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/x-icon" href="favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Cuenta</title>
</head>
<style>
      .return {
            color: blue;
            text-decoration: none; 
            position: absolute;
            top: 20px; 
            left: 20px; 
            font-size: 1.2em;
        }
</style>
<body>
    <h5><a href="Seleccion.php" class="return" style="color:blue">Regresar</a><br><br></h5>
    <div class="container mt-5">
        <h1>Registro Maestros</h1>
                <form action="guardar_maestro.php"method="POST">           
                 <input type="hidden" name="tipo" value="alumno">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" id="nombre" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
    <label class="form-label">Código</label>
    <input type="text" id="id_maestro" class="form-control" name="id_maestro" required maxlength="8" pattern=".{8}" title="El código debe tener exactamente 8 caracteres.">
</div>
                   <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" id="correo" class="form-control" name="correo" required>
            </div>
            <div class="mb-3">
             <label class="form-label">Contraseña</label>
             <input type="password" id="contrasena" class="form-control" name="contrasena" required minlength="8">
             <div id="password-strength" class="form-text"></div>
             </div>
           
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>

        <hr>
</div>
</body>
<script>
    document.getElementById('id_maestro').addEventListener('input', function() {
        // Verificar si el código tiene exactamente 8 caracteres
        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8); // Limitar a 8 caracteres
        }
    });


document.getElementById('contrasena').addEventListener('input', function() {
        // Verificar si el código tiene exactamente 8 caracteres
        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8); // Limitar a 8 caracteres
        }
    });


    const passwordInput = document.getElementById('contrasena');
    const passwordStrengthText = document.getElementById('password-strength');

    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;
        const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

        if (!regex.test(password)) {
            passwordStrengthText.textContent = "La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un carácter especial.";
            passwordStrengthText.style.color = "red";
        } else {
            passwordStrengthText.textContent = "Contraseña segura.";
            passwordStrengthText.style.color = "green";
        }
    });

</script>
</html> 
