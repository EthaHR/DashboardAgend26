<?php
mysqli_report(MYSQLI_REPORT_OFF);

// Inclusión segura del modelo de conexión usando la ruta absoluta del archivo actual
include __DIR__ . "/../model/conexion.php";

if (!isset($conexion) && file_exists(__DIR__ . "/../model/conexion.php")) {
    $conexion = include __DIR__ . "/../model/conexion.php";
}
?>

<link rel="stylesheet" href="Views/Pages/ContractsBackend/src/styles/styles.css">


<section class="content-header">
    <h1>SISTEMA DE GESTIÓN DE CONTRATOS</h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-12" style="max-width: 950px; margin: auto; padding: 0px">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Registro de Contrato</h3>
                </div>
                <form method="post" role="form" style="padding: 0;">
                    <div class="box-body">
                        <?php
                        include __DIR__ . "/../controllers/guardar.php";
                        include __DIR__ . "/../controllers/eliminar.php";

                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['alerta_edicion'])) {
                            echo "<div class='alert alert-success'>Contrato actualizado</div>";
                            unset($_SESSION['alerta_edicion']);
                        }
                        if (isset($_SESSION['alerta_eliminacion'])) {
                            echo "<div class='alert alert-success'>Contrato eliminado</div>";
                            unset($_SESSION['alerta_eliminacion']);
                        }
                        ?>

                        <div class="grid-form">
                            <div class="form-group">
                                <label>N° de Contrato:</label>
                                <input type="text" class="form-control" name="dni" value="<?= isset($_POST['dni']) ? htmlspecialchars($_POST['dni']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Tipo de Contrato:</label>
                                <input type="text" class="form-control" name="nombres" value="<?= isset($_POST['nombres']) ? htmlspecialchars($_POST['nombres']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Empresa / Cliente:</label>
                                <input type="text" class="form-control" name="apellidos" value="<?= isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Fecha de Inicio:</label>
                                <input type="date" class="form-control" name="fechanacimiento" value="<?= isset($_POST['fechanacimiento']) ? htmlspecialchars($_POST['fechanacimiento']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Correo de Contacto:</label>
                                <input type="email" class="form-control" name="correo" value="<?= isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Teléfono de Contacto:</label>
                                <input type="number" class="form-control" name="telefono" value="<?= isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : '' ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="width: 100%;text-align: center;">
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" style="width: 50%;min-width: 320px;">Registrar Contrato</button>
                    </div>
                </form>
            </div>
        </div>








    </div>
</section>



<!--//! ----------------------------------------------------->
<script>
    function eliminar(id) {
        const modal = document.getElementById("modalConfirmarEliminar");
        modal.showModal();

        // Función interna con nombre para poder remover el listener limpiamente
        function handler() {
            if (modal.returnValue === 'confirm') {
                window.location.href = "index.php?Pages=Contracts&id=" + id;
            }
            modal.removeEventListener('close', handler);
        }

        modal.addEventListener("close", handler);
    }

    // Inicialización limpia aprovechando el jQuery global que ya cargó Template.php
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tablaContratos')) {
            $('#tablaContratos').DataTable().destroy();
        }

        $('#tablaContratos').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.8/i18n/es-ES.json'
            },
            pageLength: 5,
            buttons: [{
                    extend: 'excel',
                    text: '<i class="fa-solid fa-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print"></i> Imprimir',
                    className: 'btn btn-dark btn-sm'
                }
            ]
        });
    });
</script>