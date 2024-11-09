<?php
session_start();
$nombre = $_SESSION['nombre'];
$id_alumno = $_SESSION['id_alumno']; // Pasa el ID de usuario en la sesión

// Conectar a la base de datos
require_once "conecta.php";
$conexion = conecta();

// Consulta para obtener los proyectos del usuario
$sql = "SELECT * FROM proyectos WHERE lider_id = $id_alumno";

$resultado = pg_query($conexion, $sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Linkproject</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="estilos.css"> 
</head>
<style>
    /* Contenedor general de la sección de proyectos */
.project-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 2rem;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
}

/* Botones de acciones (crear, eliminar) */
.project-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 1.5rem;
}

.project-btn {
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
    color: #fff;
    background-color: #4caf50;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.project-btn:hover {
    background-color: #45a049;
}

/* Vista de proyectos */
.project-view {
    text-align: center;
    width: 100%;
    min-height: 400px; /* Establece un alto mínimo para dar más presencia */
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 1rem; /* Añade un poco de margen superior */
    box-sizing: border-box;
}

.project-view h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: flex;
}

.project-view p {
    font-size: 1rem;
    color: #666;
}

</style>
<body>

<div class="navbar">
    <div>
        <a href="Home_alumno.php">Inicio</a>
        <a href="Equipo.php">Equipo</a>
        <a href="Gestor.php">Gestor de Proyectos</a>
        <a href="Visualizador.php">Proyectos</a>
        <a href="Intermedio.php">Directorio</a>
    </div>
    <div>
        <i class="fas fa-bell notification-icon" onclick="toggleNotificationDropdown()"></i>
        <i class="fas fa-user-circle profile-icon" onclick="toggleDropdown()"></i>
        <div class="dropdown" id="dropdownMenu">
            <a href="verAlumno.php">Perfil</a>
            <a href="CerrarSesion.php">Cerrar Sesion</a>
        </div>
    </div>
</div>

<div class="welcome">
    <h1>Bienvenido <?php echo htmlspecialchars($nombre); ?></h1>
</div>
<div class="project-section">
    <div class="project-actions">
        <a href="Crear.php" class="project-btn">Crear Proyecto</a>
        
    </div>

    <div class="project-view">
        <h2>Tus Proyectos</h2>
        <?php
        // Verifica si hay resultados
        if (pg_num_rows($resultado) > 0) {
            // Si hay proyectos, los muestra
            while ($fila = pg_fetch_assoc($resultado)) {
                echo "<div style='font-size: 18px; margin-top: 10px;'>";
                echo "<div style='border: 1px solid #ccc; padding: 10px;'>";
                echo "<ul style='list-style-type: none; padding: 0;'>";
                echo "<li> <img src='" . htmlspecialchars($fila["logo"]) . "' alt='Logo' style='width: 200px; height: 200px;'> </li>";
                echo "<li><strong>Nombre del Proyecto:</strong> " . $fila['nombre'] . "</li>";
                echo "<li><strong>Descripción:</strong> " . $fila['descripcion'] . "</li>";
                echo "<li><strong>Asesor:</strong> " . $fila['asesor'] . "</li>";
                echo "<li><strong>Conocimiento:</strong> " . $fila['conocimientos'] . "</li>";
                echo "<li><strong>Innovacion:</strong> " . $fila['nivel_innovacion'] . "</li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";

                echo "<form action='eliminar_proyecto.php' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='id_proyecto' value='" . htmlspecialchars($fila['id_proyecto']) . "'>";
                echo "<input type='submit' value='Eliminar Proyecto' style='background-color: #ff4c4c; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px;' onclick=\"return confirm('¿Estás seguro de eliminar este proyecto?');\">";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // Si no hay proyectos, muestra un mensaje
            echo "<p>No tienes proyectos aún.</p>";
        }
        ?>
    </div>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    function toggleNotificationDropdown() {
     
        alert('Aquí se mostrarían las notificaciones.'); // Ejemplo de alerta
    }

    // Cerrar el menú desplegable si se hace clic fuera de él
    window.onclick = function(event) {
        if (!event.target.matches('.profile-icon') && !event.target.matches('.notification-icon')) {
            var dropdown = document.getElementById("dropdownMenu");
            dropdown.style.display = "none"; // Oculta el menú desplegable
        }
    }
</script>

</body>
</html>


