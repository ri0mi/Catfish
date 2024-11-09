<?php
// Incluye la conexión a la base de datos
require_once "conecta.php";
$conexion = conecta();

// Incluye la conexión a la base de datos
require_once "conecta.php";
$conexion = conecta();

// Obtener los valores del formulario de manera segura
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$area = $_POST['area'];
$asesor = $_POST['asesor'];
$conocimientos = $_POST['conocimientos'];
$nivel_innovacion = $_POST['nivel_innovacion'];
$lider_id = $_POST['lider_id'];

// Manejo del archivo logo
$directorio = "logos/";
$logo = $_FILES['logo']['name'];
$logo_temp = $_FILES['logo']['tmp_name'];
$ruta_logo = $directorio . basename($logo);

// Mover el archivo a la carpeta de destino
if (move_uploaded_file($logo_temp, $ruta_logo)) {
    // Usar una consulta preparada
    $sql = "INSERT INTO proyectos (nombre, descripcion, areas, asesor, conocimientos, nivel_innovacion, logo, lider_id)
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
    
    $stmt = pg_prepare($conexion, "insert_project", $sql);
    $resultado = pg_execute($conexion, "insert_project", [
        $nombre, $descripcion, $area, $asesor, $conocimientos, $nivel_innovacion, $ruta_logo, $lider_id
    ]);

    if ($resultado) {
         header("Location:Home_alumno.php"); // Redirige a la página deseada
         exit(); // Detiene la ejecución del script
    } else {
        echo "Error al crear el proyecto.";
    }
} else {
    echo "Error al subir la imagen.";
}

?>