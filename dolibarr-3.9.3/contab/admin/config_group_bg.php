<?php
/* Copyright (C) 2007-2010 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) ---Put here your own copyright and developer email---
 * 					JPFarber - jfarber55@hotmail.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * code pour créer le module 106, 117, 97, 110, b, 112, 97, 98, 108, 11, b, 102, 97, 114, 98, 101, 114
 */

/**
 *   	\file       dev/skeletons/skeleton_page.php
 * 		\ingroup    mymodule othermodule1 othermodule2
 * 		\brief      This file is an example of a php page
 * 					Put here some comments
 */
//if (! defined('NOREQUIREUSER'))  define('NOREQUIREUSER','1');
//if (! defined('NOREQUIREDB'))    define('NOREQUIREDB','1');
//if (! defined('NOREQUIRESOC'))   define('NOREQUIRESOC','1');
//if (! defined('NOREQUIRETRAN'))  define('NOREQUIRETRAN','1');
//if (! defined('NOCSRFCHECK'))    define('NOCSRFCHECK','1');			// Do not check anti CSRF attack test
//if (! defined('NOSTYLECHECK'))   define('NOSTYLECHECK','1');			// Do not check style html tag into posted data
//if (! defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL','1');		// Do not check anti POST attack test
//if (! defined('NOREQUIREMENU'))  define('NOREQUIREMENU','1');			// If there is no need to load and show top and left menu
//if (! defined('NOREQUIREHTML'))  define('NOREQUIREHTML','1');			// If we don't need to load the html.form.class.php
//if (! defined('NOREQUIREAJAX'))  define('NOREQUIREAJAX','1');
//if (! defined("NOLOGIN"))        define("NOLOGIN",'1');				// If this page is public (can be called outside logged session)
// Change this following line to use the correct relative path (../, ../../, etc)
/* $res = 0;
if (!$res && file_exists("../main.inc.php"))
    $res = @include '../main.inc.php';     // to work if your module directory is into dolibarr root htdocs directory
if (!$res && file_exists("../../main.inc.php"))
    $res = @include '../../main.inc.php';   // to work if your module directory is into a subdir of root htdocs directory
if (!$res && file_exists("../../../main.inc.php"))
    $res = @include '../../../main.inc.php';     // Used on dev env only
if (!$res && file_exists("../../../../main.inc.php"))
    $res = @include '../../../../main.inc.php';   // Used on dev env only
if (!$res)
    die("Include of main fails");
// Change this following line to use the correct relative path from htdocs
dol_include_once('/module/class/skeleton_class.class.php'); */

// Load traductions files requiredby by page
$langs->load("companies");
$langs->load("other");
$langs->load("contab@contab");

// Get parameters
$id = GETPOST('id', 'int');
$action = "view";
if (GETPOST('action')) {
	$action = GETPOST('action', 'alpha');
}
$myparam = GETPOST('myparam', 'alpha');

dol_syslog("Dol url root=".DOL_URL_ROOT);

if (isset($_REQUEST["new_group"])) { $action = "new_group"; }
//if (isset($_REQUEST["save_group"])) { $action = "save_group"; }

//if (isset($_REQUEST["btncancel"])) { $action = ""; }
//print "Action=".$action;

// Protection if external user
if ($user->societe_id > 0) {
    //accessforbidden();
}

/* * *****************************************************************
 * ACTIONS
 *
 * Put here all code to do according to value of "action" parameter
 * ****************************************************************** */
$valores = array();

if (file_exists(DOL_DOCUMENT_ROOT.'/contab/admin/Configuration.class.php')) {
	require_once DOL_DOCUMENT_ROOT.'/contab/admin/Configuration.class.php';
} else { 
	require_once DOL_DOCUMENT_ROOT.'/custom/contab/admin/Configuration.class.php';
}

if (file_exists(DOL_DOCUMENT_ROOT.'/contab/class/contabsatctas.class.php')) {
	require_once DOL_DOCUMENT_ROOT.'/contab/class/contabsatctas.class.php';
} else {
	require_once DOL_DOCUMENT_ROOT.'/custom/contab/class/contabsatctas.class.php';
}

