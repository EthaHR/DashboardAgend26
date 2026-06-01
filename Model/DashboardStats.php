<?php

require_once __DIR__ . '/Config/Model.php';

/**
 * Métricas agregadas para el dashboard principal.
 * Usa las mismas tablas que los backends de cada módulo.
 */
class DashboardStats
{
    private const ENTITIES = [
        'operadores' => 'operador',
        'empresas'   => 'empresa',
        'contactos'  => 'contacto',
        'grupos'     => 'grupo_contacto',
    ];

    public static function getCounts(): array
    {
        $conexion = ModelConfig::getConnection();
        $counts = [];

        foreach (self::ENTITIES as $key => $table) {
            $result = $conexion->query("SELECT COUNT(*) AS total FROM `{$table}`");
            $row = $result->fetch_assoc();
            $counts[$key] = (int) ($row['total'] ?? 0);
        }

        $counts['total'] = array_sum($counts);

        return $counts;
    }
}
