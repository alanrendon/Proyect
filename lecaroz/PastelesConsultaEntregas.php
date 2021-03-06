<?php

include 'includes/class.db.inc.php';
include 'includes/class.session2.inc.php';
include 'includes/class.TemplatePower.inc.php';
include 'includes/dbstatus.php';

function toInt($value) {
	return intval($value, 10);
}

$_meses = array(
	1  => 'Enero',
	2  => 'Febrero',
	3  => 'Marzo',
	4  => 'Abril',
	5  => 'Mayo',
	6  => 'Junio',
	7  => 'Julio',
	8  => 'Agosto',
	9  => 'Septiembre',
	10 => 'Octubre',
	11 => 'Noviembre',
	12 => 'Diciembre'
);

$_dias = array(
	0 => 'Domingo',
	1 => 'Lunes',
	2 => 'Martes',
	3 => 'Miercoles',
	4 => 'Jueves',
	5 => 'Viernes',
	6 => 'Sábado'
);

$db = new DBclass($dsn, 'autocommit=yes');
$session = new sessionclass($dsn);

/*if ($_SESSION['iduser'] != 1) {
	die('<div style="font-size:16pt; border:solid 2px #000; padding:30px 10px;">ESTOY HACIENDO MODIFICACIONES AL PROGRAMA, NO ME LLAMEN PARA PREGUNTAR CUANDO QUEDARA, YO LES AVISO.</div>');
}*/

if (isset($_REQUEST['accion'])) {
	switch ($_REQUEST['accion']) {
		
		case 'reporte':
			$condiciones = array();
			
			if (!in_array($_SESSION['iduser'], array(1, 4, 62)) && !isset($_REQUEST['cias'])) {
				$condiciones[] = 'co.iduser = ' . $_SESSION['iduser'];
			}
			
			if ((isset($_REQUEST['fecha1']) && $_REQUEST['fecha1'] != '')
				|| (isset($_REQUEST['fecha2']) && $_REQUEST['fecha2'] != '')) {
				if ((isset($_REQUEST['fecha1']) && $_REQUEST['fecha1'] != '')
					&& (isset($_REQUEST['fecha2']) && $_REQUEST['fecha2'] != '')) {
					$condiciones[] = 'vp.fecha_entrega BETWEEN \'' . $_REQUEST['fecha1'] . '\' AND \'' . $_REQUEST['fecha2'] . '\'';
				} else if (isset($_REQUEST['fecha1']) && $_REQUEST['fecha1'] != '') {
					$condiciones[] = 'vp.fecha_entrega = \'' . $_REQUEST['fecha1'] . '\'';
				} else if (isset($_REQUEST['fecha2']) && $_REQUEST['fecha2'] != '') {
					$condiciones[] = 'vp.fecha_entrega >= \'' . $_REQUEST['fecha2'] . '\'';
				}
			}
			
			if (isset($_REQUEST['cias']) && trim($_REQUEST['cias']) != '') {
				$cias = array();
				
				$pieces = explode(',', $_REQUEST['cias']);
				foreach ($pieces as $piece) {
					if (count($exp = explode('-', $piece)) > 1) {
						$cias[] =  implode(', ', range($exp[0], $exp[1]));
					}
					else {
						$cias[] = $piece;
					}
				}
				
				if (count($cias) > 0) {
					$condiciones[] = 'vp.num_cia IN (' . implode(', ', $cias) . ')';
				}
			}
			
			$sql = '
				SELECT
					vp.num_cia,
					cc.nombre_corto
						AS nombre_cia,
					CONCAT_WS(\'-\', (
						CASE
							WHEN UPPER(vp.letra_folio) <> \'X\' THEN
								vp.letra_folio
							ELSE
								NULL
						END
					), vp.num_remi)
						AS remision,
					vp.fecha,
					vp.fecha_entrega,
					vp.kilos,
					vp.cuenta,
					vp.total_factura
						AS total,
					vp.estado
						AS status
				FROM
					venta_pastel vp
					LEFT JOIN catalogo_companias cc
						USING (num_cia)
					LEFT JOIN catalogo_operadoras co
						USING (idoperadora)
				WHERE
					' . implode(' AND ', $condiciones) . '
				ORDER BY
					num_cia,
					fecha_entrega,
					remision
			' ;
			
			$result = $db->query($sql);
			
			$tpl = new TemplatePower('plantillas/pan/PastelesConsultaEntregasReporte.tpl');
			$tpl->prepare();
			
			if ($result) {
				$tpl->newBlock('reporte');
				
				$num_cia = NULL;
				foreach ($result as $num => $rec) {
					if ($num_cia != $rec['num_cia']) {
						$num_cia = $rec['num_cia'];
						
						$tpl->newBlock('cia');
						$tpl->assign('num_cia', $rec['num_cia']);
						$tpl->assign('nombre_cia', utf8_encode($rec['nombre_cia']));
						
						$fecha = NULL;
						
						$row_color = FALSE;
					}
					
					if ($fecha != $rec['fecha_entrega']) {
						$fecha = $rec['fecha_entrega'];
						
						list($dia, $mes, $anio) = array_map('toInt', explode('/', $fecha));
						
						$tpl->newBlock('dia');
						
						$tpl->assign('dia_semana', $_dias[date('w', mktime(0, 0, 0, $mes, $dia, $anio))]);
						$tpl->assign('dia', $dia);
						$tpl->assign('mes', $_meses[$mes]);
						$tpl->assign('anio', $anio);
						
						$kilos = 0;
						$cuenta = 0;
						$resto = 0;
						$total = 0;
					}
					
					$tpl->newBlock('row');
					
					$tpl->assign('cancelada', $rec['status'] == 2 ? ' class="cancelada"' : '');
					
					$tpl->assign('remision', $rec['remision']);
					$tpl->assign('fecha', $rec['fecha']);
					$tpl->assign('kilos', number_format($rec['kilos'], 2));
					$tpl->assign('total', number_format($rec['total'], 2));
					$tpl->assign('cuenta', $rec['status'] == 0 && $rec['cuenta'] > 0 ? number_format($rec['cuenta'], 2) : '&nbsp;');
					$tpl->assign('resto', $rec['status'] == 0 ? number_format($rec['total'] - $rec['cuenta'], 2) : '&nbsp;');
					
					$kilos += $rec['kilos'];
					$cuenta += $rec['status'] == 0 ? $rec['cuenta'] : 0;
					$resto += $rec['status'] == 0 ? $rec['total'] - $rec['cuenta'] : 0;
					$total += $rec['total'];
					
					$tpl->assign('dia.kilos', number_format($kilos, 2));
					$tpl->assign('dia.total', number_format($total, 2));
					$tpl->assign('dia.cuenta', $cuenta > 0 ? number_format($cuenta, 2) : '&nbsp;');
					$tpl->assign('dia.resto', $resto > 0 ? number_format($resto, 2) : '&nbsp;');
				}
			}
			
			$tpl->printToScreen();
		break;
		
	}
	
	die;
}

$tpl = new TemplatePower('plantillas/pan/PastelesConsultaEntregas.tpl');
$tpl->prepare();

$tpl->assign('menucnt', $_SESSION['menu'] . '_cnt.js');

$tpl->assign('fecha1', date('01/m/Y'));
$tpl->assign('fecha2', date('d/m/Y'));

$tpl->printToScreen();
?>