if (file_exists(DOL_DOCUMENT_ROOT.'/contab/class/contabgrupos.class.php')) {
	require_once DOL_DOCUMENT_ROOT.'/contab/class/contabgrupos.class.php';
} else {
	require_once DOL_DOCUMENT_ROOT.'/custom/contab/class/contabgrupos.class.php';
}

if (file_exists(DOL_DOCUMENT_ROOT.'/contab/core/lib/contab.lib.php')){
	require_once DOL_DOCUMENT_ROOT.'/contab/core/lib/contab.lib.php';
} else {
	require_once DOL_DOCUMENT_ROOT.'/custom/contab/core/lib/contab.lib.php';
}

require_once '../functions/functions.php';

$config = new Configuration($db);

//print "Action=".$action;

/* llxHeader('', 'Configuracion', '');
$title="Configuracion";
$linkback='<a href="'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans("BackToModuleList").'</a>';
print_fiche_titre($title,$linkback,'setup');
$head=array();        // Tableau des onglets

$head = contab_admin_prepare_head($object, $user);
dol_fiche_head($head, '1', 'Configuracion', 0, ''); */

$form = new Form($db);

?>
<style>
    h1{
        text-align: center;
    }
    .critical{
        width: 80%;
        min-height: 30px;
        border: 3px solid red;
        background-color: #fe7c7c;
        display:block;
        position: relative;
        margin: 0 auto;
    }
    .helpLink{
        text-align: center;
        width: 100%;
        position: relative;
        display:block;
    }
</style>

<?php 

if ($action == "cgffo") {
	$op = $_POST["ddlcreategroupfromfirstone"];
	if ($op == "S") {
		$g = new Contabgrupos($db);
		$g->create_from_firstone();
	}
	$action = "view";
}
if($action == "save_group") {
	dol_syslog("Save Group");
	if (GETPOST('btnguardar')) {
		dol_syslog("btnguardar");
		$group = GETPOST('grupo');
		$codagr_rel = GETPOST('codagr_rel');
		$codagr_ini = GETPOST('codagr_ini');;
		$codagr_fin = GETPOST('codagr_fin');
		$t_e_f = GETPOST('tipo_edo_financiero', 'int');
		
		$g = new Contabgrupos($db);
		$g->grupo = $group;
		$g->fk_codagr_rel = $codagr_rel;
		$g->fk_codagr_ini = $codagr_ini;
		$g->fk_codagr_fin = $codagr_fin;
		$g->tipo_edo_financiero = $t_e_f;
		
		$g->create($user);
	}
	$action = "view";
} else if($action == "update_group") {
	dol_syslog("Update Group");
	if (GETPOST('btnguardar')) {
		dol_syslog("btnguardar");
		$g = new Contabgrupos($db);
		$g->id = GETPOST('rowid');
		$g->grupo = GETPOST('grupo');
		$g->fk_codagr_rel = GETPOST('codagr_rel');
		$g->fk_codagr_ini = GETPOST('codagr_ini');
		$g->fk_codagr_fin = GETPOST('codagr_fin');
		$g->tipo_edo_financiero = GETPOST('tipo_edo_financiero', 'int');
	
		dol_syslog("Se quiere actualizar los datos del registro con id = ".$g->id);
		
		$g->update($user);
	}
	$action = "view";
} else if ($action == "delete") {
	$g = new Contabgrupos($db);
	$g->id = GETPOST('rowid');
	$g->delete($user);
	
	$action = "view";
} 

dol_syslog("===>Action = ".$action);

$msg = "";
if (!$config->HayRegistros_CatCtas() > 0){
	//$msg = "Favor de realizar la importación de su catálogo de cuentas o la creación de su catálogo de cuentas en el Sistema.";
}

