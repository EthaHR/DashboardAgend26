-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2026 a las 14:45:47
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `bdagenda2026`
--
CREATE DATABASE bdagenda2026;

USE bdagenda2026;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
    `id_contacto` int(11) NOT NULL,
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
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO
    `contacto` (
        `id_contacto`,
        `nombres`,
        `apellidos`,
        `id_empresa`,
        `id_operador`,
        `id_grupo`,
        `telefono_movil`,
        `telefono_casa`,
        `correo`,
        `descripcion_grupo`,
        `fecha_cumpleanios`,
        `observaciones`,
        `fecha_registro`
    )
VALUES (
        1,
        'Carlos',
        'Ramirez Torres',
        1,
        'OP001',
        'GR003',
        '987654321',
        '014785236',
        'carlos.ramirez@gmail.com',
        'Compañero de trabajo',
        '1995-04-15',
        'Especialista en soporte técnico',
        '2026-05-26 12:41:11'
    ),
    (
        2,
        'María',
        'Lopez García',
        2,
        'OP002',
        'GR004',
        '956321478',
        NULL,
        'maria.lopez@gmail.com',
        'Cliente frecuente',
        '1992-07-22',
        'Interesada en servicios web',
        '2026-05-26 12:41:11'
    ),
    (
        3,
        'José',
        'Fernandez Ruiz',
        3,
        'OP003',
        'GR002',
        '945874123',
        '016325874',
        'josef@gmail.com',
        'Amigo de universidad',
        '1990-10-05',
        'Ingeniero de Software',
        '2026-05-26 12:41:11'
    ),
    (
        4,
        'Andrea',
        'Vargas Silva',
        4,
        'OP001',
        'GR001',
        '978541236',
        NULL,
        'andrea.vargas@gmail.com',
        'Prima',
        '1998-01-18',
        'Vive en Trujillo',
        '2026-05-26 12:41:11'
    ),
    (
        5,
        'Luis',
        'Mendoza Castro',
        5,
        'OP004',
        'GR005',
        '965874123',
        '017854123',
        'luis.mendoza@gmail.com',
        'Proveedor de equipos',
        '1989-12-11',
        'Entrega equipos de cómputo',
        '2026-05-26 12:41:11'
    ),
    (
        6,
        'Fernanda',
        'Quispe León',
        1,
        'OP002',
        'GR003',
        '951236478',
        NULL,
        'fernanda.quispe@gmail.com',
        'Área administrativa',
        '1997-08-09',
        'Responsable de RRHH',
        '2026-05-26 12:41:11'
    ),
    (
        7,
        'Miguel',
        'Torres Salas',
        2,
        'OP003',
        'GR002',
        '987123654',
        '015874123',
        'miguel.torres@gmail.com',
        'Amigo del instituto',
        '1994-03-27',
        'Trabaja en desarrollo web',
        '2026-05-26 12:41:11'
    ),
    (
        8,
        'Patricia',
        'Gomez Rojas',
        3,
        'OP001',
        'GR004',
        '954123789',
        NULL,
        'patricia.gomez@gmail.com',
        'Cliente corporativo',
        '1991-11-14',
        'Solicita soporte mensual',
        '2026-05-26 12:41:11'
    ),
    (
        9,
        'Ricardo',
        'Paredes Molina',
        1,
        'OP001',
        'GR003',
        '989741236',
        NULL,
        'ricardo.paredes@gmail.com',
        'Área de desarrollo',
        '1993-05-10',
        'Programador backend',
        '2026-05-26 12:42:28'
    ),
    (
        10,
        'Lucía',
        'Navarro Peña',
        2,
        'OP002',
        'GR001',
        '964852317',
        '015214785',
        'lucia.navarro@gmail.com',
        'Hermana',
        '1996-09-12',
        'Docente de primaria',
        '2026-05-26 12:42:28'
    ),
    (
        11,
        'Javier',
        'Salazar Ríos',
        3,
        'OP003',
        'GR004',
        '978563214',
        NULL,
        'javier.salazar@gmail.com',
        'Cliente potencial',
        '1988-06-20',
        'Interesado en hosting',
        '2026-05-26 12:42:28'
    ),
    (
        12,
        'Daniela',
        'Cruz Herrera',
        4,
        'OP004',
        'GR002',
        '952147836',
        '044785236',
        'daniela.cruz@gmail.com',
        'Amiga del trabajo',
        '1999-02-08',
        'Analista de sistemas',
        '2026-05-26 12:42:28'
    ),
    (
        13,
        'Pedro',
        'Gutiérrez Soto',
        5,
        'OP001',
        'GR005',
        '987412365',
        NULL,
        'pedro.gs@gmail.com',
        'Proveedor tecnológico',
        '1987-03-17',
        'Distribuidor de laptops',
        '2026-05-26 12:42:28'
    ),
    (
        14,
        'Valeria',
        'Campos León',
        1,
        'OP002',
        'GR003',
        '951478236',
        '014789632',
        'valeria.campos@gmail.com',
        'Compañera de oficina',
        '1994-11-29',
        'Encargada de logística',
        '2026-05-26 12:42:28'
    ),
    (
        15,
        'Hugo',
        'Mendoza Flores',
        2,
        'OP003',
        'GR002',
        '963258741',
        NULL,
        'hugo.mendoza@gmail.com',
        'Amigo de SENATI',
        '1995-07-14',
        'Desarrollador frontend',
        '2026-05-26 12:42:28'
    ),
    (
        16,
        'Sandra',
        'Rojas Vidal',
        3,
        'OP004',
        'GR001',
        '954789123',
        '016741258',
        'sandra.rojas@gmail.com',
        'Tía',
        '1991-04-03',
        'Vive en Arequipa',
        '2026-05-26 12:42:28'
    ),
    (
        17,
        'Kevin',
        'Ortega Silva',
        4,
        'OP001',
        'GR004',
        '986325147',
        NULL,
        'kevin.ortega@gmail.com',
        'Cliente corporativo',
        '1998-12-21',
        'Requiere soporte remoto',
        '2026-05-26 12:42:28'
    ),
    (
        18,
        'Tatiana',
        'Delgado Ruiz',
        5,
        'OP002',
        'GR005',
        '979852364',
        '017852369',
        'tatiana.delgado@gmail.com',
        'Proveedor de software',
        '1990-01-30',
        'Brinda licencias empresariales',
        '2026-05-26 12:42:28'
    );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
    `id_empresa` int(11) NOT NULL,
    `nombre_empresa` varchar(60) NOT NULL,
    `direccion` varchar(80) DEFAULT NULL,
    `telefono` char(11) DEFAULT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO
    `empresa` (
        `id_empresa`,
        `nombre_empresa`,
        `direccion`,
        `telefono`,
        `fecha_registro`
    )
