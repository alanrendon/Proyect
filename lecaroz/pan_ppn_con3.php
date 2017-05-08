<?php
//------------------------------------------------------------------------------------prueba de pan con pasteles usando DB

// CONSULTA DE PRODUCCION
// Tabla 'produccion'
// Menu 'Panader�as->Producci�n'
//define ('IDSCREEN',1241); // ID de pantalla
// --------------------------------- INCLUDES ----------------------------------------------------------------
include './includes/class.db.inc.php';
include './includes/class.session2.inc.php';
include './includes/class.TemplatePower.inc.php';
include './includes/dbstatus.php';
// --------------------------------- Validar usuario ---------------------------------------------------------
$session = new sessionclass($dsn);
// --------------------------------- Validar acceso de usuario a la pantalla ---------------------------------
//$session->validar_pantalla(IDSCREEN);
// --------------------------------- Obtener informaci�n de la pantalla --------------------------------------
//$session->info_pantalla();
// --------------------------------- Descripcion de errores --------------------------------------------------
$descripcion_error[1] = "La compa��a no existe en la Base de Datos";
$descripcion_error[2] = "No hay registros";
$descripcion_error[3] = "Fecha incorrecta, vericar el formato (dd/mm/aaaa)";
$descripcion_error[4] = "Fecha fuera de rango, vericar el formato (dd/mm/aaaa)";
$descripcion_error[5] = "NO TIENES ASIGNADAS PANADERIAS";
// --------------------------------- Generar pantalla --------------------------------------------------------
// Hacer un nuevo objeto TemplatePower
$tpl = new TemplatePower( "./plantillas/header.tpl" );
// Incluir el cuerpo del documento
//$tpl->assignInclude("body","./plantillas/$session->ruta/$session->plantilla");
$tpl->assignInclude("body","./plantillas/pan/pan_ppn_con2.tpl");
$tpl->prepare();
// Seleccionar script para menu
$tpl->newBlock("menu");
$tpl->assign("menucnt","$_SESSION[menu]_cnt.js");
$tpl->gotoBlock("_ROOT");

$db=new DBclass($dsn,"autocommit=yes");


