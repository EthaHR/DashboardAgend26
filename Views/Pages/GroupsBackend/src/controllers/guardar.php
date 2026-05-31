<?php
$id_grupo = $nombre_grupo = "";

if (!empty($_POST["btnregistrar"])) {

    $id_grupo           = $_POST["id_grupo"] ?? "";                      // ID Grupo
    $nombre_grupo       = $_POST["nombre_grupo"] ?? "";                  // Nombre Grupo

    if (
        !empty($id_grupo) && !empty($nombre_grupo)
    ) {

        try {
            // Inserta limpiamente en la tabla grupo_contacto
            $resultado = $conexion->query("INSERT INTO grupo_contacto(id_grupo, nombre_grupo)
                VALUES ('$id_grupo', '$nombre_grupo')");

            if ($resultado) {
                unset($_POST['id_grupo']);
                unset($_POST['nombre_grupo']);

                echo '<div class="alert alert-success">Grupo registrado correctamente en el sistema</div><br/>';
                $id_grupo = $nombre_grupo = "";
            } else {
                echo '<div class="alert alert-danger">Error interno al procesar el grupo</div> <br/>';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<div class="alert alert-danger">Error: El ID o nombre del grupo ya existe.</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error en base de datos: ' . $e->getMessage() . '</div><br/>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos vacíos! Asegúrese de rellenar todos los datos del grupo.</div> <br/>';
    }
}