VALUES (
        1,
        'TechSolutions SAC',
        'Av. Los Programadores 120 - Lima',
        '014587412',
        '2026-05-26 12:40:37'
    ),
    (
        2,
        'Innova Systems',
        'Jr. Tecnología 450 - Lima',
        '015874123',
        '2026-05-26 12:40:37'
    ),
    (
        3,
        'GlobalNet Peru',
        'Av. Industrial 890 - Arequipa',
        '016325874',
        '2026-05-26 12:40:37'
    ),
    (
        4,
        'SoftCompany SAC',
        'Calle Primavera 741 - Trujillo',
        '014785236',
        '2026-05-26 12:40:37'
    ),
    (
        5,
        'DataCenter Peru',
        'Av. Central 300 - Chiclayo',
        '017854123',
        '2026-05-26 12:40:37'
    );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_contacto`
--

CREATE TABLE `grupo_contacto` (
    `id_grupo` char(5) NOT NULL,
    `nombre_grupo` varchar(60) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_contacto`
--

INSERT INTO
    `grupo_contacto` (
        `id_grupo`,
        `nombre_grupo`,
        `fecha_registro`
    )
VALUES (
        'GR001',
        'Familia',
        '2026-05-26 12:40:57'
    ),
    (
        'GR002',
        'Amigos',
        '2026-05-26 12:40:57'
    ),
    (
        'GR003',
        'Trabajo',
        '2026-05-26 12:40:57'
    ),
    (
        'GR004',
        'Clientes',
        '2026-05-26 12:40:57'
    ),
    (
        'GR005',
        'Proveedores',
        '2026-05-26 12:40:57'
    );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operador`
--

CREATE TABLE `operador` (
    `id_operador` char(5) NOT NULL,
    `nombre_operador` varchar(45) NOT NULL,
    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operador`
