<?php
$id_operador = $nombre_operador = "";

if (!empty($_POST["btnregistrar"])) {

    $id_operador         = $_POST["id_operador"] ?? "";                  // ID Operador
    $nombre_operador     = $_POST["nombre_operador"] ?? "";              // Nombre Operador

    if (
        !empty($id_operador) && !empty($nombre_operador)
    ) {

        try {
            // Inserta limpiamente en la tabla operador
            $resultado = $conexion->query("INSERT INTO operador(id_operador, nombre_operador)
                VALUES ('$id_operador', '$nombre_operador')");

            if ($resultado) {
                unset($_POST['id_operador']);
                unset($_POST['nombre_operador']);

                echo '<div class="alert alert-success">Operador registrado correctamente en el sistema</div><br/>';
                $id_operador = $nombre_operador = "";
            } else {
                echo '<div class="alert alert-danger">Error interno al procesar el operador</div> <br/>';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<div class="alert alert-danger">Error: El ID o nombre del operador ya existe.</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error en base de datos: ' . $e->getMessage() . '</div><br/>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos vacíos! Asegúrese de rellenar todos los datos del operador.</div> <br/>';
    }
}
