<?php
// CONSUMO DE AVIO
// Tablas varias ''
// Menu 'Panader�as->Producci�n'

define ('IDSCREEN',1222); // ID de pantalla

// --------------------------------- INCLUDES ----------------------------------------------------------------
include './includes/class.db3.inc.php';
include './includes/class.session2.inc.php';
include './includes/class.TemplatePower.inc.php';
include './includes/dbstatus.php';

// --------------------------------- Validar usuario ---------------------------------------------------------
$session = new sessionclass($dsn);

// --------------------------------- Validar acceso de usuario a la pantalla ---------------------------------
$session->validar_pantalla(IDSCREEN);

// --------------------------------- Obtener informaci�n de la pantalla --------------------------------------
$session->info_pantalla();

// --------------------------------- Descripcion de errores --------------------------------------------------
$descripcion_error[1] = "La compa&ntilde;&iacute;a no existe en la Base de Datos";

// --------------------------------- Capturar datos ----------------------------------------------------------
if (isset($_GET['tabla'])) {
	// Ordenar datos para mov_inv_real y mov_inv_virtual
	$count1 = 0;
	$count2 = 0;
	// Movimientos de entrada
	for ($i=0; $i<$_POST['numfilas']; $i++) {
		if ($_POST['entrada'.$i] > 0) {
			$mov_virtual['num_cia'.$count1]       = $_POST['num_cia'];
			$mov_virtual['codmp'.$count1]         = $_POST['codmp_entrada'.$i];
			$mov_virtual['fecha'.$count1]         = $_POST['fecha'];
			$mov_virtual['cod_turno'.$count1]     = "";
			$mov_virtual['tipo_mov'.$count1]      = "FALSE";
			$mov_virtual['cantidad'.$count1]      = $_POST['entrada'.$i];
			$mov_virtual['existencia'.$count1]    = "0";
			$mov_virtual['precio'.$count1]        = $_POST['precio_unidad_entrada'.$i];
			$mov_virtual['total_mov'.$count1]     = $_POST['entrada'.$i] * $_POST['precio_unidad_entrada'.$i];
			$mov_virtual['precio_unidad'.$count1] = $_POST['precio_unidad_entrada'.$i];
			$mov_virtual['descripcion'.$count1]   = "ENTRADA VIRTUAL DE AVIO";
			
			// Actualizar inventario virtual
			//if (existe_registro("inventario_virtual",array("num_cia","codmp"),array($_POST['num_cia'],$_POST['codmp_entrada'.$i]),$dsn))
			ejecutar_script("UPDATE inventario_virtual SET existencia=existencia+".$_POST['entrada'.$i].",fecha_entrada='$_POST[fecha]' WHERE num_cia=$_POST[num_cia] AND codmp=".$_POST['codmp_entrada'.$i],$dsn);
			/*else
				ejecutar_script("INSERT INTO inventario_virtual (num_cia,codmp,fecha_entrada,fecha_salida,existencia,precio_unidad) VALUES ($_POST[num_cia],".$_POST['codmp'.$i].",'$_POST[fecha]',NULL,".$_POST['entrada'.$i].",0)",$dsn);*/
			
			$count1++;
		}
	}
	// Movimientos de salida
	for ($i=0; $i<$_POST['numelementos']; $i++) {
		if ($_POST['consumo'.$i] > 0) {
			$mov_virtual['num_cia'.$count1]       = $_POST['num_cia'];
			$mov_virtual['codmp'.$count1]         = $_POST['codmp'.$i];
			$mov_virtual['fecha'.$count1]         = $_POST['fecha'];
			$mov_virtual['cod_turno'.$count1]     = $_POST['cod_turno'.$i];
			$mov_virtual['tipo_mov'.$count1]      = "TRUE";
			$mov_virtual['cantidad'.$count1]      = $_POST['consumo'.$i];
			$mov_virtual['existencia'.$count1]    = "0";
			$mov_virtual['precio'.$count1]        = $_POST['precio_unidad'.$i];
			$mov_virtual['total_mov'.$count1]     = $_POST['consumo'.$i] * $_POST['precio_unidad'.$i];
			$mov_virtual['precio_unidad'.$count1] = $_POST['precio_unidad'.$i];
			$mov_virtual['descripcion'.$count1]   = "SALIDA VIRTUAL DE AVIO";
			
			$mov_real['num_cia'.$count2]       = $_POST['num_cia'];
			$mov_real['codmp'.$count2]         = $_POST['codmp'.$i];
			$mov_real['fecha'.$count2]         = $_POST['fecha'];
			$mov_real['cod_turno'.$count2]     = $_POST['cod_turno'.$i];
			$mov_real['tipo_mov'.$count2]      = "TRUE";
			$mov_real['cantidad'.$count2]      = $_POST['consumo'.$i];
			$mov_real['existencia'.$count2]    = "0";
			$mov_real['precio'.$count2]        = $_POST['precio_unidad'.$i];
			$mov_real['total_mov'.$count2]     = $_POST['consumo'.$i] * $_POST['precio_unidad'.$i];
			$mov_real['precio_unidad'.$count2] = $_POST['precio_unidad'.$i];
			$mov_real['descripcion'.$count2]   = "SALIDA DE AVIO";
			
			if (existe_registro("inventario_virtual",array("num_cia","codmp"),array($_POST['num_cia'],$_POST['codmp'.$i]),$dsn)) {
				ejecutar_script("UPDATE inventario_virtual SET existencia=existencia-".$_POST['consumo'.$i].",fecha_salida='$_POST[fecha]' WHERE num_cia=$_POST[num_cia] AND codmp=".$_POST['codmp'.$i],$dsn);
				ejecutar_script("UPDATE inventario_real SET existencia=existencia-".$_POST['consumo'.$i].",fecha_salida='$_POST[fecha]' WHERE num_cia=$_POST[num_cia] AND codmp=".$_POST['codmp'.$i],$dsn);
			}
			
			$count1++;
			$count2++;
		}
	}
	
	// Insertar movimientos
	$db_virtual = new DBclass($dsn,"mov_inv_virtual",$mov_virtual);
	$db_virtual->xinsertar();
	
	$db_real = new DBclass($dsn,"mov_inv_real",$mov_real);
	$db_real->xinsertar();
	
	unset($db_virtual);
	unset($db_real);
}

