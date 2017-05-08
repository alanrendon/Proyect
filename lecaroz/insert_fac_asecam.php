<?php

// FACTURAS PROVEEDORES VARIAS
// Tabla 'facturas'
// Menu Proveedores y Facturas -> Proveedores

include './includes/class.db3.inc.php';
include './includes/class.session2.inc.php';
include './includes/dbstatus.php';

// Validar usuario
$session = new sessionclass($dsn);

// Obtener tabla de trabajo


// -------------------------------------------------------------------------------------
// Hacer un nuevo objeto DBclass

$nomproveedor = obtener_registro("catalogo_proveedores",array("num_proveedor"),array(168),"","",$dsn);
$diascredito=$nomproveedor[0]['diascredito'];
$_dt = explode("/",$_POST['fecha_mov']);
$d2 = $_dt[0];
$m2 = $_dt[1];
$y2 = $_dt[2];
$d2 =$d2+$diascredito;
$fecha2=date( "d/m/Y", mktime(0,0,0,$m2,$d2,$y2));
$cia=0;
// Consultar si existe la compa�ia
$iva = number_format($_POST['iva_renta'],2,'.','') + number_format($_POST['iva_capital'],2,'.','') + number_format($_POST['iva_interes'],2,'.','');

if (!existe_registro("facturas", array("num_fact","num_proveedor","num_cia"), array($_POST['num_fact'], 168,$_POST['num_cia']), $dsn)) {

	if($_POST['num_cia']==146) $cia=147;
	else if($_POST['num_cia']==171) $cia==170;
	else $cia=$_POST['num_cia'];
	
//INSERTA A FACTURAS
	$fac['num_proveedor']     = 168;
	$fac['num_cia']           = $_POST['num_cia'];
	$fac['num_fact']          = $_POST['num_fact'];
	$fac['fecha_mov']         = $_POST['fecha_mov'];
	$fac['fecha_ven']         = $fecha2;
	$fac['concepto']          = $_POST['concepto'];
	$fac['imp_sin_iva']       = "0";
	$fac['porciento_iva']     = "0";
	$fac['importe_iva']       = $iva;
	$fac['porciento_ret_isr'] = "0";
	$fac['porciento_ret_iva'] = "0";
	$fac['codgastos']         = $_POST['codgastos'];
	$fac['importe_total']     = $_POST['importe_total'];
	$fac['tipo_factura']      = "0";
	$fac['fecha_captura']     = date("d/m/Y");
	$fac['iduser'] = $_SESSION['iduser'];
	
//INSERTA A GASTOS
	$gas['codgastos'] = $_POST['codgastos'];
	$gas['num_cia']   = $_POST['num_cia'];
	$gas['fecha']     = $_POST['fecha_mov'];
	$gas['importe']   = $_POST['importe_total'];
	$gas['concepto']  = "FACTURA ARRENDADORA ASECAM NO. ".$_POST['num_fact'];
	$gas['captura']	  = "true";
	
//INSERTA A PASIVO A PROVEEDORES
	$sql="
	INSERT INTO 
	pasivo_proveedores (num_cia, num_fact, total, descripcion, fecha_mov, fecha_pago, num_proveedor, codgastos) 
	VALUES (".$cia.", '".$_POST['num_fact']."', '".$_POST['importe_total']."','FACTURA ARRENDADORA ASECAM NO. ".$_POST['num_fact']."', '".$_POST['fecha_mov']."', '".$fecha2."', 168, ".$_POST['codgastos'].")"; 
	ejecutar_script($sql,$dsn); 
	$db = new DBclass($dsn,"facturas",$fac);
	$db->generar_script_insert("");
	$db->ejecutar_script();

	$db1= new DBclass($dsn,"movimiento_gastos",$gas);
	$db1->generar_script_insert("");
	$db1->ejecutar_script();
}
else {
	header("location: ./fac_asecam_cap.php?codigo_error=4");
	die;
}

//print_r($_POST);
header("location: ./fac_asecam_cap.php");
?>