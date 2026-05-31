<?php
mysqli_report(MYSQLI_REPORT_OFF);
// La conexión ya está disponible desde Contacts.php -> Model.php
if (!isset($conexion)) {
    $rutaConexionGlobal = dirname(__DIR__, 5) . "/Model/Config/Model.php";
    if (file_exists($rutaConexionGlobal)) {
        include $rutaConexionGlobal;
        $conexion = ModelConfig::getConnection();
    } else {
        die("<div class='alert alert-danger'>Error Crítico: No se encontró el archivo de conexión global.</div>");
    }
}

// Procesar el controlador de modificación
include __DIR__ . "/../controllers/modificar.php";
include __DIR__ . "/../controllers/eliminar.php";
?>

<link rel="stylesheet" href="Views/Pages/ContactsBackend/src/styles/modal.css">
<link rel="stylesheet" href="Views/Pages/ContactsBackend/src/styles/datatable.css">

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
        <h3>¿Estás seguro de eliminar el contacto?</h3>
        <p>Esta acción es permanente y no se puede deshacer.</p>
        <div class="botones">
            <button value="cancel" class="btn-cancelar" id="btnCancelarBorrado">Cancelar</button>
            <button value="confirm" class="btn-aceptar" id="btnConfirmarBorrado">Aceptar</button>
        </div>
    </form>
</dialog>

