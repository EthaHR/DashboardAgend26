<?php
$nombre_empresa = $direccion = $telefono = "";

if (!empty($_POST["btnregistrar"])) {

    $nombre_empresa     = $_POST["nombre_empresa"] ?? "";              // Nombre Empresa
    $direccion          = $_POST["direccion"] ?? "";          // Dirección
    $telefono           = $_POST["telefono"] ?? "";          // Teléfono

    if (
        !empty($nombre_empresa) && !empty($direccion) && !empty($telefono)
    ) {

        try {
            // Inserta limpiamente en la tabla empresa
            $resultado = $conexion->query("INSERT INTO empresa(nombre_empresa, direccion, telefono)
                VALUES ('$nombre_empresa', '$direccion', '$telefono')");

            if ($resultado) {
                unset($_POST['nombre_empresa']);
                unset($_POST['direccion']);
                unset($_POST['telefono']);

                echo '<div class="alert alert-success">Empresa registrada correctamente en el sistema</div><br/>';
                $nombre_empresa = $direccion = $telefono = "";
            } else {
                echo '<div class="alert alert-danger">Error interno al procesar la empresa</div> <br/>';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<div class="alert alert-danger">Error: El nombre de la empresa ya existe.</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error en base de datos: ' . $e->getMessage() . '</div><br/>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos vacíos! Asegúrese de rellenar todos los datos de la empresa.</div> <br/>';
    }
}