// -------------------------------- Buscar datos de compa��a -------------------------------------------------
if (!isset($_GET['num_cia'])) {
	$tpl->newBlock("obtener_datos");
//	echo "ENTRE PRUEBA DE PAN 3";
	
	$tpl->assign("anio_actual",date("Y"));
	$pibote=date("d");
	for($i=0;$i<=6;$i++){
		$fecha_anterior= date("j/n/Y",mktime(0,0,0,date("m"),$pibote,date("Y")));
		$letra= date("D",mktime(0,0,0,date("m"),$pibote,date("Y")));
		if($letra=="Sun"){
			$tpl->assign("fecha_anterior",$fecha_anterior);
			break;
		}
		$pibote--;
	}

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
// -------------------------------- SCRIPT ---------------------------------------------------------
// -------------------------------- Mostrar listado ---------------------------------------------------------
$tpl->newBlock("prueba_pan");
//ARROJA EL NUMERO DE ITERACIONES DENTRO DEL FOR A PARTIR DEL RANGO DE FECHAS
//$fecha_inicio='1/'.date("m").'/'.date("Y");
$fech=explode("/",$_GET['fecha_mov']);
$fecha_inicio='1/'.$fech[1].'/'.$fech[2];

if($_GET['tipo_cia'] == 0)
	$cia="select num_cia, nombre_corto from catalogo_companias where num_cia='".$_GET['num_cia']."'";
else if($_GET['tipo_cia'] == 1){
	if($_GET['tipo_total']==0){
		if($_SESSION['iduser']==1 or $_SESSION['iduser']==4){
			$cia="select num_cia, nombre_corto from catalogo_companias where num_cia between 1 and 100 order by num_cia";
		}
		else{
			$opera=$db->query("SELECT * FROM catalogo_operadoras WHERE iduser=$_SESSION[iduser]");
			
			if(!$opera){
				header("location: ./pan_ppn_con.php?codigo_error=5");
				die();
			}
			$cia="select num_cia, nombre_corto from catalogo_companias where idoperadora=".$opera[0]['idoperadora']." and num_cia < 100 order by num_cia";
		}
	}
	else{
		$cia="select num_cia, nombre_corto from catalogo_companias where num_cia between 1 and 100 order by num_cia";
	}
}

$companias = $db->query($cia);

$nombremes[1]="ENERO";
$nombremes[2]="FEBRERO";
$nombremes[3]="MARZO";
$nombremes[4]="ABRIL";
$nombremes[5]="MAYO";
$nombremes[6]="JUNIO";
$nombremes[7]="JULIO";
$nombremes[8]="AGOSTO";
$nombremes[9]="SEPTIEMBRE";
$nombremes[10]="OCTUBRE";
$nombremes[11]="NOVIEMBRE";
$nombremes[12]="DICIEMBRE";

$salto=1;

if($_GET['tipo_cia']==1){
	//PRODUCCIONES
	$sql="select numcia as num_cia,extract(day from fecha_total) as dia,sum(total_produccion) as total from total_produccion where fecha_total between '$fecha_inicio' and '".$_GET['fecha_mov']."' group by numcia,fecha_total order by fecha_total,numcia";
	$produccion=$db->query($sql);
	
	//TOTAL PANADERIAS
	$sql="SELECT num_cia,extract(day from fecha) as dia,sum(pan_p_venta) as reparto, sum(devolucion) as devuelto from mov_expendios where fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' group by num_cia,fecha order by num_cia,fecha";
	$expendios=$db->query($sql);
	
	//PAN COMPRADO CON DESCUENTO
	$sql="SELECT num_cia,extract(day from fecha) as dia, sum(importe) as importe from movimiento_gastos where codgastos=5 and captura=false and fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' group by num_cia,fecha order by num_cia,fecha";
	$comprado_con_desc=$db->query($sql);
	
	//PAN COMPRADO SIN DESCUENTO
	$sql="SELECT num_cia,extract(day from fecha) as dia, sum(importe) as importe from movimiento_gastos where codgastos=152 and captura=false and fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' group by num_cia,fecha order by num_cia,fecha";
	$comprado_sin_desc=$db->query($sql);
	
	//PAN CONTADO DEL DIA
	$sql="select *, extract(day from fecha) as dia  from prueba_pan where fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' order by num_cia, fecha";
	$pan_contado=$db->query($sql);

	//EFECTIVOS DE LA TABLA DE TOTAL PANADERIAS
	$sql="SELECT *, extract(day from fecha) as dia  from total_panaderias where  fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' order by num_cia,fecha";
	$efectivos_tabla=$db->query($sql);
	
	//EFECTIVOS PARA EL DESCUENTO DE PASTEL
	$efe="select *, extract(day from fecha) as dia from captura_efectivos where fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' order by num_cia, fecha";
	$efectivos=$db->query($efe);

}

else{
	//PRODUCCIONES
	$sql="select numcia as num_cia, extract(day from fecha_total) as dia,sum(total_produccion) as total from total_produccion where fecha_total between '$fecha_inicio' and '".$_GET['fecha_mov']."' and numcia= ".$_GET['num_cia']." group by numcia,fecha_total order by fecha_total,numcia";
	$produccion=$db->query($sql);
	
	//TOTAL PANADERIAS
	$sql="SELECT num_cia,extract(day from fecha) as dia,sum(pan_p_venta) as reparto, sum(devolucion) as devuelto from mov_expendios where fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' and num_cia= ".$_GET['num_cia']." group by num_cia,fecha order by num_cia,fecha";
	$expendios=$db->query($sql);
	
	//PAN COMPRADO CON DESCUENTO
	$sql="SELECT num_cia,extract(day from fecha) as dia, sum(importe) as importe from movimiento_gastos where codgastos=5 and captura=false and fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' and num_cia= ".$_GET['num_cia']."  group by num_cia,fecha order by num_cia,fecha";
	$comprado_con_desc=$db->query($sql);
	
	//PAN COMPRADO SIN DESCUENTO
	$sql="SELECT num_cia,extract(day from fecha) as dia, sum(importe) as importe from movimiento_gastos where codgastos=152 and captura=false and fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' and num_cia= ".$_GET['num_cia']."  group by num_cia,fecha order by num_cia,fecha";
	$comprado_sin_desc=$db->query($sql);
	
	//PAN CONTADO DEL DIA
	$sql="select *, extract(day from fecha) as dia  from prueba_pan where fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' and num_cia= ".$_GET['num_cia']."  order by num_cia, fecha";
	$pan_contado=$db->query($sql);

	//EFECTIVOS DE LA TABLA DE TOTAL PANADERIAS
	$sql="SELECT *, extract(day from fecha) as dia  from total_panaderias where  fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' and num_cia= ".$_GET['num_cia']."  order by num_cia,fecha";
	$efectivos_tabla=$db->query($sql);
	
	//EFECTIVOS PARA EL DESCUENTO DE PASTEL
	$efe="select *, extract(day from fecha) as dia from captura_efectivos where num_cia=".$_GET['num_cia']." and fecha between '$fecha_inicio' and '".$_GET['fecha_mov']."' and num_cia= ".$_GET['num_cia']."  order by num_cia, fecha";
	$efectivos=$db->query($efe);
	

}

//---------------------------FUNCIONES DE BUSQUEDA
function buscar_indice($tabla, $num_cia, $dia) {
	for ($i = 0; $i < count($tabla); $i++)
		if ($tabla[$i]['num_cia'] == $num_cia && $tabla[$i]['dia'] == $dia)
			return $i;
	
	return FALSE;
}


//print_r($companias);
if($_GET['tipo_total']==0){
	for($j=0;$j<count($companias);$j++)
	{
		$quebrado=0;
		$prod=0;
		$total_produccion =0;
		$total_pan_comprado =0;
		$total_venta_pta = 0;
		$total_reparto = 0;
		$total_devuelto = 0;
		$total_quebrado = 0;
		$total_desc_pastel = 0;
		$total_diferencia = 0;
		$total_porc_dif = 0;
		$dif_promedio=0;
		$total_gastos=0;
		$total_abono=0;
		$total_pastel_anticipo=0;
		$descuento=0;
		$descuento1=0;
		$var=0;
		$total_efectivos=0;
		$arrastre_sobrante=0;
	
		$sql="select count(distinct(fecha)) from total_panaderias where num_cia=".$companias[$j]['num_cia']." and fecha between '".$fecha_inicio."' AND '".$_GET['fecha_mov']."'";
		$contador=$db->query($sql);
		$cont = $contador[0]['count'];
		if($cont <=0) continue;
	
		$sql2="select distinct(fecha) as fecha_total from total_panaderias where num_cia=".$companias[$j]['num_cia']." and fecha between '".$fecha_inicio."' and '".$_GET['fecha_mov']."'";
		$fechas=$db->query($sql2);

		//PORCENTAJE DE PASTEL
		$porc_pastel = $db->query("select * from porcentaje_pan_comprado where num_cia=".$companias[$j]['num_cia']);


		if($_GET['tipo_total']==0)
		{
			$tpl->newBlock("compania");
			$dia_1=explode("/",$_GET['fecha_mov']);
			$tpl->assign("dia",$dia_1[0]);
			$tpl->assign("anio",$fech[2]);
			$tpl->assign("mes",$nombremes[$fech[1]]);
			$tpl->assign("hora",date("G:i:s"));
			
			$tpl->assign("num_cia",$companias[$j]['num_cia']);
			$tpl->assign("nom_cia",$companias[$j]['nombre_corto']);
		
			for($i=0;$i<$cont;$i++){
				$total_facturas=0;
				$total_anticipadas=0;
				$total_posteriores=0;
				$total_cuenta_liquida=0;
				$total_cuenta_pago=0;
			
				$tpl->newBlock("rows");
				$var++;
				$dia=explode("/",$fechas[$i]['fecha_total']);
				$fecha_anterior=date("d/m/Y",mktime(0,0,0,$dia[1],$dia[0]-1,$dia[2]));
				
				//BUSQUEDA DE INDICES
				$indice_produccion		=	buscar_indice($produccion,$companias[$j]['num_cia'],$dia[0]);
				$indice_total_panaderias=	buscar_indice($efectivos_tabla,$companias[$j]['num_cia'],$dia[0]);
				$indice_efectivos		=	buscar_indice($efectivos,$companias[$j]['num_cia'],$dia[0]);
				$indice_expendios		=	buscar_indice($expendios,$companias[$j]['num_cia'],$dia[0]);
				$indice_contado			=	buscar_indice($pan_contado,$companias[$j]['num_cia'],$dia[0]);
				$indice_con_desc		=	buscar_indice($comprado_con_desc,$companias[$j]['num_cia'],$dia[0]);
				$indice_sin_desc		=	buscar_indice($comprado_sin_desc,$companias[$j]['num_cia'],$dia[0]);
				


				//SOBRANTE DEL DIA ANTERIOR
				$sql="select * from prueba_pan where num_cia=".$companias[$j]['num_cia']." and fecha='".$fecha_anterior."'";
				$sobrante= $db->query($sql);
				if($sobrante){
					//SE AGREGO ESTA LINEA
					if($fech[1]==4 && $fech[2]==2005 && $companias[$j]['num_cia']==31 && $dia[0]==1)
						$aux_sobrante_ayer=1000;
					else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==49 && $dia[0]==1)
						$aux_sobrante_ayer=13000;
					else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==74 && $dia[0]==1)
						$aux_sobrante_ayer=3203;
					else
						$aux_sobrante_ayer=$sobrante[0]['importe'];
				}
				else{
					//se inserto este bloque de codigo
					if($fech[1]==4 && $fech[2]==2005 && $companias[$j]['num_cia']==31 && $dia[0]==1)
						$aux_sobrante_ayer=1000;
					else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==49 && $dia[0]==1)
						$aux_sobrante_ayer=13000;
					else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==74 && $dia[0]==1)
						$aux_sobrante_ayer=3203;
					else if ($fech[1]==6 && $fech[2]==2005 && $companias[$j]['num_cia']==75 && $dia[0]==13)
						$aux_sobrante_ayer=0;
					else
						$aux_sobrante_ayer=@$sobrante_hoy;
				}
				
				if($indice_contado !== FALSE){
					$aux_pan_contado=$pan_contado[$indice_contado]['importe'];
				}
				else{
					$aux_pan_contado=$aux_sobrante_ayer;
				}
//----------------------CODIGO PARA SACAR EL PASTEL ENTREGADO
				$facturas_pago_anticipado=$db->query("select sum(cuenta) as total from venta_pastel where fecha_entrega='".$fechas[$i]['fecha_total']."' and cuenta > 0 and fecha != '".$fechas[$i]['fecha_total']."' and estado != 2 and num_cia=".$companias[$j]['num_cia']);
				$facturas_pago_anticipado_base=$db->query("select sum(base) as base from venta_pastel where fecha_entrega='".$fechas[$i]['fecha_total']."' and cuenta > 0 and fecha != '".$fechas[$i]['fecha_total']."' and estado != 2 and num_cia=".$companias[$j]['num_cia']);
				$facturas_posteriores=$db->query("select sum(cuenta) as total from venta_pastel where fecha='".$fechas[$i]['fecha_total']."' and resta is null and cuenta > 0 and dev_base is null and estado != 2 and num_cia=".$companias[$j]['num_cia']." and fecha_entrega > '".$fechas[$i]['fecha_total']."'");
				$facturas_posteriores_base=$db->query("select sum(base) as base from venta_pastel where fecha='".$fechas[$i]['fecha_total']."' and resta is null and cuenta > 0 and dev_base is null and estado != 2 and num_cia=".$companias[$j]['num_cia']." and fecha_entrega > '".$fechas[$i]['fecha_total']."'");
				$gasto_cancelacion=$db->query("select sum(importe) from movimiento_gastos where fecha='".$fechas[$i]['fecha_total']."' and num_cia=".$companias[$j]['num_cia']." and codgastos=115 and concepto like 'CANCELACION%PASTEL'");

				if($facturas_pago_anticipado)
					$total_anticipado=number_format($facturas_pago_anticipado[0]['total'],2,'.','');
				else
					$total_anticipado=0;
				
				if($facturas_pago_anticipado_base)
					$total_anticipado_base=number_format($facturas_pago_anticipado_base[0]['base'],2,'.','');
				else
					$total_anticipado_base=0;

				if($facturas_posteriores)
					$total_posterior=number_format($facturas_posteriores[0]['total'],2,'.','');
				else
					$total_posterior=0;
				
				if($facturas_posteriores_base)
					$total_posterior_base=number_format($facturas_posteriores_base[0]['base'],2,'.','');
				else
					$total_posterior_base=0;
				$total_pasteles = ($total_anticipado - $total_anticipado_base) - ($total_posterior - $total_posterior_base);

				if($fech[1] < 6 and $fech[2] <= 2005){
					if($indice_con_desc !== FALSE){
						$descuento = $comprado_con_desc[$indice_con_desc]['importe'] * ($porc_pastel[0]['porcentaje']/100);
						$descuento1= $comprado_con_desc[$indice_con_desc]['importe'] + $descuento;
					}
					else
						$descuento1=0;
				}
				else{
					if($indice_con_desc !== FALSE)
						$descuento1 = ($comprado_con_desc[$indice_con_desc]['importe'] / (100 - $porc_pastel[0]['porcentaje']))*100;
					else
						$descuento1 = 0;
				}

				if($indice_sin_desc !== FALSE)
					$descuento1 += number_format($comprado_sin_desc[$indice_sin_desc]['importe'],2,'.','');
					
				if($indice_produccion !== FALSE){
					$prod=$produccion[$indice_produccion]['total'];
					$quebrado = $prod * /*0.02*/0;
				}
				else{
					$prod=0;
					$quebrado=0;
				}
				
				$venta_puerta=$efectivos_tabla[$indice_total_panaderias]['venta_puerta'];
				
				//CALCULO DE TOTAL DE PAN
				$total_pan=$prod+$descuento1+$aux_sobrante_ayer;


				if($indice_expendios !== FALSE)
					$reparto=$expendios[$indice_expendios]['reparto'];
				else
					$reparto = 0;
				
				if($indice_efectivos !== FALSE)
					$desc_pastel=$efectivos[$indice_efectivos]['desc_pastel'];
				else
					$desc_pastel = 0;


				//SOBRANTE DE HOY
				$sobrante_hoy = $total_pan - ($venta_puerta + $total_pasteles )- $reparto-$quebrado-$desc_pastel ;

				//DIFERENCIA
				if($indice_contado !== FALSE){
					$diferencia=$pan_contado[$indice_contado]['importe']-$sobrante_hoy;
					}
				else
					$diferencia=0;

				$tpl->assign("dia",$dia[0]);
				$tpl->assign("produccion",number_format($prod,2,'.',',')); //A
				if($descuento1<=0) $tpl->assign("pan_comprado","");
				else $tpl->assign("pan_comprado",number_format($descuento1,2,'.',','));//B
				
				if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==74 && $dia[0]==1)
					$tpl->assign("sobrante_ayer",number_format($aux_sobrante_ayer,2,'.',','));

				else if($aux_sobrante_ayer<=0) $tpl->assign("sobrante_ayer","");
				else $tpl->assign("sobrante_ayer",number_format($aux_sobrante_ayer,2,'.',','));//C
				
				if($total_pan<=0) $tpl->assign("total_pan","");
				else $tpl->assign("total_pan",number_format($total_pan,2,'.',','));//D
				
				if($venta_puerta<=0) $tpl->assign("venta_puerta","");
				else $tpl->assign("venta_puerta",number_format($venta_puerta,2,'.',','));//E
				
				if($total_pasteles == 0) $tpl->assign("pastel","");
				else $tpl->assign("pastel",number_format($total_pasteles,2,'.',','));
				
				if($indice_expendios !== FALSE){
					if($expendios[$indice_expendios]['reparto']==0) $tpl->assign("reparto","");
					else $tpl->assign("reparto",number_format($expendios[$indice_expendios]['reparto'],2,'.',','));//F
					
					if($expendios[$indice_expendios]['devuelto']<=0) $tpl->assign("pan_devuelto","");
					else $tpl->assign("pan_devuelto",number_format($expendios[$indice_expendios]['devuelto'],2,'.',','));//G
				}
				else{
					$tpl->assign("reparto","");
					$tpl->assign("pan_devuelto","");
				}
				
				if($quebrado<=0) $tpl->assign("pan_quebrado","");
				else $tpl->assign("pan_quebrado",number_format($quebrado,2,'.',','));//H
				
				if($indice_efectivos !==FALSE){
					if($efectivos[$indice_efectivos]['desc_pastel']<=0) $tpl->assign("desc_pastel","");
					else $tpl->assign("desc_pastel",number_format($efectivos[$indice_efectivos]['desc_pastel'],2,'.',','));//I
				}
				else
					$tpl->assign("desc_pastel","");
				
				if($sobrante_hoy<=0) $tpl->assign("sobrante_hoy","");
				else $tpl->assign("sobrante_hoy",number_format($sobrante_hoy,2,'.',','));//J
				
				if($indice_contado !==FALSE)
					$tpl->assign("existencia_fisica",number_format($aux_pan_contado,2,'.',','));//K
				else $tpl->assign("existencia_fisica","");
				
				if($diferencia==0) $tpl->assign("diferencia","");
				else $tpl->assign("diferencia",number_format($diferencia,2,'.',','));//L
				
				$total_gastos += $efectivos_tabla[$indice_total_panaderias]['gastos'];
				$total_abono += $efectivos_tabla[$indice_total_panaderias]['abono'];
				$total_efectivos +=$venta_puerta + $efectivos_tabla[$indice_total_panaderias]['pastillaje'] + $efectivos_tabla[$indice_total_panaderias]['otros']-$efectivos_tabla[$indice_total_panaderias]['raya_pagada'];		
				$total_produccion += $prod;
				$total_pan_comprado += $descuento1;
				$total_venta_pta += $venta_puerta;
				$total_pastel_anticipo += $total_pasteles;
				
				if($indice_expendios!==FALSE){
					$total_reparto += $expendios[$indice_expendios]['reparto'];
					$total_devuelto += $expendios[$indice_expendios]['devuelto'];
				}
				$total_quebrado += $quebrado;
				if($indice_efectivos !==FALSE)
					$total_desc_pastel += $efectivos[$indice_efectivos]['desc_pastel'];
					
				$total_diferencia += $diferencia;
			}

			$porc_dif=($total_diferencia/($total_produccion + $total_pan_comprado))*100;
			$dif_promedio=$total_diferencia / $var;
			$efec=$total_efectivos+$total_abono-$total_gastos;
			$ef_prod=$efec/$total_produccion;
			$tpl->gotoBlock("compania");
			$tpl->assign("total_produccion",number_format($total_produccion,2,'.',','));
			
			if($total_pan_comprado > 0)
				$tpl->assign("total_comprado",number_format($total_pan_comprado,2,'.',','));
			if($total_pastel_anticipo != 0)
				$tpl->assign("total_pastel",number_format($total_pastel_anticipo,2,'.',','));
			if($total_venta_pta > 0)
				$tpl->assign("total_puerta",number_format($total_venta_pta,2,'.',','));
			if($total_reparto > 0)
				$tpl->assign("total_reparto",number_format($total_reparto,2,'.',','));
			if($total_devuelto > 0)
				$tpl->assign("total_devuelto",number_format($total_devuelto,2,'.',','));
			if($total_quebrado > 0)
				$tpl->assign("total_quebrado",number_format($total_quebrado,2,'.',','));
			if($total_desc_pastel > 0)
				$tpl->assign("total_desc_pastel",number_format($total_desc_pastel,2,'.',','));
			$tpl->assign("total_diferencia",number_format($total_diferencia,2,'.',','));
			$tpl->assign("porc_dif",abs(number_format($porc_dif,2,'.',',')));
			$tpl->assign("promedio_dif",number_format($dif_promedio,2,'.',','));
			$tpl->assign("ef_prod",number_format($ef_prod,2,'.',','));
		}
		if($salto % 2 == 0)
			$tpl->newBlock("salto");
		$salto++;
	}
}

