<style>
    /* 1. Estado BASE de todos los sub-ítems (Fijamos el espacio para evitar brincos) */
    .sidebar-menu .treeview-menu li a {
        border-radius: 4px;
        margin: 2px 8px;                       /* El margen ya existe siempre */
        transition: background-color 0.2s ease, color 0.2s ease; /* Transición suave */
    }

    /* 2. Al pasar el mouse por encima (Hover suave y natural) */
    .sidebar-menu .treeview-menu li a:hover {
        background-color: rgba(255, 255, 255, 0.08) !important; /* Fondo grisáceo translúcido sutil */
        color: #ffffff !important;
    }

    /* 3. Ítem seleccionado/presionado (Fondo azul formal fijo) */
    .sidebar-menu .treeview-menu li.active a {
        background-color: #1e40af !important;  /* Azul corporativo */
        color: #ffffff !important;             /* Texto blanco */
    }

    /* 4. Fuerza a los iconos a volverse blancos SOLO cuando el botón está activo */
    .sidebar-menu .treeview-menu li.active a i {
        color: #ffffff !important;
    }
</style>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="Views/Images/Users/User2.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="Dashboard">
                    <i class="fa fa-dashboard text-blue"></i>
                    <span>Inicio</span>
                </a>
            </li>

            <!-- SECCIÓN REGISTROS -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit text-blue"></i> 
                    <span>Registros</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="Operator"><i class="fa fa-user-plus text-aqua"></i> Operador</a></li>
                    <li><a href="Companies"><i class="fa fa-plus-square text-green"></i> Empresa</a></li>
                    <li><a href="Contacts"><i class="fa fa-file-text text-orange"></i> Contacto</a></li>
                    <li><a href="Groups"><i class="fa fa-users text-purple"></i> Grupo</a></li>
                </ul>
            </li>

            <!-- SECCIÓN REPORTES -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart text-green"></i>
                    <span>Reportes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="ListOperators"><i class="fa fa-list-ul text-aqua"></i> Listar Operador</a></li>
                    <li><a href="ListCompanies"><i class="fa fa-table text-green"></i> Listar Empresa</a></li>
                    <li><a href="ListContacts"><i class="fa fa-file-text-o text-orange"></i> Listar Contacto</a></li>
                    <li><a href="ListGroups"><i class="fa fa-th-list text-purple"></i> Listar Grupo</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // 1. Desactivar el comportamiento acordeón en el menú de AdminLTE
    $('.sidebar-menu').tree({
        accordion: false
    });

    // 2. Tu lógica existente para marcar la página activa actual
    var exactUrl = window.location.href;
    $('.sidebar-menu > li > a, .treeview-menu li a').filter(function () {
        return this.href === exactUrl || exactUrl.endsWith('/' + $(this).attr('href'));
    }).each(function() {
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    });
});
</script>