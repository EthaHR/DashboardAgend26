<?php
mysqli_report(MYSQLI_REPORT_OFF);
/**
 * Conexión Centralizada usando la ruta exacta desde la ubicación de table.php:
 * 1. __DIR__ = Raíz/Views/Pages/CompaniesBackend/src/view
 * 2. Subimos 5 niveles (../../../..//..) para aterrizar en la raíz de DashboardAgend26
 * 3. Entramos a la carpeta de configuración global global: Model/Config/conexion.php
 */
$rutaConexionGlobal = dirname(__DIR__, 5) . "/Model/Config/conexion.php";

if (file_exists($rutaConexionGlobal)) {
    // Incluye el archivo central e inicializa la variable $conexion automáticamente
    include $rutaConexionGlobal;
} else {
    die("<div class='alert alert-danger'>Error Crítico: No se encontró el archivo de conexión global en la ruta esperada.</div>");
}

if (!$conexion) {
    die("<div class='alert alert-danger'>Error de conexión a la Base de Datos.</div>");
}

// Procesar el controlador de modificación (Sigue estando dentro de tu módulo local)
include __DIR__ . "/../controllers/modificar.php";
include __DIR__ . "/../controllers/eliminar.php";
?>

<link rel="stylesheet" href="Views/Pages/CompaniesBackend/src/styles/modal.css">
<link rel="stylesheet" href="Views/Pages/CompaniesBackend/src/styles/datatable.css">

<style>
    #modalConfirmarEliminar h3 {
        font-size: 18px;
        font-weight: bold;
    }

    #modalConfirmarEliminar p {
        font-size: 16px;
    }

    #modalConfirmarEliminar .botones button {
        font-size: 16px;
        padding: 10px 20px;
    }

    .dataTables_wrapper {
        clear: both;
        width: 100%;
    }

    .dataTables_wrapper .dataTables_filter input {
        margin-left: 10px;
    }
</style>



<!--//!-----------------------------------  INICIO DEL MODAL ELIMINAR  --------------------------------------->
<dialog id="modalConfirmarEliminar">
    <form method="dialog">
        <h3>¿Estás seguro de eliminar la empresa?</h3>
        <p>Esta acción es permanente y no se puede deshacer.</p>
        <div class="botones">
            <button value="cancel" class="btn-cancelar" id="btnCancelarBorrado">Cancelar</button>
            <button value="confirm" class="btn-aceptar" id="btnConfirmarBorrado">Aceptar</button>
        </div>
    </form>
</dialog>

<!-- Boton para abrir el modal de editar -->
<dialog id="modalEditar" style="padding: 20px; border-radius: 8px; border: 1px solid #ccc; width: 90%; max-width: 500px;">
    <form method="post" class="form">
        <h3 class="text-center text-secondary" style="margin-top: 0;">Modificar Empresa</h3>

        <input type="hidden" name="id" id="edit_id">

        <div class="grid-form" style="display: grid; grid-template-columns: 1fr; gap: 10px; margin-bottom: 15px;">
            <div class="mb-2">
                <label class="form-label">Nombre Empresa:</label>
                <input type="text" class="form-control" name="nombre_empresa" id="edit_nombre_empresa" style="width: 100%; padding: 6px; font-size: 18px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Dirección:</label>
                <input type="text" class="form-control" name="direccion" id="edit_direccion" style="width: 100%; padding: 6px; font-size: 18px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="edit_telefono" style="width: 100%; padding: 6px; font-size: 18px;">
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn btn-default" onclick="document.getElementById('modalEditar').close();">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="btnmodificar" value="ok">Guardar Cambios</button>
        </div>
    </form>
