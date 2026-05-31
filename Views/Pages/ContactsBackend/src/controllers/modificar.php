<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($conexion)) {
    $rutaConexionGlobal = dirname(__DIR__, 5) . "/Model/Config/Model.php";
    if (file_exists($rutaConexionGlobal)) {
        include $rutaConexionGlobal;
        $conexion = ModelConfig::getConnection();
    }
}

if (!empty($_POST["btnmodificar"])) {
    $id_contacto        = $_POST["id"] ?? "";
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
            $stmt = $conexion->prepare("UPDATE contacto SET nombres=?, apellidos=?, id_empresa=?, id_operador=?, id_grupo=?, telefono_movil=?, telefono_casa=?, correo=?, descripcion_grupo=?, fecha_cumpleanios=?, observaciones=? WHERE id_contacto=?");
            $stmt->bind_param("ssissssssssi", $nombres, $apellidos, $id_empresa, $id_operador, $id_grupo, $telefono_movil, $telefono_casa, $correo, $descripcion_grupo, $fecha_cumpleanios, $observaciones, $id_contacto);
            $resultado = $stmt->execute();

            if ($resultado && $stmt->affected_rows > 0) {
                $_SESSION['alerta_edicion'] = "Contacto actualizado";
                echo "success";
                exit();
            } else {
                echo "error";
            }
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            echo "error: " . $e->getMessage();
        }
    } else {
        echo "campos_vacios";
    }
}
?>

