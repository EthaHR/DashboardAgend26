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

if (!empty($_POST["btnmodificar"])) {
    $id_operador         = $_POST["id"] ?? "";
    $nombre_operador     = $_POST["nombre_operador"] ?? "";

    if (
        !empty($nombre_operador)
    ) {
        try {
            $stmt = $conexion->prepare("UPDATE operador SET nombre_operador=? WHERE id_operador=?");
            $stmt->bind_param("ss", $nombre_operador, $id_operador);
            $resultado = $stmt->execute();

            if ($resultado && $stmt->affected_rows > 0) {
                $_SESSION['alerta_edicion'] = "Operador actualizado";
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