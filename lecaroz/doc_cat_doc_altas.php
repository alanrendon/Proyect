<?php
// --------------------------------- INCLUDES ----------------------------------------------------------------
include './includes/class.db.inc.php';
include './includes/class.session2.inc.php';
include './includes/class.TemplatePower.inc.php';
include './includes/dbstatus.php';

// --------------------------------- Validar usuario ---------------------------------------------------------
$session = new sessionclass($dsn);

$db = new DBclass("pgsql://mollendo:pobgnj@127.0.0.1:5432/scans", "autocommit=yes");

// --------------------------------- Validar acceso de usuario a la pantalla ---------------------------------
//$session->validar_pantalla(IDSCREEN);

// --------------------------------- Obtener información de la pantalla --------------------------------------
//$session->info_pantalla();

$descripcion_error[1] = "El concepto ya existe en el catálogo";

// --------------------------------- Delaracion de variables -------------------------------------------------

if (isset($_POST['descripcion'])) {
	$descripcion = strtoupper($_POST['descripcion']);
	
	// Veiricar que no exista la entrada
	if ($db->query("SELECT * FROM catalogo_documentos WHERE descripcion = '$descripcion'")) {
		$db->desconectar();
		header("location: ./doc_cat_doc_altas.php?codigo_error=1");
		die;
	}
	
	$sql = "INSERT INTO catalogo_documentos (descripcion,tipo_hoja) VALUES ('$descripcion',$_POST[tipo_hoja])";
	$db->query($sql);
	$db->desconectar();
	
	header("location: ./doc_cat_doc_altas.php");
	die;
}

// Hacer un nuevo objeto TemplatePower
$tpl = new TemplatePower( "./plantillas/header.tpl" );
$tpl->assignInclude("body", "./plantillas/doc/doc_cat_doc_altas.tpl" );
$tpl->prepare();

//Seleccionar el script para menu
$tpl->newBlock("menu");
$tpl->assign("menucnt","$_SESSION[menu]_cnt.js");
$tpl->gotoBlock("_ROOT");

// Si viene de una página que genero error
if (isset($_GET['codigo_error'])) {
	$tpl->newBlock("error");
	$tpl->newBlock("message");
	$tpl->assign( "message", $descripcion_error[$_GET['codigo_error']]);	
}

if (isset($_GET['mensaje'])) {
	$tpl->newBlock("message");
	$tpl->assign("message", $_GET['mensaje']);
}

$tpl->printToScreen();
$db->desconectar();
?>