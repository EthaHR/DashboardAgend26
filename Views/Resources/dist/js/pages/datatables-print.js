/**
 * Shared DataTables print button customization.
 * Injects print-optimized styles, removes the Actions column,
 * and adds a report header with date.
 */
function dtPrintCustomize(win) {
    'use strict';

    if (!win || !win.document) return;

    var $doc = $(win.document);
    var $body = $doc.find('body');

    /* ------------------------------------------------------------------ */
    /*  1. Inject print-optimised CSS into the print window's <head>      */
    /* ------------------------------------------------------------------ */
    var css = [
        'body {',
        '  font-family: "Source Sans Pro", Arial, Helvetica, sans-serif;',
        '  font-size: 10pt; line-height: 1.5;',
        '  color: #1e293b; margin: 0.6in 0.5in;',
        '  -webkit-print-color-adjust: exact;',
        '  print-color-adjust: exact;',
        '}',
        '.print-header {',
        '  margin-bottom: 16pt;',
        '  border-bottom: 2px solid #1e3a5f;',
        '  padding-bottom: 8pt;',
        '}',
        '.print-header h1 {',
        '  font-size: 18pt; font-weight: 700;',
        '  color: #0f172a; margin: 0 0 2pt 0;',
        '}',
        '.print-header .print-date {',
        '  font-size: 9pt; color: #64748b; margin: 0;',
        '}',
        'table {',
        '  width: 100%; border-collapse: collapse;',
        '  margin-top: 4pt;',
        '}',
        'table th {',
        '  background-color: #1e3a5f !important;',
        '  color: #ffffff !important;',
        '  font-weight: 600; font-size: 9pt;',
        '  padding: 6pt 7pt; text-align: left;',
        '  border: 1px solid #cbd5e1;',
        '}',
        'table td {',
        '  padding: 5pt 7pt; border: 1px solid #cbd5e1;',
        '  font-size: 9pt; vertical-align: top;',
        '}',
        'table tr:nth-child(even) td {',
        '  background-color: #f8fafc;',
        '}',
        '.dataTables_info, .dataTables_paginate, .dt-buttons {',
        '  display: none !important;',
        '}',
        '@page {',
        '  margin: 0.5in;',
        '}',
    ].join('\n');

    $('<style>').attr('type', 'text/css').html(css).appendTo($doc.find('head'));

    /* ------------------------------------------------------------------ */
    /*  2. Remove the "Acciones" (Actions) column — always the last one   */
    /* ------------------------------------------------------------------ */
    $body.find('table tr').each(function () {
        $(this).find('th:last, td:last').remove();
    });

    /* ------------------------------------------------------------------ */
    /*  3. Hide leftover DataTables UI fragments                          */
    /* ------------------------------------------------------------------ */
    $body.find('.dataTables_info, .dataTables_paginate, .dt-buttons').hide();

    /* ------------------------------------------------------------------ */
    /*  4. Prepend a report header with the page title and date           */
    /* ------------------------------------------------------------------ */
    var title = win.document.title || 'Reporte';
    var now   = new Date();
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
