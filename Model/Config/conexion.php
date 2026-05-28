<?php
try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "bdagenda2026";

    //! Esto obliga a mysqli a lanzar excepciones en caso de error
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conexion = new mysqli($host, $user, $password, $database);
    $conexion->set_charset("utf8");
} catch (Exception $error) {
    // Redirección adaptada al ruteador del Dashboard definitivo
    header("Location: index.php?Pages=Contracts&status=db_error");
    exit();
}
