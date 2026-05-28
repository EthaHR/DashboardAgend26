<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnmodificar"])) {
    $id          = $_POST["id"];
    $dni         = $_POST["dni"] ?? "";
    $nombres     = $_POST["nombres"] ?? "";
    $apellidos   = $_POST["apellidos"] ?? "";
    $fecha_nac   = $_POST["fecha_nac"] ?? "";
    $correo      = $_POST["correo"] ?? "";
    $telefono    = $_POST["telefono"] ?? "";

    if (
        !empty($dni) && !empty($nombres) && !empty($apellidos) && !empty($fecha_nac) &&
        !empty($correo) && !empty($telefono)
    ) {
        try {
            // Modifica los datos del contrato seleccionado
            $resultado = $conexion->query("UPDATE contrato
                        SET dni='$dni',
                            nombres='$nombres',
                            apellidos='$apellidos',
                            fecha_nac='$fecha_nac',
                            correo='$correo',
                            telefono='$telefono'
                        WHERE id_persona=$id");

            if ($resultado) {
                $_SESSION['alerta_edicion'] = "Edición exitosa";
                header("Location: index.php?Pages=Contracts");
                exit();
            } else {
                echo '<div class="alert alert-danger">Error al modificar los datos del contrato</div> <br/>';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<div class="alert alert-danger">Error: El número de contrato ya se encuentra duplicado.</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div><br/>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos vacíos! No se puede guardar un contrato con datos nulos.</div> <br/>';
    }
}
