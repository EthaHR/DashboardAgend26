<?php
$allowedPages = [
  "Dashboard",
  "Operator",
  "Companies",
  "Contacts",
  "Groups",
  "ListOperators",
  "ListCompanies",
  "ListContacts",
  "ListGroups",
];

$currentPage = $_GET["Pages"] ?? "Dashboard";

$appBase = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php')), '/');
$appBase = ($appBase === '' ? '' : $appBase) . '/';

$asset = static function (string $path) use ($appBase): string {
  return $appBase . ltrim($path, '/');
};
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agenda 2026 — Panel de control</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📈</text></svg>">

  <link rel="stylesheet" href="Views/Resources/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Views/Resources/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="Views/Resources/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="Views/Resources/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="Views/Resources/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="Views/Resources/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="Views/Resources/plugins/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="Views/Resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="Views/Resources/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="Views/Resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <link href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap.css" rel="stylesheet">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <?php if ($currentPage === 'Dashboard'): ?>
  <link rel="stylesheet" href="<?= htmlspecialchars($asset('Views/Pages/DashboardBackend/src/styles/dashboard.css')) ?>">
  <?php endif; ?>
  <link rel="stylesheet" href="<?= htmlspecialchars($asset('Views/Resources/dist/css/print.css')) ?>" media="print">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Header -->
    <?php include "Modules/Header.php" ?>
    
    <!-- Menu -->
    <?php include "Modules/Menu.php" ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <?php
      if (in_array($currentPage, $allowedPages, true)) {
        include "Pages/" . $currentPage . ".php";
      }
      ?>
    </div>
    <?php include "Modules/Footer.php" ?>

  </div>
  <script src="Views/Resources/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="Views/Resources/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>

  <script src="Views/Resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <script src="Views/Resources/bower_components/raphael/raphael.min.js"></script>
  <script src="Views/Resources/bower_components/morris.js/morris.min.js"></script>
  <script src="Views/Resources/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <script src="Views/Resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="Views/Resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="Views/Resources/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <script src="Views/Resources/bower_components/moment/min/moment.min.js"></script>
  <script src="Views/Resources/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="Views/Resources/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="Views/Resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="Views/Resources/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="Views/Resources/fastclick/lib/fastclick.js"></script>
  <script src="Views/Resources/dist/js/adminlte.min.js"></script>


  <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap.js"></script>

  <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

  <script src="Views/Resources/dist/js/pages/dashboard.js"></script>
  <script src="Views/Resources/dist/js/demo.js"></script>
  <script src="Views/Resources/dist/js/pages/datatables-print.js?v=<?= time() ?>"></script>








</body>

</html>