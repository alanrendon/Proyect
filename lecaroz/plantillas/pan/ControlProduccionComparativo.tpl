<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comparativo de rayas y precios de producción</title>
<link href="/lecaroz/smarty/styles/layout.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/smarty/styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/font-style.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/FormValidator.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/FormStyles.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/Popups.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jscripts/mootools/mootools-1.2-core.js"></script>
<script type="text/javascript" src="jscripts/mootools/mootools-1.2-more.js"></script>
<script type="text/javascript" src="jscripts/mootools/String.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/Number.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/Array.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/FormValidator.js"></script>
<script type="text/javascript" src="jscripts/mootools/FormStyles.js"></script>
<script type="text/javascript" src="jscripts/mootools/Popups.js"></script>
<script type="text/javascript" src="menus/stm31.js"></script>
<script type="text/javascript" src="jscripts/pan/ControlProduccionComparativo.js"></script>
</head>

<body>
<div id="contenedor">
	<div id="titulo">Comparativo de rayas y precios de producci&oacute;n</div>
	<div id="captura" align="center">
		<form name="Datos" class="FormValidator FormStyles" id="Datos">
			<table class="tabla_captura">
				<tr class="linea_off">
					<th align="left" scope="row">Compañ&iacute;a(s)</th>
					<td><input name="cias" type="text" class="valid toInterval" id="cias" size="40" /></td>
				</tr>
				<tr class="linea_on">
					<th align="left" scope="row">Administrador</th>
					<td><select name="admin" id="admin">
						<option value="" selected="selected"></option>
						<!-- START BLOCK : admin -->
						<option value="{value}">{text}</option>
						<!-- END BLOCK : admin -->
					</select></td>
				</tr>
				<tr class="linea_off">
					<th align="left" scope="row">Turno(s)</th>
					<td><input name="turno[]" type="checkbox" id="turno" value="1" checked="checked" />
						Frances de día<br />
						<input name="turno[]" type="checkbox" id="turno" value="2" checked="checked" />
						Frances de noche<br />
						<input name="turno[]" type="checkbox" id="turno" value="3" checked="checked" />
						Bizcochero<br />
						<input name="turno[]" type="checkbox" id="turno" value="4" checked="checked" />
						Repostero<br />
						<input name="turno[]" type="checkbox" id="turno" value="8" checked="checked" />
						Piconero<br />
						<input name="turno[]" type="checkbox" id="turno" value="9" checked="checked" />
						Gelatinero<br />
						<input name="turno[]" type="checkbox" id="turno" value="10" checked="checked" />
						Despacho</td>
				</tr>
			</table>
			<p>
				<input type="button" name="reporte" id="reporte" value="Reporte" />
			</p>
		</form>
	</div>
</div>
<script language="javascript" type="text/javascript" src="menus/{menucnt}"></script>
</body>
</html>
