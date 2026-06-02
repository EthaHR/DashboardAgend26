/**
 * Shared DataTables print button customization.
 * Injects print-optimized styles, removes the Actions column,
 * and adds a compact report header with date.
 */
function dtPrintCustomize(win) {
    'use strict';

    if (!win || !win.document) return;

    var $doc  = $(win.document);
    var $head = $doc.find('head');
    var $body = $doc.find('body');

    /* ------------------------------------------------------------------ */
    /*  1. Nuke ALL existing stylesheets in the print window              */
    /* ------------------------------------------------------------------ */
    $head.find('link[rel="stylesheet"], style').remove();

    /* ------------------------------------------------------------------ */
    /*  2. Inject our own minimal CSS — no competing rules                */
    /* ------------------------------------------------------------------ */
    var css = [
        '@page { margin: 0.2in; }',

        'html, body {',
        '  font-family: "Source Sans Pro", Arial, Helvetica, sans-serif !important;',
        '  font-size: 7pt !important;',
        '  line-height: 1.1 !important;',
        '  color: #1e293b !important;',
        '  margin: 0 !important;',
        '  padding: 0 !important;',
        '  background: #fff !important;',
        '  -webkit-print-color-adjust: exact;',
        '  print-color-adjust: exact;',
        '}',

        /* ── Header compacto ── */
        '.print-header {',
        '  margin: 0 0 4pt 0 !important;',
        '  padding-bottom: 2pt !important;',
        '  border-bottom: 1pt solid #1e3a5f !important;',
        '}',
        '.print-header h1 {',
        '  font-size: 9pt !important;',
        '  font-weight: 700 !important;',
        '  color: #0f172a !important;',
        '  margin: 0 0 1pt 0 !important;',
        '  padding: 0 !important;',
        '  line-height: 1.1 !important;',
        '}',
        '.print-header .print-date {',
        '  font-size: 6.5pt !important;',
        '  color: #64748b !important;',
        '  margin: 0 !important;',
        '  padding: 0 !important;',
        '}',

        /* ── Tabla ── */
        'table {',
        '  width: 100% !important;',
        '  border-collapse: collapse !important;',
        '  border-spacing: 0 !important;',
        '  margin: 2pt 0 0 0 !important;',
        '  padding: 0 !important;',
        '}',

        'table thead th {',
        '  background-color: #1e3a5f !important;',
        '  color: #ffffff !important;',
        '  font-weight: 600 !important;',
        '  font-size: 6.5pt !important;',
        '  padding: 1pt 2pt !important;',
        '  border: 0.5pt solid #94a3b8 !important;',
        '  text-align: left !important;',
        '  line-height: 1.05 !important;',
        '  -webkit-print-color-adjust: exact;',
        '  print-color-adjust: exact;',
        '}',

        'table tbody td {',
        '  font-size: 6.5pt !important;',
        '  padding: 1pt 2pt !important;',
        '  border: 0.5pt solid #cbd5e1 !important;',
        '  vertical-align: top !important;',
        '  line-height: 1.1 !important;',
        '  background: #fff !important;',
        '}',

        'table tbody tr:nth-child(even) td {',
        '  background-color: #f8fafc !important;',
        '  -webkit-print-color-adjust: exact;',
        '  print-color-adjust: exact;',
        '}',

        /* ── Ocultar artefactos DataTables ── */
        '.dataTables_info, .dataTables_paginate,',
        '.dataTables_length, .dataTables_filter,',
        '.dt-buttons, .btn { display: none !important; }',
    ].join('\n');

    $('<style>').attr('type', 'text/css').text(css).appendTo($head);

    /* ------------------------------------------------------------------ */
    /*  3. Eliminar columna Acciones (última columna)                     */
    /* ------------------------------------------------------------------ */
    $body.find('table tr').each(function () {
        $(this).find('th:last-child, td:last-child').remove();
    });

    /* ------------------------------------------------------------------ */
    /*  4. Ocultar fragmentos sobrantes de DataTables                    */
    /* ------------------------------------------------------------------ */
    $body.find('.dataTables_info, .dataTables_paginate, .dataTables_length, .dataTables_filter, .dt-buttons').remove();

    /* ------------------------------------------------------------------ */
    /*  5. Encabezado compacto con título y fecha                        */
    /* ------------------------------------------------------------------ */
    var title   = win.document.title || 'Reporte';
    var now     = new Date();
    var dateStr = now.toLocaleDateString('es-ES', {
        year: 'numeric', month: 'long', day: 'numeric'
    });

    $body.prepend(
        '<div class="print-header">' +
            '<h1>' + $('<div>').text(title).html() + '</h1>' +
            '<p class="print-date">Generado: ' + dateStr + '</p>' +
        '</div>'
    );
}