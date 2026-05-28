<?php
$dni = $nombres = $apellidos = $fecha_nac = $correo = $telefono = "";

if (!empty($_POST["btnregistrar"])) {

    $dni         = $_POST["dni"] ?? "";              // Nro Contrato
    $nombres     = $_POST["nombres"] ?? "";          // Tipo Contrato
    $apellidos   = $_POST["apellidos"] ?? "";        // Empresa / Cliente
    $fecha_nac   = $_POST["fechanacimiento"] ?? "";  // Fecha Inicio
    $correo      = $_POST["correo"] ?? "";           // Correo
    $telefono    = $_POST["telefono"] ?? "";         // Teléfono

    if (
        !empty($dni) && !empty($nombres) && !empty($apellidos) &&
        !empty($fecha_nac) && !empty($correo) && !empty($telefono)
    ) {

        try {
            // Inserta limpiamente en la tabla contrato
            $resultado = $conexion->query("INSERT INTO contrato(dni, nombres, apellidos, fecha_nac, correo, telefono, monto_pago, estado_contrato)
                VALUES ('$dni', '$nombres', '$apellidos', '$fecha_nac', '$correo', '$telefono', 1500.00, 'Activo')");

            if ($resultado) {
                unset($_POST['dni']);
                unset($_POST['nombres']);
                unset($_POST['apellidos']);
                unset($_POST['fechanacimiento']);
                unset($_POST['correo']);
                unset($_POST['telefono']);

                echo '<div class="alert alert-success">Contrato registrado correctamente en el sistema</div><br/>';
                $dni = $nombres = $apellidos = $fecha_nac = $correo = $telefono = "";
            } else {
                echo '<div class="alert alert-danger">Error interno al procesar el contrato</div> <br/>';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<div class="alert alert-danger">Error: El código o número de contrato ya existe.</div><br/>';
            } else {
                echo '<div class="alert alert-danger">Error en base de datos: ' . $e->getMessage() . '</div><br/>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">¡Campos vacíos! Asegúrese de rellenar todos los datos del contrato.</div> <br/>';
    }
}
