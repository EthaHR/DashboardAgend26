<?php
mysqli_report(MYSQLI_REPORT_OFF);

// Inclusión segura del modelo de conexión usando la ruta absoluta del archivo actual
include __DIR__ . "/../model/conexion.php";

if (!isset($conexion) && file_exists(__DIR__ . "/../model/conexion.php")) {
    $conexion = include __DIR__ . "/../model/conexion.php";
}
?>

<link rel="stylesheet" href="Views/Pages/ContactsBackend/src/styles/styles.css">

<section class="content-header">
    <h1>SISTEMA DE GESTIÓN DE CONTACTOS</h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-12" style="max-width: 950px; margin: auto; padding: 0px">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Registro de Contacto</h3>
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
                            echo "<div class='alert alert-success'>Contacto actualizado</div>";
                            unset($_SESSION['alerta_edicion']);
                        }
                        if (isset($_SESSION['alerta_eliminacion'])) {
                            echo "<div class='alert alert-success'>Contacto eliminado</div>";
                            unset($_SESSION['alerta_eliminacion']);
                        }
                        if (isset($_SESSION['alerta_registro'])) {
                            echo "<div class='alert alert-success'>" . $_SESSION['alerta_registro'] . "</div>";
                            unset($_SESSION['alerta_registro']);
                        }
                        ?>

                        <div class="grid-form">
                            <div class="form-group">
                                <label>Nombres:</label>
                                <input type="text" class="form-control" name="nombres" value="<?= isset($_POST['nombres']) ? htmlspecialchars($_POST['nombres']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Apellidos:</label>
                                <input type="text" class="form-control" name="apellidos" value="<?= isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Empresa:</label>
                                <select class="form-control" name="id_empresa" required>
                                    <option value="">Seleccionar Empresa</option>
                                    <?php
                                    $empresas = $conexion->query("SELECT id_empresa, nombre_empresa FROM empresa ORDER BY nombre_empresa ASC");
                                    while ($emp = $empresas->fetch_object()) {
                                        $selected = (isset($_POST['id_empresa']) && $_POST['id_empresa'] == $emp->id_empresa) ? 'selected' : '';
                                        echo "<option value='{$emp->id_empresa}' {$selected}>{$emp->nombre_empresa}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Operador:</label>
                                <select class="form-control" name="id_operador" required>
                                    <option value="">Seleccionar Operador</option>
                                    <?php
                                    $operadores = $conexion->query("SELECT id_operador, nombre_operador FROM operador ORDER BY nombre_operador ASC");
                                    while ($op = $operadores->fetch_object()) {
                                        $selected = (isset($_POST['id_operador']) && $_POST['id_operador'] == $op->id_operador) ? 'selected' : '';
                                        echo "<option value='{$op->id_operador}' {$selected}>{$op->nombre_operador}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Grupo:</label>
                                <select class="form-control" name="id_grupo" required>
                                    <option value="">Seleccionar Grupo</option>
                                    <?php
                                    $grupos = $conexion->query("SELECT id_grupo, nombre_grupo FROM grupo_contacto ORDER BY nombre_grupo ASC");
                                    while ($grp = $grupos->fetch_object()) {
                                        $selected = (isset($_POST['id_grupo']) && $_POST['id_grupo'] == $grp->id_grupo) ? 'selected' : '';
                                        echo "<option value='{$grp->id_grupo}' {$selected}>{$grp->nombre_grupo}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Teléfono Móvil:</label>
                                <input type="text" class="form-control" name="telefono_movil" value="<?= isset($_POST['telefono_movil']) ? htmlspecialchars($_POST['telefono_movil']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Teléfono Casa:</label>
                                <input type="text" class="form-control" name="telefono_casa" value="<?= isset($_POST['telefono_casa']) ? htmlspecialchars($_POST['telefono_casa']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Correo Electrónico:</label>
                                <input type="email" class="form-control" name="correo" value="<?= isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Descripción del Grupo:</label>
                                <input type="text" class="form-control" name="descripcion_grupo" value="<?= isset($_POST['descripcion_grupo']) ? htmlspecialchars($_POST['descripcion_grupo']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Fecha de Cumpleaños:</label>
                                <input type="date" class="form-control" name="fecha_cumpleanios" value="<?= isset($_POST['fecha_cumpleanios']) ? htmlspecialchars($_POST['fecha_cumpleanios']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Observaciones:</label>
                                <input type="text" class="form-control" name="observaciones" value="<?= isset($_POST['observaciones']) ? htmlspecialchars($_POST['observaciones']) : '' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="width: 50%;min-width: 320px; margin: auto;">
                        <button type="submit" class="btn btn-primary" id="btnRegistrar" style="width: 100%" name="btnregistrar" value="ok">Registrar Contacto</button>
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

        function handler() {
            if (modal.returnValue === 'confirm') {
                fetch('Views/Pages/ContactsBackend/src/controllers/eliminar.php?delete=' + id, {
                        method: 'GET'
                    })
                    .then(response => response.text())
                    .then(data => {
                        location.reload();
                    })
                    .catch(error => {
                        alert('Error al eliminar: ' + error);
                    });
            }
            modal.removeEventListener('close', handler);
        }

        modal.addEventListener("close", handler);
    }

    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tablaContactos')) {
            $('#tablaContactos').DataTable().destroy();
        }

        $('#tablaContactos').DataTable({
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