<!-- Modal para editar contacto -->
<dialog id="modalEditar" style="padding: 20px; border-radius: 8px; border: 1px solid #ccc; width: 90%; max-width: 800px; max-height: 90vh; overflow-y: auto;">
    <form method="post" class="form">
        <h3 class="text-center text-secondary" style="margin-top: 0;">Modificar Contacto</h3>

        <input type="hidden" name="id" id="edit_id">

        <div class="grid-form" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px;">
            <div class="mb-2">
                <label class="form-label">Nombres:</label>
                <input type="text" class="form-control" name="nombres" id="edit_nombres" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" id="edit_apellidos" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Empresa:</label>
                <select class="form-control" name="id_empresa" id="edit_id_empresa" required>
                    <?php
                    $empresas = $conexion->query("SELECT id_empresa, nombre_empresa FROM empresa ORDER BY nombre_empresa ASC");
                    while ($emp = $empresas->fetch_object()) {
                        echo "<option value='{$emp->id_empresa}'>{$emp->nombre_empresa}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label">Operador:</label>
                <select class="form-control" name="id_operador" id="edit_id_operador" required>
                    <?php
                    $operadores = $conexion->query("SELECT id_operador, nombre_operador FROM operador ORDER BY nombre_operador ASC");
                    while ($op = $operadores->fetch_object()) {
                        echo "<option value='{$op->id_operador}'>{$op->nombre_operador}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label">Grupo:</label>
                <select class="form-control" name="id_grupo" id="edit_id_grupo" required>
                    <?php
                    $grupos = $conexion->query("SELECT id_grupo, nombre_grupo FROM grupo_contacto ORDER BY nombre_grupo ASC");
                    while ($grp = $grupos->fetch_object()) {
                        echo "<option value='{$grp->id_grupo}'>{$grp->nombre_grupo}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2">
                <label class="form-label">Teléfono Móvil:</label>
                <input type="text" class="form-control" name="telefono_movil" id="edit_telefono_movil" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Teléfono Casa:</label>
                <input type="text" class="form-control" name="telefono_casa" id="edit_telefono_casa">
            </div>
            <div class="mb-2">
                <label class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" id="edit_correo">
            </div>
            <div class="mb-2">
                <label class="form-label">Descripción Grupo:</label>
                <input type="text" class="form-control" name="descripcion_grupo" id="edit_descripcion_grupo">
            </div>
            <div class="mb-2">
                <label class="form-label">Fecha Cumpleaños:</label>
                <input type="date" class="form-control" name="fecha_cumpleanios" id="edit_fecha_cumpleanios">
            </div>
            <div class="mb-2">
                <label class="form-label">Observaciones:</label>
                <input type="text" class="form-control" name="observaciones" id="edit_observaciones">
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
                    <h3 class="box-title">Lista de Contactos Registrados</h3>
                </div>
                <div class="box-body">
                    <div id="session-messages">
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
                        <a href="index.php?Pages=Contacts" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar Registro
                        </a>
                    </div>
                    <?php
                    if ($conexion) {
                        $sql = $conexion->query("SELECT c.*, e.nombre_empresa, o.nombre_operador, g.nombre_grupo FROM contacto c
                                                LEFT JOIN empresa e ON c.id_empresa = e.id_empresa
                                                LEFT JOIN operador o ON c.id_operador = o.id_operador
                                                LEFT JOIN grupo_contacto g ON c.id_grupo = g.id_grupo
                                                ORDER BY c.id_contacto ASC");
                    } else {
                        die("<div class='alert alert-danger'>Error de conexión.</div>");
                    }
                    ?>
                    <table id="tablaContactos" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Empresa</th>
                                <th>Operador</th>
                                <th>Grupo</th>
                                <th>Teléfono Móvil</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($datos = $sql->fetch_object()) { ?>
                                <tr>
                                    <td><?= $datos->id_contacto ?></td>
                                    <td><?= htmlspecialchars($datos->nombres) ?></td>
                                    <td><?= htmlspecialchars($datos->apellidos) ?></td>
                                    <td><?= htmlspecialchars($datos->nombre_empresa ?? '-') ?></td>
                                    <td><?= htmlspecialchars($datos->nombre_operador ?? '-') ?></td>
                                    <td><?= htmlspecialchars($datos->nombre_grupo ?? '-') ?></td>
                                    <td><?= htmlspecialchars($datos->telefono_movil) ?></td>
                                    <td><?= htmlspecialchars($datos->correo ?? '-') ?></td>
                                    <td>
                                        <button onclick="abrirModalEditar(<?= $datos->id_contacto ?>, '<?= htmlspecialchars($datos->nombres, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->apellidos, ENT_QUOTES) ?>', '<?= $datos->id_empresa ?>', '<?= $datos->id_operador ?>', '<?= $datos->id_grupo ?>', '<?= htmlspecialchars($datos->telefono_movil, ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->telefono_casa ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->correo ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($datos->descripcion_grupo ?? '', ENT_QUOTES) ?>', '<?= $datos->fecha_cumpleanios ?? '' ?>', '<?= htmlspecialchars($datos->observaciones ?? '', ENT_QUOTES) ?>')" class="btn btn-xs btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <a onclick="event.preventDefault(); eliminar(<?= $datos->id_contacto ?>)" href="#" class="btn btn-xs btn-danger">
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

    // CONTROL DEL MODAL DE EDICIÓN
    function abrirModalEditar(id, nombres, apellidos, id_empresa, id_operador, id_grupo, telefono_movil, telefono_casa, correo, descripcion_grupo, fecha_cumpleanios, observaciones) {
        document.getElementById("edit_id").value = id;
        document.getElementById("edit_nombres").value = nombres;
        document.getElementById("edit_apellidos").value = apellidos;
        document.getElementById("edit_id_empresa").value = id_empresa;
        document.getElementById("edit_id_operador").value = id_operador;
        document.getElementById("edit_id_grupo").value = id_grupo;
        document.getElementById("edit_telefono_movil").value = telefono_movil;
        document.getElementById("edit_telefono_casa").value = telefono_casa;
        document.getElementById("edit_correo").value = correo;
        document.getElementById("edit_descripcion_grupo").value = descripcion_grupo;
        document.getElementById("edit_fecha_cumpleanios").value = fecha_cumpleanios;
        document.getElementById("edit_observaciones").value = observaciones;

        const modalEditar = document.getElementById("modalEditar");
        modalEditar.showModal();

        const formEditar = modalEditar.querySelector("form");
        formEditar.onsubmit = function(e) {
            e.preventDefault();

            const formData = new FormData(formEditar);
            formData.append("btnmodificar", "ok");

            fetch('Views/Pages/ContactsBackend/src/controllers/modificar.php', {
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
        if ($.fn.DataTable.isDataTable('#tablaContactos')) {
            $('#tablaContactos').DataTable().destroy();
        }

        var table = $('#tablaContactos').DataTable({
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
                    className: 'btn btn-dark btn-sm'
                }
            ]
        });
    });
</script>