// --------------------------------- Generar pantalla --------------------------------------------------------
// Hacer un nuevo objeto TemplatePower
$tpl = new TemplatePower( "./plantillas/header.tpl" );

// Incluir el cuerpo del documento
$tpl->assignInclude("body","./plantillas/$session->ruta/$session->plantilla");
$tpl->prepare();

// Seleccionar script para menu
$tpl->newBlock("menu");
$tpl->assign("menucnt","$_SESSION[menu]_cnt.js");
$tpl->gotoBlock("_ROOT");

// -------------------------------- Capturar compa��a -------------------------------------------------------
if (!isset($_GET['num_cia'])) {
	$tpl->newBlock("obtener_datos");
	
	// Si viene de una p�gina que genero error
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
	die();
}

// ----------------------------- Generar pantalla de captura ----------------------------------
// Verificar si existe la compa��a
if (!$cia = obtener_registro("catalogo_companias", array("num_cia"), array($_GET['num_cia']),"","",$dsn)) {
	header("location: ./pan_avi_cap.php?codigo_error=1");
	die();
}

// Obtener ultima fecha de inventario virtual
if ($ultima_fecha = ejecutar_script("SELECT fecha FROM mov_inv_virtual WHERE num_cia=$_GET[num_cia] AND tipo_mov = 'TRUE' ORDER BY fecha DESC LIMIT 1",$dsn)) {
	ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})",$ultima_fecha[0]['fecha'],$temp);
	$fecha = date("d/m/Y",mktime(0,0,0,$temp[2],$temp[1]+1,$temp[3]));
}
else {
	$fecha = date("d/m/Y",mktime(0,0,0,date("m"),1,date("Y")));
}

// Asignar numero y nombre de compa�ia, asi como la fecha de captura
$tpl->newBlock("hoja");
$tpl->assign("num_cia",$_GET['num_cia']);
$tpl->assign("nombre_cia",$cia[0]['nombre_corto']);
$tpl->assign("fecha",$fecha);
$tpl->assign("tabla","mov_inv_virtual");

// Obtener materias primas controladas por turno para la compa��a en uso
$avio = ejecutar_script("SELECT * FROM control_avio LEFT JOIN catalogo_mat_primas USING(codmp) LEFT JOIN inventario_virtual USING(num_cia,codmp) WHERE num_cia=$_GET[num_cia] ORDER BY num_orden ASC",$dsn);
$result = ejecutar_script("SELECT count(codmp) FROM (SELECT codmp FROM control_avio WHERE num_cia=$_GET[num_cia] GROUP BY codmp) AS elementos",$dsn);
$numfilas = $result[0]['count'];

$tpl->assign("numelementos",count($avio));
$tpl->assign("numfilas",$numfilas);

$mp = NULL;
$fila = 0;
for ($i=0; $i<count($avio); $i++) {
	// Crear bloque de materia prima
	if ($avio[$i]['codmp'] != $mp) {
		$mp = $avio[$i]['codmp'];
		$tpl->newBlock("mp");
		$tpl->assign("mp",$avio[$i]['nombre']);
		$tpl->assign("i",$fila);
		
		$tpl->assign("codmp_entrada",$avio[$i]['codmp']);
		$tpl->assign("precio_unidad_entrada",$avio[$i]['precio_unidad']);
		
		$tpl->assign("next",($fila<$numfilas-1)?$i:0);
		$tpl->assign("back",($fila>0)?$i-1:count($avio)-1);
		
		$tpl->assign("bottom",($fila<$numfilas-1)?$fila+1:0);
		$tpl->assign("top",($fila>0)?$fila-1:$numfilas-1);
		
		$tpl->assign("existencia",number_format($avio[$i]['existencia'],2,".",""));
		
		$fila++;
	}
	
	switch ($avio[$i]['cod_turno']) {
		case 1:  $tpl->newBlock("fd"); break;
		case 2:  $tpl->newBlock("fn"); break;
		case 3:  $tpl->newBlock("bd"); break;
		case 4:  $tpl->newBlock("repostero"); break;
		case 8:  $tpl->newBlock("piconero"); break;
		case 9:  $tpl->newBlock("gelatinero"); break;
		case 10: $tpl->newBlock("despacho"); break;
	}
	$tpl->assign("i",$i);
	$tpl->assign("fila",$fila-1);
	
	$tpl->assign("codmp",$avio[$i]['codmp']);
	$tpl->assign("precio_unidad",$avio[$i]['precio_unidad']);
	
	$tpl->assign("next",($i<count($avio)-1)?"consumo".($i+1):"entrada0");
	$tpl->assign("back",($i>0)?"consumo".($i-1):"consumo".(count($avio)-1));
}

// Imprimir el resultado
$tpl->printToScreen();
?>