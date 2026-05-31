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
    $id_empresa         = $_POST["id"] ?? "";
    $nombre_empresa     = $_POST["nombre_empresa"] ?? "";
    $direccion          = $_POST["direccion"] ?? "";
    $telefono           = $_POST["telefono"] ?? "";

    if (
        !empty($nombre_empresa) && !empty($direccion) && !empty($telefono)
    ) {
        try {
            $stmt = $conexion->prepare("UPDATE empresa SET nombre_empresa=?, direccion=?, telefono=? WHERE id_empresa=?");
            $stmt->bind_param("sssi", $nombre_empresa, $direccion, $telefono, $id_empresa);
            $resultado = $stmt->execute();

            if ($resultado && $stmt->affected_rows > 0) {
                $_SESSION['alerta_edicion'] = "Empresa actualizada";
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