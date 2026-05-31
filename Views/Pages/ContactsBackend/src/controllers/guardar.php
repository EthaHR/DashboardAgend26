<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (!isset($conexion)) {
    $rutaConexionGlobal = dirname(__DIR__, 5) . "/Model/Config/Model.php";
    if (file_exists($rutaConexionGlobal)) {
        include $rutaConexionGlobal;
        $conexion = ModelConfig::getConnection();
    }
}

if (!empty($_POST["btnregistrar"])) {
    $nombres            = $_POST["nombres"] ?? "";
    $apellidos          = $_POST["apellidos"] ?? "";
    $id_empresa         = $_POST["id_empresa"] ?? "";
    $id_operador        = $_POST["id_operador"] ?? "";
    $id_grupo           = $_POST["id_grupo"] ?? "";
    $telefono_movil     = $_POST["telefono_movil"] ?? "";
    $telefono_casa      = $_POST["telefono_casa"] ?? "";
    $correo             = $_POST["correo"] ?? "";
    $descripcion_grupo  = $_POST["descripcion_grupo"] ?? "";
    $fecha_cumpleanios  = $_POST["fecha_cumpleanios"] ?? "";
    $observaciones      = $_POST["observaciones"] ?? "";

    if (!empty($nombres) && !empty($apellidos) && !empty($id_empresa) && !empty($id_operador) && !empty($id_grupo) && !empty($telefono_movil)) {
        try {
            $stmt = $conexion->prepare("INSERT INTO contacto(nombres, apellidos, id_empresa, id_operador, id_grupo, telefono_movil, telefono_casa, correo, descripcion_grupo, fecha_cumpleanios, observaciones)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssissssssss", $nombres, $apellidos, $id_empresa, $id_operador, $id_grupo, $telefono_movil, $telefono_casa, $correo, $descripcion_grupo, $fecha_cumpleanios, $observaciones);
            $resultado = $stmt->execute();

            if ($resultado) {
                unset($_POST['nombres']);
                unset($_POST['apellidos']);
                unset($_POST['id_empresa']);
                unset($_POST['id_operador']);
                unset($_POST['id_grupo']);
                unset($_POST['telefono_movil']);
                unset($_POST['telefono_casa']);
                unset($_POST['correo']);
                unset($_POST['descripcion_grupo']);
                unset($_POST['fecha_cumpleanios']);
                unset($_POST['observaciones']);

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['alerta_registro'] = "Contacto registrado correctamente en el sistema";
                echo '<div class="alert alert-success">Contacto registrado correctamente en el sistema</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error interno al procesar el contacto</div><br/>';
            }
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            echo '<div class="alert alert-danger">Error en base de datos: ' . $e->getMessage() . '</div><br/>';
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos obligatorios vacíos! Complete nombres, apellidos, empresa, operador, grupo y teléfono móvil.</div><br/>';
    }
}


