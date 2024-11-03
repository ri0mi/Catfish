<?php 
session_start();
require "conecta.php";
$conexion = conecta();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Inicio-Linkproject</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Asegúrate de tener estilos adecuados -->
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?></h1>
    <p>Contenido de la página del maestro aquí.</p>

    <!-- Botón de cerrar sesión -->
    <form action="CerrarSesion.php" method="post"> 
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
