<?php
require_once "conecta.php";
$conexion = conecta();
session_start();

// Obtener el id del proyecto que se quiere eliminar
$id_proyecto = $_POST['id_proyecto'];

// Verificar que el id_proyecto es válido
if (isset($id_proyecto) && !empty($id_proyecto)) {
    // Eliminar el proyecto de la base de datos
    $sql_eliminar = "DELETE FROM proyectos WHERE id_proyecto = $1 AND lider_id = $2";
    $stmt = pg_prepare($conexion, "eliminar_proyecto", $sql_eliminar);
    $resultado = pg_execute($conexion, "eliminar_proyecto", [$id_proyecto, $_SESSION['id_alumno']]);

    // Verificar si la eliminación fue exitosa
    if ($resultado) {
        // Redirigir a la página actual para que el alumno vea que el proyecto ha sido eliminado
        echo '<script>alert("Proyecto eliminado correctamente."); window.location.href = "Home_alumno.php";</script>';
    } else {
        // Si hubo un error
        echo '<script>alert("Hubo un error al eliminar el proyecto."); window.location.href = "Home_alumno.php";</script>';
    }
} else {
    echo "No se ha seleccionado un proyecto para eliminar.";
}
?>