//VA A MOSTRAR LOS TOTALES POR COMPA��A	
//*******************************************************************************************************
else if($_GET['tipo_total']==1)
{
	$tpl->newBlock("totales");
	$dia_1=explode("/",$_GET['fecha_mov']);
	$tpl->assign("dia",$dia_1[0]);
	$tpl->assign("anio",$fech[2]);
	$tpl->assign("mes",$nombremes[$fech[1]]);

	for($j=0;$j<count($companias);$j++)
	{
		$quebrado=0;
		$prod=0;
		$total_produccion =0;
		$total_pan_comprado =0;
		$total_venta_pta = 0;
		$total_reparto = 0;
		$total_devuelto = 0;
		$total_quebrado = 0;
		$total_desc_pastel = 0;
		$total_diferencia = 0;
		$total_porc_dif = 0;
		$dif_promedio=0;
		$total_gastos=0;
		$total_abono=0;
		$descuento=0;
		$descuento1=0;
		$var=0;
		$total_efectivos=0;
		$arrastre_sobrante=0;
	
		$sql="select count(distinct(fecha)) from total_panaderias where num_cia=".$companias[$j]['num_cia']." and fecha between '".$fecha_inicio."' AND '".$_GET['fecha_mov']."'";
		$contador=$db->query($sql);
		$cont = $contador[0]['count'];
		if($cont <=0) continue;
	
		$sql2="select distinct(fecha) as fecha_total from total_panaderias where num_cia=".$companias[$j]['num_cia']." and fecha between '".$fecha_inicio."' and '".$_GET['fecha_mov']."'";
		$fechas=$db->query($sql2);

		//PORCENTAJE DE PASTEL
		$porc_pastel = $db->query("select * from porcentaje_pan_comprado where num_cia=".$companias[$j]['num_cia']);
	
		for($i=0;$i<$cont;$i++){
			$total_facturas=0;
			$total_anticipadas=0;
			$total_posteriores=0;
			$total_cuenta_liquida=0;
			$total_cuenta_pago=0;
		
			$var++;
			$dia=explode("/",$fechas[$i]['fecha_total']);
			$fecha_anterior=date("d/m/Y",mktime(0,0,0,$dia[1],$dia[0]-1,$dia[2]));
			
			//BUSQUEDA DE INDICES
			$indice_produccion		=	buscar_indice($produccion,$companias[$j]['num_cia'],$dia[0]);
			$indice_total_panaderias=	buscar_indice($efectivos_tabla,$companias[$j]['num_cia'],$dia[0]);
			$indice_efectivos		=	buscar_indice($efectivos,$companias[$j]['num_cia'],$dia[0]);
			$indice_expendios		=	buscar_indice($expendios,$companias[$j]['num_cia'],$dia[0]);
			$indice_contado			=	buscar_indice($pan_contado,$companias[$j]['num_cia'],$dia[0]);
			$indice_con_desc		=	buscar_indice($comprado_con_desc,$companias[$j]['num_cia'],$dia[0]);
			$indice_sin_desc		=	buscar_indice($comprado_sin_desc,$companias[$j]['num_cia'],$dia[0]);
			


			//SOBRANTE DEL DIA ANTERIOR
			$sql="select * from prueba_pan where num_cia=".$companias[$j]['num_cia']." and fecha='".$fecha_anterior."'";
			$sobrante= $db->query($sql);
			if($sobrante){
				//SE AGREGO ESTA LINEA
				if($fech[1]==4 && $fech[2]==2005 && $companias[$j]['num_cia']==31 && $dia[0]==1)
					$aux_sobrante_ayer=1000;
				else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==49 && $dia[0]==1)
					$aux_sobrante_ayer=13000;
				else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==74 && $dia[0]==1)
					$aux_sobrante_ayer=3203;
				else
					$aux_sobrante_ayer=$sobrante[0]['importe'];
			}
			else{
				//se inserto este bloque de codigo
				if($fech[1]==4 && $fech[2]==2005 && $companias[$j]['num_cia']==31 && $dia[0]==1)
					$aux_sobrante_ayer=1000;
				else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==49 && $dia[0]==1)
					$aux_sobrante_ayer=13000;
				else if ($fech[1]==5 && $fech[2]==2005 && $companias[$j]['num_cia']==74 && $dia[0]==1)
					$aux_sobrante_ayer=3203;
				else if ($fech[1]==6 && $fech[2]==2005 && $companias[$j]['num_cia']==75 && $dia[0]==13)
					$aux_sobrante_ayer=0;
				else
					$aux_sobrante_ayer=@$sobrante_hoy;
			}
			
			if($indice_contado !== FALSE){
				$aux_pan_contado=$pan_contado[$indice_contado]['importe'];
			}
			else{
				$aux_pan_contado=$aux_sobrante_ayer;
			}
