<?php

include('includes/class.db.inc.php');
include('includes/class.session2.inc.php');
include('includes/class.TemplatePower.inc.php');
include('includes/dbstatus.php');

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

$db = new DBclass($dsn, 'autocommit=yes');
$session = new sessionclass($dsn);

if (isset($_REQUEST['accion'])) {
	switch ($_REQUEST['accion']) {
		
		case 'inicio':
			
			$tpl = new TemplatePower('plantillas/ban/PrestamosPlazosCatalogoInicio.tpl');
			$tpl->prepare();
			
			echo $tpl->getOutputContent();
			
			break;
		
		case 'consultar':
			
			$tpl = new TemplatePower('plantillas/ban/PrestamosPlazosCatalogoConsulta.tpl');
			$tpl->prepare();
			
			echo $tpl->getOutputContent();
			
			break;
		
		case 'alta':
			$tpl = new TemplatePower('plantillas/ban/PrestamosPlazosCatalogoAlta.tpl');
			$tpl->prepare();
			
			echo $tpl->getOutputContent();
			
			break;
		
		case 'do_alta':
			$sql = '
				INSERT INTO
					catalogo_administradores (
						idadministrador,
						nombre_administrador,
						email,
						iduser
					)
					VALUES (
						COALESCE((
							SELECT
								MAX(idadministrador) + 1
							FROM
								catalogo_administradores
						), 1),
						\'' . utf8_decode($_REQUEST['nombre']) . '\',
						\'' . utf8_decode($_REQUEST['email']) . '\',
						' . (isset($_REQUEST['iduser']) && $_REQUEST['iduser'] > 0 ? $_REQUEST['iduser'] : 'NULL') . '
					)
			' . ";\n";
			
			$db->query($sql);
			
			break;
		
		case 'modificar':
			$sql = '
				SELECT
					idadministrador
						AS id,
					nombre_administrador
						AS nombre,
					email,
					iduser
				FROM
					catalogo_administradores cc
				WHERE
					idadministrador = ' . $_REQUEST['id'] . '
			';
			
			$result = $db->query($sql);
			
			$tpl = new TemplatePower('plantillas/ban/CatalogoAdministradoresModificar.tpl');
			$tpl->prepare();
			
			$tpl->assign('id', $_REQUEST['id']);
			$tpl->assign('nombre', utf8_encode($result[0]['nombre']));
			$tpl->assign('email', utf8_encode($result[0]['email']));
			
			$sql = '
				SELECT
					iduser
						AS value,
					CONCAT_WS(\' \', nombre, apellido)
						AS text,
					COALESCE((
						SELECT
							TRUE
						FROM
							catalogo_administradores
						WHERE
							iduser = a.iduser
							' . ($result[0]['iduser'] > 0 ? 'AND iduser != ' . $result[0]['iduser'] : '') . '
					), FALSE)
						AS disabled
				FROM
					auth a
				ORDER BY
					text
			';
			
			$users = $db->query($sql);
			
			if ($users) {
				foreach ($users as $r) {
					$tpl->newBlock('iduser');
					$tpl->assign('value', $r['value']);
					$tpl->assign('text', utf8_encode($r['text']));
					$tpl->assign('disabled', $r['disabled'] == 't' ? ' disabled="disabled" class="red underline"' : '');
					
					if ($r['value'] == $result[0]['iduser']) {
						$tpl->assign('selected', ' selected="selected" class="green underline"');
					}
				}
			}
			
			echo $tpl->getOutputContent();
			
			break;
		
		case 'do_modificar':
			$sql = '
				UPDATE
					catalogo_administradores
				SET
					nombre_administrador = \'' . utf8_decode($_REQUEST['nombre']) . '\',
					email = \'' . utf8_decode($_REQUEST['email']) . '\',
					iduser = ' . (isset($_REQUEST['iduser']) && $_REQUEST['iduser'] > 0 ? $_REQUEST['iduser'] : 'NULL') . '
				WHERE
					idadministrador = ' . $_REQUEST['id'] . '
			';
			
			$db->query($sql);
			
			break;
		
		case 'do_baja':
			$sql = '
				DELETE FROM
					catalogo_administradores
				WHERE
					idadministrador = ' . $_REQUEST['id'] . '
			' . ";\n";
			
			$sql .= '
				UPDATE
					catalogo_companias
				SET
					idadministrador = NULL
				WHERE
					idadministrador = ' . $_REQUEST['id'] . '
			' . ";\n";
			
			$db->query($sql);
			
			break;
		
	}
	
	die;
}

$tpl = new TemplatePower('plantillas/ban/PrestamosPlazosCatalogo.tpl');
$tpl->prepare();

$tpl->assign('menucnt', $_SESSION['menu'] . '_cnt.js');

$tpl->printToScreen();
