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

---Indices----
ALTER TABLE `grupo_contacto`
ADD PRIMARY KEY (`id_grupo`),
ADD UNIQUE KEY `uk_nombre_grupo` (`nombre_grupo`);
