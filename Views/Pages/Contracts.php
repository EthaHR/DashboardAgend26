<div class="content" style="min-height: 717px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php
                    // 1. Cargamos primero la base de datos de manera absoluta basada en Contracts.php
                    include_once __DIR__ . "/ContractsBackend/app/model/conexion.php";

                    // 2. Cargamos el componente visual del formulario
                    include __DIR__ . "/ContractsBackend/app/view/form.php";
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>