if ($action == "edit") {

?>
	<div class='titre'>
		Asignacion de Grupos (Balance General):
		<br />
		Si alguno de los siguientes condiciones se deja sin asignar, el pago se tomara automaticamente como un pago realizado en efectivo.
	</div>
	<br />
<?php 
	//Tipo de Estado Financiero => Balance General (1)
	$tipo_edo_financiero = 1;

	$id = GETPOST('rowid');
	
	$gpo = new Contabgrupos($db);
	$resp = $gpo->fetch($id, $tipo_edo_financiero);
	
	if ($resp > 0) {
	
?>
	<form method="POST" action="reportes.php?mod=1&action=update_group">
		<input type="hidden" name="rowid" value="<?php print $id;?>" >
		<input type="hidden" name="tipo_edo_financiero" value="<?php print $tipo_edo_financiero;?>" >
<?php 
		$str1 = "";
		$str2 = "";
		$str3 = "";
		
		$rowid = 0;
		$ctas = new Contabsatctas($db);
		while ($r = $ctas->fetch_next($rowid, 1)) {
			dol_syslog(" ====>r=$r, cta id = ".$ctas->id." fk_codagr_rel=".$gpo->fk_codagr_rel." ctas_id=".$ctas->id);
			$str1 .= '<option value="'.$ctas->id.'"';
			if ($ctas->id == $gpo->fk_codagr_rel) {
				$str1 .= ' selected="selected" ';
			}
			$str1 .= ' >'.$ctas->codagr." - ".$ctas->descripcion.'</option>';
			$rowid = $ctas->id;
		}
		
		$rowid = 0;
		while($r = $ctas->fetch_next($rowid, 2)){
			$str2 .= '<option value="'.$ctas->id.'"';
			if ($ctas->id == $gpo->fk_codagr_ini) {
				$str2 .= ' selected="selected" ';
			}
			$str2 .= ' >'.$ctas->codagr." - ".$ctas->descripcion.'</option>';
			$str3 .= '<option value="'.$ctas->id.'"';
			if ($ctas->id == $gpo->fk_codagr_fin) {
				$str3 .= ' selected="selected" ';
			}
			$str3 .= ' >'.$ctas->codagr." - ".$ctas->descripcion.'</option>';
			$rowid = $ctas->id; 
		}
		dol_syslog("cta = ".$ctas->id);
		dol_syslog("str1 = ".$str1);
		dol_syslog("str2 = ".$str2);
		dol_syslog("str3 = ".$str3);
?>
		<table>
			<tr>
				<td>
					Descripción del Grupo:
				</td>
				<td>
					<input name="grupo" type="text" name="grupo" value="<?=$gpo->grupo;?>" style="width: 200px;" />
				</td>
			</tr>
			<tr>
				<td>Cód. de Agr. Relacionado:</td>
				<td>
					<select id="codagr_rel" name="codagr_rel">
						<?php print $str1; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Cód. Agr. de Cta Inicial:</td>
				<td>
					<select id="codagr_ini" name="codagr_ini">
						<?php print $str2; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Cód. Agr. de Cta Final:</td>
				<td>
					<select id="codagr_fin" name="codagr_fin">
						<?php print $str3; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<input name="btnguardar" style="width: 145px;" type="submit" value="Guardar" >
				</td>
				<td style="text-align: center;">
					<input name="btncancelar" style="width: 145px;" type="submit" value="Cancelar" >
				</td>
			</tr>
		</table>
		<br>
	</form>
<?php 
	}
} else if ($action == "new_group") {
	//Tipo de Estado Financiero => Balance General (1)
	$tipo_edo_financiero = 1;
?>
	<form method="POST" action="reportes.php?mod=1&action=save_group">
		<input type="hidden" name="tipo_edo_financiero" value="<?php print $tipo_edo_financiero;?>" >
<?php 
		//Llenado del option para el select.  Lo llenamos una sola vez y lo utilizamos 3 veces.
		$ctas = new Contabsatctas($db);
		$id = 0;
		$str_mayor = "";
		while ($r = $ctas->fetch_next($id, 1)) {
			$str_mayor .= '<option value="'.$ctas->id.'">'.$ctas->codagr." - ".$ctas->descripcion.'</option>';
			$id = $ctas->id; 
		}
		
		$id = 0;
		$str_mov = "";
		while ($r = $ctas->fetch_next($id, 2)) {
			$str_mov .= '<option value="'.$ctas->id.'">'.$ctas->codagr." - ".$ctas->descripcion.'</option>';
			$id = $ctas->id;
		}
?>
		<table>
			<tr>
				<td>
					Descripcion del Grupo:
				</td>
				<td>
					<input name="grupo" type="text" name="grupo" style="width: 200px;" />
				</td>
			</tr>
			<tr>
				<td>Codigo de Agr. Rel.:</td>
				<td>
					<select id="codagr_rel" name="codagr_rel">
						<?php print $str_mayor; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Codigo Agr. de Cta Inicial:</td>
				<td>
					<select id="codagr_ini" name="codagr_ini">
						<?php print $str_mov; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Codigo de Agr. Rel.:</td>
				<td>
					<select id="codagr_fin" name="codagr_fin">
						<?php print $str_mov; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<input name="btnguardar" style="width: 145px;" type="submit" value="Guardar" >
				</td>
				<td style="text-align: center;">
					<input name="btncancelar" style="width: 145px;" type="submit" value="Cancelar" >
				</td>
			</tr>
		</table>
		<br>
	</form>
<?php 
}

