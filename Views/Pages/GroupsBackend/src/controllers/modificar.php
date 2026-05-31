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
    $id_grupo         = $_POST["id"] ?? "";
    $nombre_grupo     = $_POST["nombre_grupo"] ?? "";

    if (
        !empty($nombre_grupo)
    ) {
        try {
            $stmt = $conexion->prepare("UPDATE grupo_contacto SET nombre_grupo=? WHERE id_grupo=?");
            $stmt->bind_param("ss", $nombre_grupo, $id_grupo);
            $resultado = $stmt->execute();

            if ($resultado && $stmt->affected_rows > 0) {
                $_SESSION['alerta_edicion'] = "Grupo actualizado";
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