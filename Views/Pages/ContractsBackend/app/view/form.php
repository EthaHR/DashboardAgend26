<?php
mysqli_report(MYSQLI_REPORT_OFF);

// Inclusión segura del modelo de conexión usando la ruta absoluta del archivo actual
include __DIR__ . "/../model/conexion.php";

if (!isset($conexion) && file_exists(__DIR__ . "/../model/conexion.php")) {
    $conexion = include __DIR__ . "/../model/conexion.php";
}
?>

<link rel="stylesheet" href="Views/Pages/ContractsBackend/app/styles/styles.css">
<link rel="stylesheet" href="Views/Pages/ContractsBackend/app/styles/modal.css">
<link rel="stylesheet" href="Views/Pages/ContractsBackend/app/styles/datatable.css">

<dialog id="modalConfirmarEliminar">
    <form method="dialog">
        <h3>¿Estás seguro de eliminar el contrato?</h3>
        <p>Esta acción es permanente y no se puede deshacer.</p>
        <div class="botones">
            <button value="cancel" class="btn-cancelar" id="btnCancelarBorrado">Cancelar</button>
            <button value="confirm" class="btn-aceptar" id="btnConfirmarBorrado">Aceptar</button>
        </div>
    </form>
</dialog>

<section class="content-header">
    <h1>SISTEMA DE GESTIÓN DE CONTRATOS</h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Registro de Contrato</h3>
                </div>

                <form method="post" role="form">
                    <div class="box-body">
                        <?php
                        include __DIR__ . "/../controllers/guardar.php";
                        include __DIR__ . "/../controllers/eliminar_empleado.php";

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

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" style="width: 100%" name="btnregistrar" value="ok">Registrar Contrato</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Contratos Activos</h3>
                </div>
                <div class="box-body">
                    <?php
                    if ($conexion) {
                        $sql = $conexion->query("SELECT * FROM contrato ORDER BY id_persona ASC");
                    } else {
                        die("<div class='alert alert-danger'>Error de conexión.</div>");
                    }
                    ?>
                    <table id="tablaContratos" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nº de Contrato</th>
                                <th>Tipo de Contrato</th>
                                <th>Empresa / Cliente</th>
                                <th>Fecha Inicio</th>
                                <th>Correo Contacto</th>
                                <th>Teléfono Contacto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($datos = $sql->fetch_object()) { ?>
                                <tr>
                                    <td><?= $datos->id_persona ?></td>
                                    <td><?= htmlspecialchars($datos->dni) ?></td>
                                    <td><?= htmlspecialchars($datos->nombres) ?></td>
                                    <td><?= htmlspecialchars($datos->apellidos) ?></td>
                                    <td><?= $datos->fecha_nac ?></td>
                                    <td><?= htmlspecialchars($datos->correo) ?></td>
                                    <td><?= htmlspecialchars($datos->telefono) ?></td>
                                    <td>
                                        <a href="Views/Pages/ContractsBackend/app/view/edit-form.php?id=<?= $datos->id_persona ?>" class="btn btn-xs btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a onclick="event.preventDefault(); eliminar(<?= $datos->id_persona ?>)" href="#" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

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