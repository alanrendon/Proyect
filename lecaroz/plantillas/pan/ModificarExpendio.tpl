<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificaci&oacute;n de Expendios</title>

<link href="../../smarty/styles/layout.css" rel="stylesheet" type="text/css" />
<link href="../../smarty/styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../smarty/styles/formularios.css" rel="stylesheet" type="text/css" />
<link href="smarty/styles/layout.css" rel="stylesheet" type="text/css" />
<link href="smarty/styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="smarty/styles/formularios.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jscripts/mootools/mootools-1.2-core.js"></script>
<script type="text/javascript" src="jscripts/mootools/mootools-1.2-more.js"></script>
<script type="text/javascript" src="jscripts/mootools/extensiones.js"></script>
<script type="text/javascript" src="jscripts/mootools/formularios.js"></script>
<script type="text/javascript" src="jscripts/pan/ModificarExpendio.js"></script>
<script language="JavaScript" type="text/javascript" src="menus/stm31.js"></script>

</head>

<body>
<div id="contenedor">
  <div id="titulo">Modificaci&oacute;n de Expendios </div>
  <div id="captura" align="center">
    <form name="Datos" class="formulario" id="Datos">
      <table class="tabla_captura">
      <tr>
        <th align="left">Compa&ntilde;&iacute;a</th>
        <td class="linea_off"><input name="num_cia" type="text" class="cap toPosInt alignCenter" id="num_cia" size="3" />
          <input name="nombre_cia" type="text" class="disabled" id="nombre_cia" size="30" /></td>
      </tr>
      <tr>
        <th align="left">No. expendio</th>
        <td class="linea_on"><input name="num_expendio" type="text" class="cap toPosInt alignCenter" id="num_expendio" size="3" /></td>
      </tr>
    </table>
      <p>
        <input name="buscar" type="button" class="boton" id="buscar" value="Buscar" />
      </p>
    </form>
	<div id="result">
	</div>
  </div>
</div>
<script language="javascript" type="text/javascript" src="menus/{menucnt}"></script>
</body>
</html>
