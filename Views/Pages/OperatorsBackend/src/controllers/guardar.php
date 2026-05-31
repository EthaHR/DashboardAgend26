<?php
$nombre_operador = "";

if (!empty($_POST["btnregistrar"])) {

    $nombre_operador     = $_POST["nombre_operador"] ?? "";              // Nombre Operador

    if (
        !empty($nombre_operador)
    ) {

        try {
            // Inserta limpiamente en la tabla operador
            $resultado = $conexion->query("INSERT INTO operador(nombre_operador)
                VALUES ('$nombre_operador')");

            if ($resultado) {
                unset($_POST['nombre_operador']);

                echo '<div class="alert alert-success">Operador registrado correctamente en el sistema</div><br/>';
                $nombre_operador = "";
            } else {
                echo '<div class="alert alert-danger">Error interno al procesar el operador</div> <br/>';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<div class="alert alert-danger">Error: El nombre del operador ya existe.</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error en base de datos: ' . $e->getMessage() . '</div><br/>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos vacíos! Asegúrese de rellenar todos los datos del operador.</div> <br/>';
    }
}