//----------------------CODIGO PARA SACAR EL PASTEL ENTREGADO
			$facturas_pago_anticipado=$db->query("select sum(cuenta) as total from venta_pastel where fecha_entrega='".$fechas[$i]['fecha_total']."' and cuenta > 0 and fecha != '".$fechas[$i]['fecha_total']."' and estado != 2 and num_cia=".$companias[$j]['num_cia']);
			$facturas_pago_anticipado_base=$db->query("select sum(base) as base from venta_pastel where fecha_entrega='".$fechas[$i]['fecha_total']."' and cuenta > 0 and fecha != '".$fechas[$i]['fecha_total']."' and estado != 2 and num_cia=".$companias[$j]['num_cia']);
			$facturas_posteriores=$db->query("select sum(cuenta) as total from venta_pastel where fecha='".$fechas[$i]['fecha_total']."' and resta is null and cuenta > 0 and dev_base is null and estado != 2 and num_cia=".$companias[$j]['num_cia']." and fecha_entrega > '".$fechas[$i]['fecha_total']."'");
			$facturas_posteriores_base=$db->query("select sum(base) as base from venta_pastel where fecha='".$fechas[$i]['fecha_total']."' and resta is null and cuenta > 0 and dev_base is null and estado != 2 and num_cia=".$companias[$j]['num_cia']." and fecha_entrega > '".$fechas[$i]['fecha_total']."'");
			$gasto_cancelacion=$db->query("select sum(importe) from movimiento_gastos where fecha='".$fechas[$i]['fecha_total']."' and num_cia=".$companias[$j]['num_cia']." and codgastos=115 and concepto like 'CANCELACION%PASTEL'");

			if($facturas_pago_anticipado)
				$total_anticipado=number_format($facturas_pago_anticipado[0]['total'],2,'.','');
			else
				$total_anticipado=0;
			
			if($facturas_pago_anticipado_base)
				$total_anticipado_base=number_format($facturas_pago_anticipado_base[0]['base'],2,'.','');
			else
				$total_anticipado_base=0;

			if($facturas_posteriores)
				$total_posterior=number_format($facturas_posteriores[0]['total'],2,'.','');
			else
				$total_posterior=0;
			
			if($facturas_posteriores_base)
				$total_posterior_base=number_format($facturas_posteriores_base[0]['base'],2,'.','');
			else
				$total_posterior_base=0;
			$total_pasteles = ($total_anticipado - $total_anticipado_base) - ($total_posterior - $total_posterior_base);

			if($fech[1] < 6 and $fech[2] <= 2005){
				if($indice_con_desc !== FALSE){
					$descuento = $comprado_con_desc[$indice_con_desc]['importe'] * ($porc_pastel[0]['porcentaje']/100);
					$descuento1= $comprado_con_desc[$indice_con_desc]['importe'] + $descuento;
				}
				else
					$descuento1=0;
			}
			else{
				if($indice_con_desc !== FALSE)
					$descuento1 = ($comprado_con_desc[$indice_con_desc]['importe'] / (100 - $porc_pastel[0]['porcentaje']))*100;
				else
					$descuento1 = 0;
			}

			if($indice_sin_desc !== FALSE)
				$descuento1 += number_format($comprado_sin_desc[$indice_sin_desc]['importe'],2,'.','');
				
			if($indice_produccion !== FALSE){
				$prod=$produccion[$indice_produccion]['total'];
				$quebrado = $prod * /*0.02*/0;
			}
			else{
				$prod=0;
				$quebrado=0;
			}
			
			$venta_puerta=$efectivos_tabla[$indice_total_panaderias]['venta_puerta'] + $total_pasteles;
			
			//CALCULO DE TOTAL DE PAN
			$total_pan=$prod+$descuento1+$aux_sobrante_ayer;


			if($indice_expendios !== FALSE)
				$reparto=$expendios[$indice_expendios]['reparto'];
			else
				$reparto = 0;
			
			if($indice_efectivos !== FALSE)
				$desc_pastel=$efectivos[$indice_efectivos]['desc_pastel'];
			else
				$desc_pastel = 0;


			//SOBRANTE DE HOY
			$sobrante_hoy = $total_pan - $venta_puerta - $reparto-$quebrado-$desc_pastel;

			//DIFERENCIA
			if($indice_contado !== FALSE){
				$diferencia=$pan_contado[$indice_contado]['importe']-$sobrante_hoy;
				}
			else
				$diferencia=0;

