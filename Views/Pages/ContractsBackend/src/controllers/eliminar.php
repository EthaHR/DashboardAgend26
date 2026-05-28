<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    try {
        // Apunta directamente a la tabla contrato
        $stmt = $conexion->prepare("DELETE FROM contrato WHERE id_persona = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['alerta_eliminacion'] = "Eliminación Exitosa";
            header("Location: index.php?Pages=Contracts");
            exit();
        } else {
            echo "<div class='alert alert-warning'>El contrato no existe o ya fue eliminado.</div><br />";
        }
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        echo '<div class="alert alert-danger">Error al intentar eliminar el contrato: ' . $e->getMessage() . '</div><br />';
    }
}
