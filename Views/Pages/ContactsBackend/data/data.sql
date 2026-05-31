--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
    `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
    `nombres` varchar(80) NOT NULL,
    `apellidos` varchar(80) NOT NULL,
    `id_empresa` int(11) NOT NULL,
    `id_operador` char(5) NOT NULL,
    `id_grupo` char(5) NOT NULL,
    `telefono_movil` char(11) NOT NULL,
    `telefono_casa` char(11) DEFAULT NULL,
    `correo` varchar(90) DEFAULT NULL,
    `descripcion_grupo` varchar(80) DEFAULT NULL,
    `fecha_cumpleanios` date DEFAULT NULL,
    `observaciones` varchar(100) DEFAULT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id_contacto`),
    KEY `idx_contacto_empresa` (`id_empresa`),
    KEY `idx_contacto_operador` (`id_operador`),
    KEY `idx_contacto_grupo` (`id_grupo`),
    CONSTRAINT `fk_contacto_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON UPDATE CASCADE,
    CONSTRAINT `fk_contacto_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_contacto` (`id_grupo`) ON UPDATE CASCADE,
    CONSTRAINT `fk_contacto_operador` FOREIGN KEY (`id_operador`) REFERENCES `operador` (`id_operador`) ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Vista para mostrar contactos con nombres en lugar de IDs
--

DROP VIEW IF EXISTS `vista_contactos_completa`;

CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vista_contactos_completa` AS
SELECT
    `c`.`id_contacto` AS `id_contacto`,
    `c`.`nombres` AS `nombres`,
    `c`.`apellidos` AS `apellidos`,
    `e`.`nombre_empresa` AS `nombre_empresa`,
    `o`.`nombre_operador` AS `nombre_operador`,
    `g`.`nombre_grupo` AS `nombre_grupo`,
    `c`.`telefono_movil` AS `telefono_movil`,
    `c`.`telefono_casa` AS `telefono_casa`,
    `c`.`correo` AS `correo`,
    `c`.`descripcion_grupo` AS `descripcion_grupo`,
    `c`.`fecha_cumpleanios` AS `fecha_cumpleanios`,
    `c`.`observaciones` AS `observaciones`,
    `c`.`fecha_registro` AS `fecha_registro`,
    `c`.`id_empresa` AS `id_empresa`,
    `c`.`id_operador` AS `id_operador`,
    `c`.`id_grupo` AS `id_grupo`
FROM (
    (
        (
            `contacto` `c`
            LEFT JOIN `empresa` `e` ON (
                `c`.`id_empresa` = `e`.`id_empresa`
            )
        )
        LEFT JOIN `operador` `o` ON (
            `c`.`id_operador` = `o`.`id_operador`
        )
    )
    LEFT JOIN `grupo_contacto` `g` ON (
        `c`.`id_grupo` = `g`.`id_grupo`
    )
);
