USE bdagenda2026;
-- 1. ELIMINAR TABLA SI EXISTE PARA EVITAR CONFLICTOS
DROP TABLE IF EXISTS persona;

DROP TABLE IF EXISTS contrato;

--! RESET
TRUNCATE TABLE contrato;

-- 2. CREACIÓN DE LA TABLA CONTRATO (Mapeada para que sea compatible con tu PHP actual)
CREATE TABLE contrato (
    id_persona INT AUTO_INCREMENT PRIMARY KEY, -- Funciona como ID del Contrato
    dni VARCHAR(15) NOT NULL UNIQUE, -- Aquí se guardará el NÚMERO DE CONTRATO
    nombres VARCHAR(100) NOT NULL, -- Aquí se guardará el TIPO DE CONTRATO (ej: Indefinido)
    apellidos VARCHAR(100) NOT NULL, -- Aquí se guardará la EMPRESA / CLIENTE
    fecha_nac DATE NOT NULL, -- Aquí se guardará la FECHA DE INICIO del contrato
    correo VARCHAR(150) NOT NULL, -- Aquí se guardará el CORREO DE CONTACTO
    telefono VARCHAR(15) NOT NULL, -- Aquí se guardará el TELÉFONO DE CONTACTO
    monto_pago DECIMAL(10, 2) NOT NULL DEFAULT 1500.00,
    estado_contrato VARCHAR(20) NOT NULL DEFAULT 'Activo'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- 3. INSERCIÓN DE 15 CONTRATOS REALES
INSERT INTO
    contrato (
        dni,
        nombres,
        apellidos,
        fecha_nac,
        correo,
        telefono,
        monto_pago,
        estado_contrato
    )
VALUES (
        'CON-2026-001',
        'Locación de Servicios',
        'Corporación Beta SAC',
        '2026-01-10',
        'contacto@betacorp.com',
        '945123456',
        3500.00,
        'Activo'
    ),
    (
        'CON-2026-002',
        'Plazo Indefinido',
        'Inversiones Globales Larco',
        '2026-01-15',
        'rrhh@invglobales.pe',
        '951753456',
        2800.00,
        'Activo'
    ),
    (
        'CON-2026-003',
        'Tiempo Parcial',
        'Logística del Norte',
        '2026-02-01',
        'gerencia@logisticanorte.com',
        '963258741',
        1200.00,
        'Activo'
    ),
    (
        'CON-2026-004',
        'Contrato de Obra',
        'Constructora Sagitario',
        '2026-02-15',
        'obras@sagitario.com',
        '987456321',
        8500.00,
        'Activo'
    ),
    (
        'CON-2026-005',
        'Suministro Comercial',
        'Alimentos Chimbote EIRL',
        '2026-03-01',
        'ventas@alimentoschimbote.com',
        '912345678',
        4200.00,
        'Activo'
    ),
    (
        'CON-2026-006',
        'Plazo Fijo',
        'Tecnología Aplicada S.A.',
        '2026-03-10',
        'soporte@tecaplicada.pe',
        '934567812',
        3100.00,
        'Activo'
    ),
    (
        'CON-2026-007',
        'Locación de Servicios',
        'Estudio Contable ASOC',
        '2026-03-22',
        'consultas@estudioasoc.com',
        '956781234',
        2500.00,
        'Activo'
    ),
    (
        'CON-2026-008',
        'Servicios No Personales',
        'Municipalidad Provincial',
        '2026-04-02',
        'proveedores@munichimbote.gob.pe',
        '978123456',
        5000.00,
        'Activo'
    ),
    (
        'CON-2026-009',
        'Arrendamiento Comercial',
        'Inmobiliaria El Sol',
        '2026-04-15',
        'alquileres@elsol.com.pe',
        '981234567',
        1800.00,
        'Activo'
    ),
    (
        'CON-2026-010',
        'Plazo Indefinido',
        'Distribuidora Nova',
        '2026-04-18',
        'empleos@distnovaperu.com',
        '923456781',
        2200.00,
        'Activo'
    ),
    (
        'CON-2026-011',
        'Consultoría Externa',
        'Minera Aurífera del Centro',
        '2026-05-01',
        'proyectos@mineracentro.com',
        '945678123',
        9500.00,
        'Activo'
    ),
    (
        'CON-2026-012',
        'Tiempo Parcial',
        'Cafetería & Dulces Gourmet',
        '2026-05-05',
        'administracion@gourmet.com',
        '967812345',
        1025.00,
        'Activo'
    ),
    (
        'CON-2026-013',
        'Contrato de Obra',
        'Desarrollos Hidráulicos',
        '2026-05-12',
        'ingenieria@desahidra.com',
        '989123456',
        7000.00,
        'Activo'
    ),
    (
        'CON-2026-014',
        'Suministro Comercial',
        'Textiles del Pacífico',
        '2026-05-20',
        'compras@textilespacifico.com',
        '911234567',
        3800.00,
        'Activo'
    ),
    (
        'CON-2026-015',
        'Plazo Fijo',
        'Cadenas de Boticas Sana',
        '2026-05-25',
        'facturacion@boticassana.pe',
        '933456781',
        2900.00,
        'Activo'
    ),
    (
        'CON-2026-016',
        'Locación de Servicios',
        'Consultores Chimbote Asociados',
        '2026-05-26',
        'gerencia@consultoreschimbote.com',
        '944112233',
        4500.00,
        'Activo'
    ),
    (
        'CON-2026-017',
        'Plazo Indefinido',
        'Aceros del Perú S.A.',
        '2026-05-27',
        'rrhh@acerosperu.com.pe',
        '955223344',
        6200.00,
        'Activo'
    ),
    (
        'CON-2026-018',
        'Tiempo Parcial',
        'Tiendas Comerciales Express',
        '2026-05-28',
        'soporte@tiendasexpress.pe',
        '966334455',
        1100.00,
        'Activo'
    ),
    (
        'CON-2026-019',
        'Contrato de Obra',
        'Consorcio Vial Ancash',
        '2026-05-29',
        'proyectos@vialancash.com',
        '977445566',
        12500.00,
        'Activo'
    ),
    (
        'CON-2026-020',
        'Suministro Comercial',
        'Pesquera El Puerto SAC',
        '2026-05-30',
        'logistica@pesquerapuerto.com',
        '988556677',
        5300.00,
        'Activo'
    ),
    (
        'CON-2026-021',
        'Plazo Fijo',
        'Sistemas Digitales del Norte',
        '2026-05-31',
        'admin@sistemasdigitales.pe',
        '999667788',
        3400.00,
        'Activo'
    ),
    (
        'CON-2026-022',
        'Arrendamiento Comercial',
        'Inmuebles Industriales Perú',
        '2026-06-01',
        'informes@inmueblesperu.com',
        '911778899',
        2700.00,
        'Activo'
    ),
    (
        'CON-2026-023',
        'Consultoría Externa',
        'Agroindustrias del Santa',
        '2026-06-02',
        'contacto@agrosanta.com.pe',
        '922889900',
        8000.00,
        'Activo'
    ),
    (
        'CON-2026-024',
        'Servicios No Personales',
        'Cámara de Comercio Local',
        '2026-06-03',
        'eventos@camarachimbote.org.pe',
        '933990011',
        1950.00,
        'Activo'
    ),
    (
        'CON-2026-025',
        'Plazo Indefinido',
        'Transportes Rápidos Chimbote',
        '2026-06-04',
        'operaciones@transrapidos.com',
        '944001122',
        3200.00,
        'Activo'
    ),
    (
        'CON-2026-026',
        'Plazo Indefinido',
        'Distribuidora Nova',
        '2026-04-18',
        'empleos@distnovaperu.com',
        '923456781',
        2200.00,
        'Activo'
    ),
    (
        'CON-2026-027',
        'Consultoría Externa',
        'Minera Aurífera del Centro',
        '2026-05-01',
        'proyectos@mineracentro.com',
        '945678123',
        9500.00,
        'Activo'
    ),
    (
        'CON-2026-028',
        'Tiempo Parcial',
        'Cafetería & Dulces Gourmet',
        '2026-05-05',
        'administracion@gourmet.com',
        '967812345',
        1025.00,
        'Activo'
    ),
    (
        'CON-2026-029',
        'Contrato de Obra',
        'Desarrollos Hidráulicos',
        '2026-05-12',
        'ingenieria@desahidra.com',
        '989123456',
        7000.00,
        'Activo'
    ),
    (
        'CON-2026-030',
        'Suministro Comercial',
        'Textiles del Pacífico',
        '2026-05-20',
        'compras@textilespacifico.com',
        '911234567',
        3800.00,
        'Activo'
    ),
    (
        'CON-2026-031',
        'Plazo Fijo',
        'Cadenas de Boticas Sana',
        '2026-05-25',
        'facturacion@boticassana.pe',
        '933456781',
        2900.00,
        'Activo'
    ),
    (
        'CON-2026-032',
        'Locación de Servicios',
        'Consultores Chimbote Asociados',
        '2026-05-26',
        'gerencia@consultoreschimbote.com',
        '944112233',
        4500.00,
        'Activo'
    ),
    (
        'CON-2026-033',
        'Plazo Indefinido',
        'Aceros del Perú S.A.',
        '2026-05-27',
        'rrhh@acerosperu.com.pe',
        '955223344',
        6200.00,
        'Activo'
    ),
    (
        'CON-2026-034',
        'Tiempo Parcial',
        'Tiendas Comerciales Express',
        '2026-05-28',
        'soporte@tiendasexpress.pe',
        '966334455',
        1100.00,
        'Activo'
    ),
    (
        'CON-2026-035',
        'Contrato de Obra',
        'Consorcio Vial Ancash',
        '2026-05-29',
        'proyectos@vialancash.com',
        '977445566',
        12500.00,
        'Activo'
    ),
    (
        'CON-2026-036',
        'Suministro Comercial',
        'Pesquera El Puerto SAC',
        '2026-05-30',
        'logistica@pesquerapuerto.com',
        '988556677',
        5300.00,
        'Activo'
    ),
    (
        'CON-2026-037',
        'Plazo Fijo',
        'Sistemas Digitales del Norte',
        '2026-05-31',
        'admin@sistemasdigitales.pe',
        '999667788',
        3400.00,
        'Activo'
    ),
    (
        'CON-2026-038',
        'Arrendamiento Comercial',
        'Inmuebles Industriales Perú',
        '2026-06-01',
        'informes@inmueblesperu.com',
        '911778899',
        2700.00,
        'Activo'
    ),
    (
        'CON-2026-039',
        'Consultoría Externa',
        'Agroindustrias del Santa',
        '2026-06-02',
        'contacto@agrosanta.com.pe',
        '922889900',
        8000.00,
        'Activo'
    ),
    (
        'CON-2026-040',
        'Servicios No Personales',
        'Cámara de Comercio Local',
        '2026-06-03',
        'eventos@camarachimbote.org.pe',
        '933990011',
        1950.00,
        'Activo'
    ),
    (
        'CON-2026-041',
        'Plazo Indefinido',
        'Transportes Rápidos Chimbote',
        '2026-06-04',
        'operaciones@transrapidos.com',
        '944001122',
        3200.00,
        'Activo'
    ),
    (
        'CON-2026-042',
        'Suministro Comercial',
        'Textiles del Pacífico',
        '2026-05-20',
        'compras@textilespacifico.com',
        '911234567',
        3800.00,
        'Activo'
    ),
    (
        'CON-2026-043',
        'Plazo Fijo',
        'Cadenas de Boticas Sana',
        '2026-05-25',
        'facturacion@boticassana.pe',
        '933456781',
        2900.00,
        'Activo'
    ),
    (
        'CON-2026-044',
        'Locación de Servicios',
        'Consultores Chimbote Asociados',
        '2026-05-26',
        'gerencia@consultoreschimbote.com',
        '944112233',
        4500.00,
        'Activo'
    ),
    (
        'CON-2026-045',
        'Plazo Indefinido',
        'Aceros del Perú S.A.',
        '2026-05-27',
        'rrhh@acerosperu.com.pe',
        '955223344',
        6200.00,
        'Activo'
    ),
    (
        'CON-2026-046',
        'Tiempo Parcial',
        'Tiendas Comerciales Express',
        '2026-05-28',
        'soporte@tiendasexpress.pe',
        '966334455',
        1100.00,
        'Activo'
    ),
    (
        'CON-2026-047',
        'Contrato de Obra',
        'Consorcio Vial Ancash',
        '2026-05-29',
        'proyectos@vialancash.com',
        '977445566',
        12500.00,
        'Activo'
    ),
    (
        'CON-2026-048',
        'Suministro Comercial',
        'Pesquera El Puerto SAC',
        '2026-05-30',
        'logistica@pesquerapuerto.com',
        '988556677',
        5300.00,
        'Activo'
    ),
    (
        'CON-2026-049',
        'Plazo Fijo',
        'Sistemas Digitales del Norte',
        '2026-05-31',
        'admin@sistemasdigitales.pe',
        '999667788',
        3400.00,
        'Activo'
    ),
    (
        'CON-2026-050',
        'Arrendamiento Comercial',
        'Inmuebles Industriales Perú',
        '2026-06-01',
        'informes@inmueblesperu.com',
        '911778899',
        2700.00,
        'Activo'
    ),
    (
        'CON-2026-051',
        'Consultoría Externa',
        'Agroindustrias del Santa',
        '2026-06-02',
        'contacto@agrosanta.com.pe',
        '922889900',
        8000.00,
        'Activo'
    ),
    (
        'CON-2026-052',
        'Servicios No Personales',
        'Cámara de Comercio Local',
        '2026-06-03',
        'eventos@camarachimbote.org.pe',
        '933990011',
        1950.00,
        'Activo'
    ),
    (
        'CON-2026-053',
        'Plazo Indefinido',
        'Transportes Rápidos Chimbote',
        '2026-06-04',
        'operaciones@transrapidos.com',
        '944001122',
        3200.00,
        'Activo'
    );
-- 4. VISTA DE CONTRATOS GENERALES
CREATE OR REPLACE VIEW vista_resumen_contratos AS
SELECT
    id_persona AS id_contrato,
    dni AS numero_contrato,
    nombres AS tipo_contrato,
    apellidos AS empresa_cliente,
    DATE_FORMAT(fecha_nac, '%d/%m/%Y') AS fecha_inicio,
    correo,
    CONCAT('S/ ', FORMAT(monto_pago, 2)) AS monto_total,
    estado_contrato AS estado
FROM contrato;