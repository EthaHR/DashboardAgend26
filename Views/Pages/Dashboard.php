<?php

require_once dirname(__DIR__, 2) . '/Model/DashboardStats.php';

$stats = DashboardStats::getCounts();

$kpis = [
    [
        'key'   => 'operadores',
        'label' => 'Total Operadores',
        'icon'  => 'fa-user',
        'tone'  => 'kpi-blue',
    ],
    [
        'key'   => 'empresas',
        'label' => 'Total Empresas',
        'icon'  => 'fa-building',
        'tone'  => 'kpi-green',
    ],
    [
        'key'   => 'contactos',
        'label' => 'Total Contactos',
        'icon'  => 'fa-book',
        'tone'  => 'kpi-amber',
    ],
    [
        'key'   => 'grupos',
        'label' => 'Total Grupos',
        'icon'  => 'fa-users',
        'tone'  => 'kpi-violet',
    ],
];

$quickCreate = [
    ['href' => 'Operator',  'label' => 'Nuevo Operador', 'icon' => 'fa-user-plus', 'tone' => 'qa-blue'],
    ['href' => 'Companies', 'label' => 'Nueva Empresa',  'icon' => 'fa-building',  'tone' => 'qa-green'],
    ['href' => 'Contacts',  'label' => 'Nuevo Contacto', 'icon' => 'fa-envelope', 'tone' => 'qa-amber'],
    ['href' => 'Groups',    'label' => 'Nuevo Grupo',    'icon' => 'fa-users',     'tone' => 'qa-violet'],
];

$quickLists = [
    ['href' => 'ListOperators', 'label' => 'Listar Operadores', 'icon' => 'fa-list'],
    ['href' => 'ListCompanies', 'label' => 'Listar Empresas',   'icon' => 'fa-table'],
    ['href' => 'ListContacts',  'label' => 'Listar Contactos',  'icon' => 'fa-list-alt'],
    ['href' => 'ListGroups',    'label' => 'Listar Grupos',     'icon' => 'fa-th-list'],
];
?>

<section class="content-header dash-page-header">
    <div class="dash-page-header__text">
        <h1>Resumen General</h1>
        <p>Panel de control · Agenda 2026</p>
    </div>
    <div class="dash-page-header__badge">
        <span class="dash-total-pill">
            <i class="fa fa-database"></i>
            <?= number_format($stats['total']) ?> registros en el sistema
        </span>
    </div>
</section>

<section class="content dash-page-content">
    <div class="row dash-kpi-row">
        <?php foreach ($kpis as $kpi): ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <article class="dash-kpi-card <?= htmlspecialchars($kpi['tone']) ?>">
                    <div class="dash-kpi-card__icon">
                        <i class="fa <?= htmlspecialchars($kpi['icon']) ?>"></i>
                    </div>
                    <div class="dash-kpi-card__body">
                        <span class="dash-kpi-card__value"><?= number_format($stats[$kpi['key']]) ?></span>
                        <span class="dash-kpi-card__label"><?= htmlspecialchars($kpi['label']) ?></span>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row dash-actions-row">
        <div class="col-lg-7 col-md-12">
            <div class="dash-panel">
                <div class="dash-panel__head">
                    <h2><i class="fa fa-bolt"></i> Acciones Rápidas</h2>
                    <p>Crear un nuevo registro en cada módulo</p>
                </div>
                <div class="dash-quick-grid dash-quick-grid--create">
                    <?php foreach ($quickCreate as $action): ?>
                        <a href="<?= htmlspecialchars($action['href']) ?>" class="dash-quick-btn <?= htmlspecialchars($action['tone']) ?>">
                            <span class="dash-quick-btn__icon"><i class="fa <?= htmlspecialchars($action['icon']) ?>"></i></span>
                            <span class="dash-quick-btn__label"><?= htmlspecialchars($action['label']) ?></span>
                            <span class="dash-quick-btn__arrow"><i class="fa fa-arrow-right"></i></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-12">
            <div class="dash-panel">
                <div class="dash-panel__head">
                    <h2><i class="fa fa-table"></i> Consultar Registros</h2>
                    <p>Ir directamente a las tablas de cada sección</p>
                </div>
                <div class="dash-quick-grid dash-quick-grid--list">
                    <?php foreach ($quickLists as $action): ?>
                        <a href="<?= htmlspecialchars($action['href']) ?>" class="dash-list-btn">
                            <i class="fa <?= htmlspecialchars($action['icon']) ?>"></i>
                            <span><?= htmlspecialchars($action['label']) ?></span>
                            <i class="fa fa-chevron-right dash-list-btn__chevron"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="dash-panel dash-panel--summary">
                <div class="dash-panel__head">
                    <h2><i class="fa fa-chart-pie"></i> Distribución</h2>
                </div>
                <ul class="dash-distribution">
                    <?php
                    $distribution = [
                        ['key' => 'operadores', 'label' => 'Operadores', 'color' => '#2563eb'],
                        ['key' => 'empresas',   'label' => 'Empresas',   'color' => '#059669'],
                        ['key' => 'contactos',  'label' => 'Contactos',  'color' => '#d97706'],
                        ['key' => 'grupos',     'label' => 'Grupos',     'color' => '#7c3aed'],
                    ];
                    foreach ($distribution as $item):
                        $count = $stats[$item['key']];
                        $pct = $stats['total'] > 0 ? round(($count / $stats['total']) * 100) : 0;
                    ?>
                        <li class="dash-distribution__item">
                            <div class="dash-distribution__meta">
                                <span><?= htmlspecialchars($item['label']) ?></span>
                                <strong><?= number_format($count) ?> <small>(<?= $pct ?>%)</small></strong>
                            </div>
                            <div class="dash-distribution__bar">
                                <span style="width: <?= $pct ?>%; background: <?= htmlspecialchars($item['color']) ?>;"></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