--

INSERT INTO
    `operador` (
        `id_operador`,
        `nombre_operador`,
        `fecha_registro`
    )
VALUES (
        'OP001',
        'Claro',
        '2026-05-26 12:40:27'
    ),
    (
        'OP002',
        'Movistar',
        '2026-05-26 12:40:27'
    ),
    (
        'OP003',
        'Entel',
        '2026-05-26 12:40:27'
    ),
    (
        'OP004',
        'Bitel',
        '2026-05-26 12:40:27'
    );

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_contactos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_contactos` (
    `id_contacto` int(11),
    `nombres` varchar(80),
    `apellidos` varchar(80),
    `nombre_empresa` varchar(60),
    `nombre_operador` varchar(45),
    `nombre_grupo` varchar(60),
    `telefono_movil` char(11),
    `correo` varchar(90)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_contactos`
--
DROP TABLE IF EXISTS `vista_contactos`;

CREATE ALGORITHM = UNDEFINED DEFINER = `root` @`localhost` SQL SECURITY DEFINER VIEW `vista_contactos` AS
SELECT
    `c`.`id_contacto` AS `id_contacto`,
    `c`.`nombres` AS `nombres`,
    `c`.`apellidos` AS `apellidos`,
    `e`.`nombre_empresa` AS `nombre_empresa`,
    `o`.`nombre_operador` AS `nombre_operador`,
    `g`.`nombre_grupo` AS `nombre_grupo`,
    `c`.`telefono_movil` AS `telefono_movil`,
    `c`.`correo` AS `correo`
FROM (
        (
            (
                `contacto` `c`
                join `empresa` `e` on (
                    `c`.`id_empresa` = `e`.`id_empresa`
                )
            )
            join `operador` `o` on (
                `c`.`id_operador` = `o`.`id_operador`
            )
        )
        join `grupo_contacto` `g` on (
            `c`.`id_grupo` = `g`.`id_grupo`
        )
    );

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
ADD PRIMARY KEY (`id_contacto`),
ADD KEY `idx_contacto_empresa` (`id_empresa`),
ADD KEY `idx_contacto_operador` (`id_operador`),
ADD KEY `idx_contacto_grupo` (`id_grupo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
ADD PRIMARY KEY (`id_empresa`),
ADD UNIQUE KEY `uk_nombre_empresa` (`nombre_empresa`);

--
-- Indices de la tabla `grupo_contacto`
--
ALTER TABLE `grupo_contacto`
ADD PRIMARY KEY (`id_grupo`),
ADD UNIQUE KEY `uk_nombre_grupo` (`nombre_grupo`);

--
-- Indices de la tabla `operador`
--
ALTER TABLE `operador`
ADD PRIMARY KEY (`id_operador`),
ADD UNIQUE KEY `uk_nombre_operador` (`nombre_operador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 19;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
ADD CONSTRAINT `fk_contacto_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_contacto_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_contacto` (`id_grupo`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_contacto_operador` FOREIGN KEY (`id_operador`) REFERENCES `operador` (`id_operador`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;