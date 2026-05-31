<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir conexión
$rutaConexionGlobal = dirname(__DIR__, 5) . "/Model/Config/conexion.php";

if (file_exists($rutaConexionGlobal)) {
    include $rutaConexionGlobal;
} else {
    die("Error: No se encontró el archivo de conexión");
}

if (!empty($_GET["delete"])) {
    $id = $_GET["delete"];

    try {
        $stmt = $conexion->prepare("DELETE FROM operador WHERE id_operador = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['alerta_eliminacion'] = "Eliminación Exitosa";
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