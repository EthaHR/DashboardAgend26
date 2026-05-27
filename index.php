<?php
ob_start();      // <--- 1. Evita errores de "headers already sent"
session_start(); // <--- 2. Inicia la sesión global para todo el Dashboard


include "Controller/Template.Controller.php";
$template = new ControllerTemplate;
$template->controllerTemplate();
