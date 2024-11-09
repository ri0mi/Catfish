<?php
require_once "conecta.php";
$conexion = conecta();
session_start(); // Iniciar la sesión para obtener el id_alumno
// Suponiendo que el id_alumno está almacenado en la sesión
$id_alumno = $_SESSION['id_alumno'];
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
    <h5><a href="Home_alumno.php" class="return" style="color:blue">Regresar</a><br><br></h5>
    <div class="container mt-5">
        <h1>Perfil Alumno</h1>
        <form action="perfil_alumno.php" method="POST" enctype="multipart/form-data">           
            <input type="hidden" name="tipo" value="alumno">
            <div class="mb-3">
                <label class="form-label">Carrera</label>
                <input type="text" id="carrera" class="form-control" name="carrera" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contacto</label>
                <input type="text" id="contacto" class="form-control" name="contacto" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Laboratorio</label>
                <input type="text" id="laboratorio" class="form-control" name="laboratorio" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Clave</label>
                <input type="text" id="clave" class="form-control" name="clave" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Horario</label>
                <input type="text" id="horario" class="form-control" name="horario" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Habilidades</label>
                <input type="text" id="habilidades" class="form-control" name="habilidades" required>
            </div>
            <div class="mb-3">
                <label for="logo" class="campo">Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>
        <hr>
    </div>
</body>
</html>
