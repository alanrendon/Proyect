<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Carta de Incapacidades</title>

<link href="../../smarty/styles/layout.css" rel="stylesheet" type="text/css" />
<link href="../../smarty/styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../styles/font-style.css" rel="stylesheet" type="text/css" />
<link href="../../styles/FormValidator.css" rel="stylesheet" type="text/css" />
<link href="../../styles/FormStyles.css" rel="stylesheet" type="text/css" />
<link href="../../styles/calendar.css" rel="stylesheet" type="text/css" />
<link href="smarty/styles/layout.css" rel="stylesheet" type="text/css" />
<link href="smarty/styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="styles/font-style.css" rel="stylesheet" type="text/css" />
<link href="styles/FormValidator.css" rel="stylesheet" type="text/css" />
<link href="styles/FormStyles.css" rel="stylesheet" type="text/css" />
<link href="styles/calendar.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jscripts/mootools/mootools-1.2-core.js"></script>
<script type="text/javascript" src="jscripts/mootools/mootools-1.2-more.js"></script>
<script type="text/javascript" src="jscripts/mootools/String.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/Number.implement.js"></script>
<script type="text/javascript" src="jscripts/mootools/FormValidator.js"></script>
<script type="text/javascript" src="jscripts/mootools/FormStyles.js"></script>
<script type="text/javascript" src="jscripts/mootools/Calendar.js"></script>
<script type="text/javascript" src="jscripts/fac/CartaIncapacidades.js"></script>
<script language="JavaScript" type="text/javascript" src="menus/stm31.js"></script>

</head>

<body>
<div id="contenedor">
  <div id="titulo">Carta de Incapacidades </div>
  <div id="captura" align="center">
    <form name="Datos" class="FormValidator FormStyles" id="Datos">
      <table class="tabla_captura">
        <tr>
          <th align="left" scope="row">Compa&ntilde;&iacute;a</th>
          <td><input name="num_cia" type="text" class="valid Focus toPosInt center" id="num_cia" size="3" />
          <input name="nombre_cia" type="text" disabled="disabled" id="nombre_cia" size="45" /></td>
        </tr>
        <tr>
          <th align="left" scope="row">Empleados</th>
          <td><select name="empleado" id="empleado" style="width:98%;">
            <option value=""></option>
          </select>          </td>
        </tr>
        <tr>
          <th align="left" scope="row">Sueldo</th>
          <td><input name="sueldo" type="text" class="valid Focus numberPosFormat right" precision="2" id="sueldo" size="10" /></td>
        </tr>
        <tr>
          <th align="left" scope="row">Neto a pagar </th>
          <td><input name="neto" type="text" class="valid Focus numberPosFormat right" precision="2" id="neto" size="10" /></td>
        </tr>
        <tr>
          <th align="left" scope="row">Concepto</th>
          <td><textarea name="concepto" cols="" rows="4" class="valid onlyText cleanText toUpper" id="concepto" style="width:98%;">MATERNIDAD ANTERIORES Y POSTERIORES AL PARTO</textarea></td>
        </tr>
      </table>
      <br />
      <p>
        <input name="generar" type="button" class="boton" id="generar" value="Generar Carta" />
      </p>
    </form>
  </div>
</div>
<script language="javascript" type="text/javascript" src="menus/{menucnt}"></script>
</body>
</html>