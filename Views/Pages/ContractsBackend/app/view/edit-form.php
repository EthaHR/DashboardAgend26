<?php
mysqli_report(MYSQLI_REPORT_OFF);
include __DIR__ . "/../model/conexion.php";
$id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Contrato</title>
    <link rel="stylesheet" href="./../styles/styles_upadte.css">
    <link rel="icon" type="image/x-icon" href="/app/public/pen_edit_modify_pencil.ico">
</head>

<body>
    <form class="form col-4 p-3 m-auto" method="post">
        <h3 class="text-center text-secondary">Modificar Contrato</h3>

        <?php
        //% Incluir el controlador de modificación de los registros  -->
        include __DIR__ . "/../controllers/modificar_empleado.php";

        // Consulta adaptada a la tabla contrato
        $sql = $conexion->query("SELECT * FROM contrato WHERE id_persona=$id");
        while ($datos = $sql->fetch_object()) { ?>
            <div class="mb-2">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            </div>
            <div class="grid-form">
                <div class="mb-2">
                    <label for="exampleInputDNI" class="form-label">Nº de Contrato:</label>
                    <input type="text" class="form-control" name="dni" value="<?= $datos->dni ?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputnombres" class="form-label">Tipo de Contrato:</label>
                    <input type="text" class="form-control" name="nombres" value="<?= $datos->nombres ?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputApellidos" class="form-label">Empresa / Cliente:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $datos->apellidos ?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputfechanacimiento" class="form-label">Fecha Inicio:</label>
                    <input type="date" class="form-control" name="fecha_nac" value="<?= $datos->fecha_nac ?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputcorreo" class="form-label">Correo Contacto:</label>
                    <input type="email" class="form-control" name="correo" value="<?= $datos->correo ?>">
                </div>
                <div class="mb-2">
                    <label for="exampleInputtelefono" class="form-label">Teléfono Contacto:</label>
                    <input type="number" class="form-control" name="telefono" value="<?= $datos->telefono ?>">
                </div>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary" name="btnmodificar" value="ok">Guardar Cambios</button>
    </form>
</body>

</html>