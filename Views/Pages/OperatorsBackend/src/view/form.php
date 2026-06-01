<?php
mysqli_report(MYSQLI_REPORT_OFF);

// Inclusión segura del modelo de conexión usando la ruta absoluta del archivo actual
include __DIR__ . "/../model/conexion.php";

if (!isset($conexion) && file_exists(__DIR__ . "/../model/conexion.php")) {
    $conexion = include __DIR__ . "/../model/conexion.php";
}
?>

<link rel="stylesheet" href="Views/Pages/OperatorsBackend/src/styles/styles.css">


<section class="content-header">
    <h1>SISTEMA DE GESTIÓN DE OPERADORES</h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-12" style="max-width: 950px; margin: auto; padding: 0px">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Registro de Operador</h3>
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
                            echo "<div class='alert alert-success'>Operador actualizado</div>";
                            unset($_SESSION['alerta_edicion']);
                        }
                        if (isset($_SESSION['alerta_eliminacion'])) {
                            echo "<div class='alert alert-success'>Operador eliminado</div>";
                            unset($_SESSION['alerta_eliminacion']);
                        }
                        ?>

                        <div class="grid-form">
                            <div class="form-group">
                                <label>ID del Operador:</label>
                                <input type="text" class="form-control" name="id_operador" value="<?= isset($_POST['id_operador']) ? htmlspecialchars($_POST['id_operador']) : '' ?>" placeholder="Ej: OP001" required>
                            </div>
                            <div class="form-group">
                                <label>Nombre del Operador:</label>
                                <input type="text" class="form-control" name="nombre_operador" value="<?= isset($_POST['nombre_operador']) ? htmlspecialchars($_POST['nombre_operador']) : '' ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="width: 50%;min-width: 320px; margin: auto;">
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" style="width: 100%" name="btnregistrar" value="ok">Registrar Operador</button>
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
                window.location.href = "index.php?Pages=OperatorsBackend&id=" + id;
            }
            modal.removeEventListener('close', handler);
        }

        modal.addEventListener("close", handler);
    }

    // Inicialización limpia aprovechando el jQuery global que ya cargó Template.php
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tablaOperadores')) {
            $('#tablaOperadores').DataTable().destroy();
        }

        $('#tablaOperadores').DataTable({
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
                    className: 'btn btn-dark btn-sm',
                    customize: dtPrintCustomize
                }
            ]
        });
    });
</script>