</dialog>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Empresas Registradas</h3>
                </div>
                <div class="box-body">
                    <div id="session-messages">
                        <!-- Mensajes de sesión -->
                        <?php
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION['alerta_edicion'])) {
                            echo "<div class='alert alert-success'>" . $_SESSION['alerta_edicion'] . "</div>";
                            unset($_SESSION['alerta_edicion']);
                        }
                        if (isset($_SESSION['alerta_eliminacion'])) {
                            echo "<div class='alert alert-success'>" . $_SESSION['alerta_eliminacion'] . "</div>";
                            unset($_SESSION['alerta_eliminacion']);
                        }
                        ?>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <a href="index.php?Pages=Companies" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar Registro
                        </a>
                    </div>
                    <?php
                    if ($conexion) {
                        $sql = $conexion->query("SELECT * FROM empresa ORDER BY id_empresa ASC");
                    } else {
                        die("<div class='alert alert-danger'>Error de conexión.</div>");
                    }
                    ?>
                    <table id="tablaEmpresas" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Empresa</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($datos = $sql->fetch_object()) { ?>
                                <tr>
                                    <td><?= $datos->id_empresa ?></td>
                                    <td><?= htmlspecialchars($datos->nombre_empresa) ?></td>
                                    <td><?= htmlspecialchars($datos->direccion) ?></td>
                                    <td><?= htmlspecialchars($datos->telefono) ?></td>
                                    <td><?= $datos->fecha_registro ?></td>
                                    <td>
                                        <button onclick="abrirModalEditar(<?= $datos->id_empresa ?>, '<?= htmlspecialchars($datos->nombre_empresa, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->direccion, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->telefono, ENT_QUOTES) ?>', '<?= $datos->fecha_registro ?>')" class="btn btn-xs btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <a onclick="event.preventDefault(); eliminar(<?= $datos->id_empresa ?>)" href="#" class="btn btn-xs btn-danger">
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
    // CONTROL DEL MODAL DE ELIMINACIÓN
    function eliminar(id) {
        const modal = document.getElementById("modalConfirmarEliminar");
        modal.showModal();

        function handler() {
            if (modal.returnValue === 'confirm') {
                // Usar AJAX para eliminar
                fetch('Views/Pages/CompaniesBackend/src/controllers/eliminar.php?delete=' + id, {
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

    // CONTROL DEL MODAL DE EDICIÓN: Inyecta los valores directo al formulario y lo abre
    function abrirModalEditar(id, nombre_empresa, direccion, telefono, fecha_registro) {
        document.getElementById("edit_id").value = id;
        document.getElementById("edit_nombre_empresa").value = nombre_empresa;
        document.getElementById("edit_direccion").value = direccion;
        document.getElementById("edit_telefono").value = telefono;

        const modalEditar = document.getElementById("modalEditar");
        modalEditar.showModal();

        // Manejar el envío del formulario del modal
        const formEditar = modalEditar.querySelector("form");
        formEditar.onsubmit = function(e) {
            e.preventDefault();

            const formData = new FormData(formEditar);
            formData.append("btnmodificar", "ok");

            fetch('Views/Pages/CompaniesBackend/src/controllers/modificar.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.includes("success")) {
                        modalEditar.close();
                        location.reload();
                    } else {
                        alert("Error al actualizar");
                    }
                })
                .catch(error => {
                    alert("Error: " + error);
                });
        };
    }

    // INICIALIZACIÓN DE DATATABLES
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tablaEmpresas')) {
            $('#tablaEmpresas').DataTable().destroy();
        }

        var table = $('#tablaEmpresas').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.8/i18n/es-ES.json'
            },
            pageLength: 10,
            lengthMenu: [10, 25, 50],
            dom: '<"row"<"col-sm-6"l><"col-sm-6 pr-3 text-right"f>>Brtip',
            buttons: [{
                    extend: 'excel',
                    text: '<i class="fa-solid fa-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm buttons-excel'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger btn-sm buttons-pdf'
                },
                {
                    extend: 'csv',
                    text: '<i class="fa-solid fa-file-csv"></i> CSV',
                    className: 'btn btn-info text-white'
                },
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print"></i> Imprimir',
                    className: 'btn btn-dark btn-sm',
                    customize: dtPrintCustomize
                }
            ]
        });

        // Manejar botones de exportación personalizados
        $('#btnExportExcel').on('click', function() {
            table.button('.buttons-excel').trigger();
        });

        $('#btnExportPdf').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });
    });
</script>