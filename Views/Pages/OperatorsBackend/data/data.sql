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

---Indices----
ALTER TABLE `operador`
ADD PRIMARY KEY (`id_operador`),
ADD UNIQUE KEY `uk_nombre_operador` (`nombre_operador`);
