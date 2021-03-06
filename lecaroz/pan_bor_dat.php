<?php
// --------------------------------- INCLUDES ----------------------------------------------------------------
include './includes/class.db.inc.php';
include './includes/class.session2.inc.php';
include './includes/class.TemplatePower.inc.php';
include './includes/dbstatus.php';

// --------------------------------- Validar usuario ---------------------------------------------------------
$session = new sessionclass($dsn);

$descripcion_error[1] = "No hay resultados";

//if ($_SESSION['iduser'] != 1) die(header('location: ./offline.htm'));

// Conectarse a la base de datos
$db = new DBclass($dsn, "autocommit=yes");

if (isset($_POST['id'])) {
	$sql = "UPDATE efectivos_tmp SET ts_aut = now(), iduser = $_SESSION[iduser] WHERE id IN (";
	foreach ($_POST['id'] as $i => $id)
		$sql .= $id . ($i < count($_POST['id']) - 1 ? ', ' : ')');
	$db->query($sql);
	die(header('location: ./pan_bor_dat.php'));
}

// Hacer un nuevo objeto TemplatePower
$tpl = new TemplatePower( "./plantillas/header.tpl" );

// Incluir el cuerpo del documento
$tpl->assignInclude("body","./plantillas/pan/pan_bor_dia.tpl");
$tpl->prepare();

// Seleccionar script para menu
$tpl->newBlock("menu");
$tpl->assign("menucnt","$_SESSION[menu]_cnt.js");
$tpl->gotoBlock("_ROOT");

$sql = "SELECT id, num_cia, nombre_corto AS nombre, fecha FROM efectivos_tmp LEFT JOIN catalogo_companias USING (num_cia) WHERE ts_aut IS NULL GROUP BY id, num_cia, nombre_corto, fecha ORDER BY num_cia, fecha";
$result = $db->query($sql);

if ($result) {
	$cia = NULL;
	foreach ($result as $reg) {
		if ($cia != $reg['num_cia']) {
			$cia = $reg['num_cia'];
			
			$tpl->newBlock('cia');
		}
		$tpl->newBlock('fila');
		$tpl->assign('id', $reg['id']);
		$tpl->assign('num_cia', $reg['num_cia']);
		$tpl->assign('nombre', $reg['nombre']);
		$tpl->assign('fecha', $reg['fecha']);
	}
}

$tpl->printToScreen();
?>