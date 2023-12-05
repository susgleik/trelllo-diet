<?php

require_once("services/rutas.service.php");
require_once("services/tableros.service.php");

$rutas = new RutasService();
$rutas->index();

