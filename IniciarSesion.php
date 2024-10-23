<?php 
session_start();
require"conecta.php";



    if(isset($_POST['nombre'])&& isset($_POST['contrasena'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $Usuario = validate($_POST['nombre']); 
        $Clave = validate($_POST['contrasena']); 

        if (empty($Usuario)) {
            header("Location: index.php?Error=El Usuario es requerido");
            exit();
        }elseif(empty($Clave)){ 
            header("Location: index.php?Error=La Contrasena es requerida");
            exit();
        }else{
            $Clave = md5($Clave);
            $Sql = "SELECT * FROM alumnos WHERE nombre = '$Usuario' AND contrasena = '$Clave'";
            $result = mysqli_query($conexion, $Sql);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['nombre']=== $Usuario && $row['contrasena']===$Clave) {
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['id_alumno'] = $row['id_alumno'];
                    header("Location: Inicio.php");
                    exit();
                }else{
                    header("Location: index.php?Error=El usuario o la contrasena son incorrectos");
                    exit();
                }
            } else{
                header("Location: index.php?Error=El usuario o la contrasena son incorrectos");
                    exit();
            }
        }

        

    } else {
        header("Location: index.php");
                    exit();
    }



