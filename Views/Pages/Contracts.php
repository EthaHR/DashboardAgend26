
<?php
// 1. Cargamos primero la base de datos de manera absoluta basada en Contracts.php
include_once dirname(__DIR__, 2) . "/Model/Config/conexion.php";

// 2. Cargamos el componente visual del formulario
include __DIR__ . "/ContractsBackend/src/view/form.php";
?>
