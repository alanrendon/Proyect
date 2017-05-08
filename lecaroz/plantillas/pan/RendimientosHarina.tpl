<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rendimientos de Harina</title>

<link href="/lecaroz/smarty/styles/layout.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/smarty/styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/font-style.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/FormValidator.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/FormStyles.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/calendar.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jscripts/mootools/mootools-1.2-core.js"></script>
<script type="text/javascript" src="jscripts/mootools/mootools-1.2-more.js"></script>
<script type="text/javascript" src="jscripts/mootools/String.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/Number.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/FormValidator.js"></script>
<script type="text/javascript" src="jscripts/mootools/FormStyles.js"></script>
<script type="text/javascript" src="jscripts/mootools/Calendar.js"></script>
<script type="text/javascript" src="jscripts/pan/RendimientosHarina.js"></script>
<script language="JavaScript" type="text/javascript" src="menus/stm31.js"></script>

</head>

<body>
<div id="contenedor">
  <div id="titulo">Rendimientos de Harina</div>
  <!-- START BLOCK : normal -->
  <div id="captura" align="center">
    <form name="Datos" class="FormValidator FormStyles" id="Datos">
      <table class="tabla_captura">
        <tr class="linea_off">
          <th align="left" scope="row">Compa&ntilde;&iacute;a(s)</th>
          <td><input name="cias" type="text" class="valid toInterval" id="cias" size="30" /></td>
        </tr>
        <tr class="linea_on">
          <th align="left" scope="row">Administrador</th>
          <td><select name="admin" id="admin">
            <option value=""></option>
			<!-- START BLOCK : admin -->
            <option value="{id}">{nombre}</option>
			<!-- END BLOCK : admin -->
          </select>
          </td>
        </tr>
		<tr class="linea_off">
        	<th align="left" scope="row">Operadora</th>
        	<td><select name="operadora" id="operadora">
        		<option value=""></option>
        		<!-- START BLOCK : operadora -->
				<option value="{id}">{nombre}</option>
				<!-- END BLOCK : operadora -->
        		</select></td>
        	</tr>
        <tr class="linea_on">
          <th align="left" scope="row">Fecha de corte </th>
          <td><input name="fecha" type="text" class="valid Focus toDate center" id="fecha" value="{fecha}" size="10" maxlength="10" />
          </td>
        </tr>
        <tr class="linea_off">
        	<th align="left" scope="row">Turnos</th>
        	<td><input name="turno[]" type="checkbox" id="turno" value="1" checked="checked" />
        		Francesero de día<br />
        		<input name="turno[]" type="checkbox" id="turno" value="2" checked="checked" />
        		Francesero de noche<br />
        		<input name="turno[]" type="checkbox" id="turno" value="3" checked="checked" />
        		Bizcochero<br />
        		<input name="turno[]" type="checkbox" id="turno" value="4" checked="checked" />
        		Repostero</td>
        	</tr>
        <tr class="linea_on">
        	<th align="left" scope="row">Tipo</th>
        	<td><input name="tipo" type="radio" id="tipo" value="desglose" checked="checked" />
        		Desglosado<br />
        		<input type="radio" name="tipo" id="tipo" value="efectivos" />
        		Con efectivos<br />
        		<input name="tipo" type="radio" id="tipo" value="totales" />
        		Solo totales <span class="font8">(ordenar por
<input name="orden" type="radio" value="num_cia" checked="checked" />
        			compañía 
        			<input type="radio" name="orden" value="rendimiento DESC" />
        			rendimiento
)</span></td>
        	</tr>
      </table>
      <br />
      <p>
        <input name="generar" type="button" class="boton" id="generar" value="Generar Reporte" />
      &nbsp;&nbsp;
      <input type="button" name="exportar" id="exportar" value="Exportar Reporte a Excel" />
      </p>
    </form>
  </div>
  <!-- END BLOCK : normal -->
  <!-- START BLOCK : ipad -->
  <div id="captura" align="center">
    <form name="Datos" class="FormValidator FormStyles" id="Datos">
      <table class="tabla_captura">
        <tr class="linea_off">
          <th align="left" scope="row">Compa&ntilde;&iacute;a</th>
          <td><select name="cias" id="cias">
            <!-- START BLOCK : cia -->
			<option value="{num_cia}">{num_cia} {nombre_cia}</option>
			<!-- END BLOCK : cia -->
          </select></td>
        </tr>
        <tr class="linea_on">
          <th align="left" scope="row">Fecha de corte </th>
          <td><input name="fecha" type="text" class="valid Focus toDate center" id="fecha" value="{fecha}" size="10" maxlength="10" /></td>
        </tr>
		  <tr class="linea_off">
        	<th align="left" scope="row">Turnos</th>
        	<td><input name="turno[]" type="checkbox" id="turno" value="1" checked="checked" />
        		Francesero de día<br />
        		<input name="turno[]" type="checkbox" id="turno" value="2" checked="checked" />
        		Francesero de noche<br />
        		<input name="turno[]" type="checkbox" id="turno" value="3" checked="checked" />
        		Bizcochero<br />
        		<input name="turno[]" type="checkbox" id="turno" value="4" checked="checked" />
        		Repostero</td>
        	</tr>
        <tr class="linea_on">
        	<th align="left" scope="row">Tipo</th>
        	<td><input name="tipo" type="radio" id="tipo" value="desglose" checked="checked" />
        		Desglosado<br />
        		<input type="radio" name="tipo" id="tipo" value="efectivos" />
        		Con efectivos<br />
        		<input name="tipo" type="radio" id="tipo" value="totales" />
        		Solo totales <span class="font8">(ordenar por
<input name="orden" type="radio" value="num_cia" checked="checked" />
        			compañía 
        			<input type="radio" name="orden" value="rendimiento DESC" />
        			rendimiento
)</span></td>
        	</tr>
      </table>
      <br />
      <p>
        <input name="generar" type="button" class="boton" id="generar" value="Generar Reporte" />
      </p>
    </form>
  </div>
  <!-- END BLOCK : ipad -->
</div>
<script language="javascript" type="text/javascript" src="menus/{menucnt}"></script>
</body>
</html>