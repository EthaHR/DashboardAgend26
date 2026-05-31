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

if (!empty($_GET["delete"])) {
    $id = $_GET["delete"];

    try {
        $stmt = $conexion->prepare("DELETE FROM contacto WHERE id_contacto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['alerta_eliminacion'] = "Contacto eliminado exitosamente";
            echo "success";
        } else {
            echo "error";
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>

