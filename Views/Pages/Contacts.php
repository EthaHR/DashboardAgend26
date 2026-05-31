
<?php
// 1. Cargamos primero la base de datos compartida desde el modelo central
include_once dirname(__DIR__, 2) . "/Model/Config/conexion.php";

// 2. Cargamos el componente visual del formulario
include __DIR__ . "/ContactsBackend/src/view/form.php";
?>
