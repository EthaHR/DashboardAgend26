<?php

/**
 * Configuración centralizada de base de datos.
 * Este archivo define la conexión única que usan todas las vistas y controladores.
 */
class ModelConfig
{
    private static $conexion = null;

    public static function getConnection()
    {
        if (self::$conexion === null) {
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "bdagenda2026";

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try {
                self::$conexion = new mysqli($host, $user, $password, $database);
                self::$conexion->set_charset("utf8");
            } catch (mysqli_sql_exception $error) {
                $message = htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8');
                die("<div class='alert alert-danger'>Error de conexión a la base de datos: $message</div>");
            }
        }

        return self::$conexion;
    }
}
