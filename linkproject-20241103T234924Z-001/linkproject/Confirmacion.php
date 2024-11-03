<?php
require_once "conecta.php";
$conexion = conecta();
session_start(); // Iniciar sesión para acceder a las variables de sesión

//Instalar PAPERCUT 
//Agregar a la base de datos tanto en la tabla de alumnos como de maestros la columna de 'codigo_verificacion' de la siguiente manera 
//MAESTROS : ALTER TABLE maestros ADD COLUMN codigo_verificacion CHARACTER VARYING(20) DEFAULT 'no_verificado';
//ALUMNOS : ALTER TABLE alumnos ADD COLUMN codigo_verificacion CHARACTER VARYING(20) DEFAULT 'no_verificado';


// Verificar si el código y el nombre están en la sesión
if (!isset($_SESSION['codigo_verificacion']) || !isset($_SESSION['nombre']) || !isset($_SESSION['correo'])) {
    echo "No se ha enviado un código de verificación. Por favor, regresa a la página de registro.";
    exit();
}

// Variables de sesión
$codigo_verificacion = $_SESSION['codigo_verificacion'];
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo'];
$verificado = false; // Variable para saber si la cuenta está verificada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_ingresado = $_POST['codigo_verificacion'];

    // Verificar si el código ingresado es correcto
    if ($codigo_ingresado == $codigo_verificacion) {
        $sql_update_alumnos = "UPDATE alumnos SET codigo_verificacion = 'verificado' WHERE correo = '$correo'";
        $sql_update_maestros = "UPDATE maestros SET codigo_verificacion = 'verificado' WHERE correo = '$correo'";
         // Ejecutar la consulta para alumnos
        $result_alumnos = pg_query($conexion, $sql_update_alumnos);
        // Ejecutar la consulta para maestros
        $result_maestros = pg_query($conexion, $sql_update_maestros);

        if ($result_alumnos && $result_maestros) {
            $verificado = true;
            // Eliminar el código de la sesión después de la verificación
            unset($_SESSION['codigo_verificacion']);
            unset($_SESSION['nombre']);
            unset($_SESSION['correo']);
        } else {
            echo "<h2>Error al actualizar el estado de verificación. Intenta de nuevo.</h2>";
        }
    } else {
        echo "<h2>El código ingresado no es válido. Intenta de nuevo.</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Confirmar Código de Verificación</title>
</head>
<body>
    <div class="container mt-5">
        
        <?php if ($verificado): ?>
            <!-- Mensaje de verificación exitosa -->
            <h2>¡Gracias, <?php echo $nombre; ?>! Tu cuenta ha sido verificada con éxito.</h2>
          <a href="IniciarSesion.php" class="btn btn-primary">Iniciar Sesión</a>
        <?php else: ?>
            <!-- Formulario de verificación solo si no ha sido verificado -->
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="codigo_verificacion" class="form-label"><h2>Código de Verificación</h2></label>
                     <h3>Se ha enviado un codigo de verificacion al correo <?php echo $correo ?>.</h3>
                    <input type="text" class="form-control" id="codigo_verificacion" name="codigo_verificacion" required>
                </div>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </form>
        <?php endif; ?>

        <hr>
    </div>
</body>
</html>
