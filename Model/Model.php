<?php

include_once __DIR__ . "/Config/Model.php";

/**
 * Exponer la conexión global a la base de datos.
 */
$conexion = ModelConfig::getConnection();