if ($action == "view") {
	$str_gpos_bg = "Seccion en la cual debe de definir la estructura de las Cuentas dentro del Balance General.";
	$str_gpos_bg .= "<br>";
	$str_gpos_bg .= "Ej.: En mexico las cuentas de Activo estan agrupadas bajo la cuenta (Codigo de Agrupacion o Cod. Agr.) numero 100.";
	$str_gpos_bg .= "<br>";
	$str_gpos_bg .= "Así pues las primeras cuentas del Catálogo de Cuents son las siguientes ";
	$str_gpos_bg .= "<br>";
	$str_gpos_bg .= "<table>";
	$str_gpos_bg .= "<tr><td>Nivel</td><td>Cod. Agr.</td><td>Descripcion de la Cuenta</td><td>Anotaciones extras</td></tr>";
	$str_gpos_bg .= "<tr><td>0</td><td>100</td><td>Activo</td><td>Agrupacion de las Cuentas del Activo</td></tr>";
	$str_gpos_bg .= "<tr><td> 0</td><td>100.01</td><td>Activo a Corto Plazo</td><td>Agrupacion de las Cuentas de Activo a Corto Plazo</td></tr>";
	$str_gpos_bg .= "<tr><td>1</td><td>101</td><td>Caja</td><td>Primera cuenta de Mayor  o de Nivel 1 del Activo a CP</td></tr>";
	$str_gpos_bg .= "<tr><td>2</td><td>101.01</td><td>Caja y Efectivo</td><td>Primera cuenta de movimientos o de Nivel 2 del Activo a CP</td></tr>";
	$str_gpos_bg .= "<tr><td>...</td><td>...</td><td>...</td><td>Otras Cuentas de Mayor (Nivel 1) o de Movimientos (Nivel 2) del Activo a Corto Plazo</td></tr>";
	$str_gpos_bg .= "<tr><td>1</td><td>121</td><td>Otros Activos a Corto Plazo</td><td>Ultima cuenta del Mayor o Nivel 1 del Activo a Corto Plazo, que forma parte del Activo</td></tr>";
	$str_gpos_bg .= "<tr><td>2</td><td>121.01</td><td>Otros Activos a Corto Plazo</td><td>Ultima cuenta de Movimientos o Nivel 2 del Activo a Corto Plazo, que forma parte del Activo</td></tr>";
	$str_gpos_bg .= "<tr><td>0</td><td>100.02</td><td>Activo a Largo Plazo</td><td>Agrupacion de las cuentas de Activo a Largo Plazo</td></tr>";
	$str_gpos_bg .= "<tr><td>1</td><td>151</td><td>Terrenos</td><td>Primera cuenta de Mayor o de Nivel 1 del Activo a Largo Plazo</td></tr>";
	$str_gpos_bg .= "<tr><td>2</td><td>151.01</td><td>Terrenos</td><td>Primera cuenta de movimientos o de Nivel 2 del Activo a LP</td></tr>";
	$str_gpos_bg .= "<tr><td>...</td><td>...</td><td>...</td><td>Otras Cuentas de Mayor (Nivel 1) o de Movimientos (Nivel 2) del Activo a Largo Plazo</td></tr>";
	$str_gpos_bg .= "<tr><td>1</td><td>191</td><td>Otros Activos a Largo Plazo</td><td>Ultima cuenta del Mayor o Nivel 1 del Activo a Largo Plazo, que forma parte del Activo</td></tr>";
	$str_gpos_bg .= "<tr><td>2</td><td>191.01</td><td>Otros Activos a Largo Plazo</td><td>Ultima cuenta de Movimientos o Nivel 2 del Activo a Largo Plazo, que forma parte del Activo</td></tr>";
	$str_gpos_bg .= "</table>";
	$str_gpos_bg .= "<br>";
	$str_gpos_bg .= "Nota: La informacion mostrada aqui, es en base a los lineamientos generados en Mexico por la Secretaria de Hacienda y Credito Publico.";
	$str_gpos_bg .= "<br>";
	$str_gpos_bg .= "      Para cualquier otro pais, favor de hacer los cambios o adecuaciones pertinentes.";
	
	//Tipo de Estado Financiero => Balance General (1)
	$tipo_edo_financiero = 1;
?>
	<div class='titre'>
		<table style="width: 100%;"> 
			<tr>
				<td style="width: 25%">Asignacion de Grupos (BALANCE GENERAL): </td>
				<td style="width: 5%"><?php print $form->textwithpicto('',$str_gpos_bg,1,0);?></td>
<?php 
				if ($conf->entity > 1) {
					$gg = new Contabgrupos($db);
					if (! $gg->fetch_next(0, $tipo_edo_financiero, 1)) {
?>
						<td style="width: 50%; text-align: right;">Desea que se generen automaticamente los grupos?</td>
						<td style="width: 20%;">
							<form method="post" action="reportes.php?mod=1">
								<input type="hidden" name="action" value="cgffo" >
								<select name="ddlcreategroupfromfirstone">
									<option value="N">No</option>
									<option value="S">Si</option>
								</select>
								<input type="submit" name="btnSaveGroupFromFO" value=" Crear Grupos " >
							</form>
						</td>						 
<?php 
					} else {
?>
						<td style="width: 70%; text-align: right;">.</td>
<?php 
					}
				} else {
?>
					<td style="width: 70%; text-align: right;">.</td>
<?php 
				}
?>
			</tr>
		</table>		
	</div>
	<br />
	
	<form action="reportes.php?mod=1&action=new_group" method="post">
		<input type="hidden" name="tipo_edo_financiero" value="<?php print $tipo_edo_financiero;?>" >
		<table class="noborder" style="width: 100%">
			<tbody>
				<tr class="liste_titre">
					<td>Nombre del Grupo:</td>
					<td>Cod. Agr. Relacionado <br>en el Cat. Ppal.:</td>
					<td>Cod. Agr. Inicial <br>del Cat. Ppal.</td>
					<td>Cod. Agr. Final <br>del Cat. Ppal.</td>
					<td>&nbsp;</td>
				</tr>
<?php 
				$gpo = new Contabgrupos($db);
				$id = 0;
				while ($r = $gpo->fetch_next($id, $tipo_edo_financiero, 1)) {
?>
					<tr>
						<td><?=$gpo->grupo;?></td>
						<td><?=$gpo->codagr_rel." - ".$gpo->desc_rel;?></td>
						<td><?=$gpo->codagr_ini." - ".$gpo->desc_ini;?></td>
						<td><?=$gpo->codagr_fin." - ".$gpo->desc_fin;?></td>
						<td>
							<a href="<?php print $_SERVER["PHP_SELF"]; ?>?rowid=<?php print $gpo->id; ?>&amp;action=edit"><?php print img_edit(); ?></a>&nbsp;&nbsp;
							<a href="<?php print $_SERVER["PHP_SELF"]; ?>?rowid=<?php print $gpo->id; ?>&amp;action=delete"><?php print img_delete(); ?></a>
						</td>
					</tr>
<?php
					$id = $gpo->id;
				} 
?>
				<tr>
	       			<td colspan="3"></td>
	       		</tr>  
	        	
	         	<tr>
	         		<td colspan="3"></td>
	         		<td><input type="submit" value="Nuevo Grupo" style="width: 135px"> </td>
	       		</tr>
	       		
	       		<tr><td colspan="2"></td></tr>
			</tbody>
		</table>
	</form>
<?php 
}
llxFooter();
$db->close();
?>
