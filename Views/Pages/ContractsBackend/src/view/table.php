<?php
mysqli_report(MYSQLI_REPORT_OFF);
/**
 * Conexión Centralizada usando la ruta exacta desde la ubicación de table.php:
 * 1. __DIR__ = Raíz/Views/Pages/ContractsBackend/src/view
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
?>

<link rel="stylesheet" href="Views/Pages/ContractsBackend/src/styles/modal.css">
<link rel="stylesheet" href="Views/Pages/ContractsBackend/src/styles/datatable.css">


<!--//!-----------------------------------  INICIO DEL MODAL ELIMINAR  --------------------------------------->
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

<dialog id="modalEditar" style="padding: 20px; border-radius: 8px; border: 1px solid #ccc; width: 90%; max-width: 500px;">
    <form method="post" class="form">
        <h3 class="text-center text-secondary" style="margin-top: 0;">Modificar Contrato</h3>

        <input type="hidden" name="id" id="edit_id">

        <div class="grid-form" style="display: grid; grid-template-columns: 1fr; gap: 10px; margin-bottom: 15px;">
            <div class="mb-2">
                <label class="form-label">Nº de Contrato:</label>
                <input type="text" class="form-control" name="dni" id="edit_dni" style="width: 100%; padding: 6px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Tipo de Contrato:</label>
                <input type="text" class="form-control" name="nombres" id="edit_nombres" style="width: 100%; padding: 6px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Empresa / Cliente:</label>
                <input type="text" class="form-control" name="apellidos" id="edit_apellidos" style="width: 100%; padding: 6px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Fecha Inicio:</label>
                <input type="date" class="form-control" name="fecha_nac" id="edit_fecha_nac" style="width: 100%; padding: 6px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Correo Contacto:</label>
                <input type="email" class="form-control" name="correo" id="edit_correo" style="width: 100%; padding: 6px;">
            </div>
            <div class="mb-2">
                <label class="form-label">Teléfono Contacto:</label>
                <input type="number" class="form-control" name="telefono" id="edit_telefono" style="width: 100%; padding: 6px;">
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
                                        <button onclick="abrirModalEditar(<?= $datos->id_persona ?>, '<?= htmlspecialchars($datos->dni, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->nombres, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->apellidos, ENT_QUOTES) ?>', '<?= $datos->fecha_nac ?>', '<?= htmlspecialchars($datos->correo, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->telefono, ENT_QUOTES) ?>')" class="btn btn-xs btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </button>
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
    // CONTROL DEL MODAL DE ELIMINACIÓN
    function eliminar(id) {
        const modal = document.getElementById("modalConfirmarEliminar");
        modal.showModal();

        function handler() {
            if (modal.returnValue === 'confirm') {
                window.location.href = "index.php?Pages=Contracts&id=" + id;
            }
            modal.removeEventListener('close', handler);
        }
        modal.addEventListener("close", handler);
    }

    // CONTROL DEL MODAL DE EDICIÓN: Inyecta los valores directo al formulario y lo abre
    function abrirModalEditar(id, dni, nombres, apellidos, fecha, correo, telefono) {
        document.getElementById("edit_id").value = id;
        document.getElementById("edit_dni").value = dni;
        document.getElementById("edit_nombres").value = nombres;
        document.getElementById("edit_apellidos").value = apellidos;
        document.getElementById("edit_fecha_nac").value = fecha;
        document.getElementById("edit_correo").value = correo;
        document.getElementById("edit_telefono").value = telefono;

        const modalEditar = document.getElementById("modalEditar");
        modalEditar.showModal();
    }

    // INICIALIZACIÓN DE DATATABLES
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#tablaContratos')) {
            $('#tablaContratos').DataTable().destroy();
        }

        $('#tablaContratos').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.8/i18n/es-ES.json'
            },
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
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
                    extend: 'csv',
                    text: '<i class="fa-solid fa-file-csv"></i> CSV',
                    className: 'btn btn-info text-white'
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