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
    ),
    (
        6,
        'NetPlus Technologies',
        'Av. Javier Prado 450 - San Isidro',
        '011223344',
        '2026-05-27 09:15:22'
    ),
    (
        7,
        'CloudWare Perú',
        'Calle Las Begonias 120 - Miraflores',
        '011334455',
        '2026-05-27 10:30:45'
    ),
    (
        8,
        'DataFlow Solutions',
        'Av. Arequipa 5000 - Lince',
        '011445566',
        '2026-05-27 14:20:10'
    ),
    (
        9,
        'SoftAndes Corporation',
        'Jr. Unión 300 - Cercado de Lima',
        '011556677',
        '2026-05-28 11:05:33'
    ),
    (
        10,
        'InfoSys Perú',
        'Av. Benavides 1200 - Santiago de Surco',
        '011667788',
        '2026-05-28 16:40:20'
    ),
    (
        11,
        'WebDesign Studio',
        'Calle Diego Ferré 180 - Barranco',
        '011778899',
        '2026-05-29 08:30:15'
    ),
    (
        12,
        'MobileApps SAC',
        'Av. Primavera 220 - San Borja',
        '011889900',
        '2026-05-29 12:15:40'
    ),
    (
        13,
        'TechInnovate Labs',
        'Jr. Washington 350 - Jesús María',
        '011990011',
        '2026-05-29 15:45:05'
    ),
    (
        14,
        'DigitalPacific S.A.',
        'Av. Morro Solar 180 - Chorrillos',
        '012001122',
        '2026-05-30 09:20:30'
    ),
    (
        15,
        'AndesTech Solutions',
        'Calle Rioja 150 - San Miguel',
        '012112233',
        '2026-05-30 13:55:15'
    ),
    (
        16,
        'PacificData Networks',
        'Av. La Fontana 440 - La Molina',
        '012223344',
        '2026-05-30 16:30:40'
    ),
    (
        17,
        'Innovatec Perú',
        'Jr. Conde de Superunda 120 - Pueblo Libre',
        '012334455',
        '2026-05-31 10:05:25'
    ),
    (
        18,
        'CodeCrafters S.R.L.',
        'Av. República de Panamá 3050 - Surquillo',
        '012445566',
        '2026-05-31 14:35:10'
    ),
    (
        19,
        'SysAdmin Perú',
        'Calle José Galvez 550 - Pueblo Libre',
        '012556677',
        '2026-06-01 09:10:05'
    ),
    (
        20,
        'Lambda Technologies',
        'Av. Sánchez Cerro 2400 - Cercado de Lima',
        '012667788',
        '2026-06-01 12:45:30'
    );

---Indices----
ALTER TABLE `empresa`
ADD PRIMARY KEY (`id_empresa`),
ADD UNIQUE KEY `uk_nombre_empresa` (`nombre_empresa`);

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 21;