//------
			$total_gastos += $efectivos_tabla[$indice_total_panaderias]['gastos'];
			$total_abono += $efectivos_tabla[$indice_total_panaderias]['abono'];
			$total_efectivos +=$venta_puerta + $efectivos_tabla[$indice_total_panaderias]['pastillaje'] + $efectivos_tabla[$indice_total_panaderias]['otros']-$efectivos_tabla[$indice_total_panaderias]['raya_pagada'];		
			$total_produccion += $prod;
			$total_pan_comprado += $descuento1;
			$total_venta_pta += $venta_puerta;
			if($indice_expendios!==FALSE){
				$total_reparto += $expendios[$indice_expendios]['reparto'];
				$total_devuelto += $expendios[$indice_expendios]['devuelto'];
			}
			$total_quebrado += $quebrado;
			if($indice_efectivos !==FALSE)
				$total_desc_pastel += $efectivos[$indice_efectivos]['desc_pastel'];
				
			$total_diferencia += $diferencia;
		}
		$porc_dif=($total_diferencia/($total_produccion + $total_pan_comprado))*100;
		$dif_promedio=$total_diferencia / $var;
		$efec=$total_efectivos+$total_abono-$total_gastos;
		$ef_prod=$efec/$total_produccion;
		$tpl->newBlock("rows_totales");
		$tpl->assign("num_cia",$companias[$j]['num_cia']);
		$tpl->assign("nombre_cia",$companias[$j]['nombre_corto']);

		if($total_produccion == 0) $tpl->assign("total_produccion","");
		else
			$tpl->assign("total_produccion",number_format($total_produccion,2,'.',','));

		if($total_pan_comprado == 0) $tpl->assign("total_pan_comprado","");
		else
			$tpl->assign("total_pan_comprado",number_format($total_pan_comprado,2,'.',','));

		if($total_venta_pta == 0) $tpl->assign("total_puerta","");
		else
			$tpl->assign("total_puerta",number_format($total_venta_pta,2,'.',','));

		if($total_reparto == 0) $tpl->assign("reparto","");
		else
			$tpl->assign("reparto",number_format($total_reparto,2,'.',','));
		
		if($total_devuelto == 0) $tpl->assign("total_devuelto","");
		else
			$tpl->assign("total_devuelto",number_format($total_devuelto,2,'.',','));
		
		if($total_quebrado==0) $tpl->assign("total_quebrado","");
		else
			$tpl->assign("total_quebrado",number_format($total_quebrado,2,'.',','));
		
		if($total_desc_pastel==0) $tpl->assign("total_desc_pastel","");
		else
			$tpl->assign("total_desc_pastel",number_format($total_desc_pastel,2,'.',','));
		
		if($total_diferencia==0) $tpl->assign("total_diferencia","");
		else
			$tpl->assign("total_diferencia",number_format($total_diferencia,2,'.',','));
		
		if($porc_dif==0) $tpl->assign("porc_dif","");
		else
			$tpl->assign("porc_dif",abs(number_format($porc_dif,2,'.',',')));
		
		if($dif_promedio==0) $tpl->assign("promedio_dif","");
		else
			$tpl->assign("promedio_dif",number_format($dif_promedio,2,'.',','));

		if($ef_prod==0) $tpl->assign("ef_prod","");
		else
			$tpl->assign("ef_prod",number_format($ef_prod,2,'.',','));
	}
	
}
$tpl->printToScreen();
// --------------------------------------------------------------------------------------------------------
?>