<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../styles/impresion.css" rel="stylesheet" type="text/css">
<link href="../../styles/tablas.css" rel="stylesheet" type="text/css">
<link href="../../styles/pages.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- START BLOCK : datos -->
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="middle"><p class="title">Listados de Expendios </p>
  <form action="./pan_exp_con.php" method="get" name="form">
  <input name="temp" type="hidden">
  <table class="tabla">
    <tr>
      <th class="vtabla" scope="row">Compa&ntilde;&iacute;a</th>
      <td class="vtabla"><input name="num_cia" type="text" class="insert" id="num_cia" onFocus="form.temp.value=this.value" onChange="isInt(this,form.temp)" onKeyDown="if (event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) fecha.select();" size="3" maxlength="3"></td>
      <th class="vtabla">Fecha</th>
      <td class="vtabla"><input name="fecha" type="text" class="insert" id="fecha" onChange="actualiza_fecha(this)" onKeyDown="if (event.keyCode == 13 || event.keyCode == 37 || event.keyCode == 39) num_cia.select();" value="{fecha}" size="10" maxlength="10"></td>
    </tr>
    <tr>
      <th colspan="4" class="vtabla" scope="row"><input name="tipo" type="radio" value="saldos" checked>
        Saldos<br>
        <input name="tipo" type="radio" value="movimientos">
        Movimientos</th>
      </tr>
  </table>  <p>
    <input type="button" class="boton" value="Siguiente" onClick="valida_registro(form)">
  </p></form></td>
</tr>
</table>
<script language="javascript" type="text/javascript">
	function valida_registro(form) {
		if (form.num_cia.value <= 0) {
			alert("Debe especificar el n�mero de compa��a");
			form.num_cia.select();
			return false;
		}
		else if (form.fecha.value == "") {
			alert("Debe especificar la fecha");
			form.fecha.select();
			return false;
		}
		else
			form.submit()
	}
	
	window.onload = document.num_cia.select();
</script>
<!-- END BLOCK : datos -->
<!-- START BLOCK : saldos -->
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="top">
<table width="100%">
  <tr>
    <td class="print_encabezado">Cia.: {num_cia} </td>
    <td class="print_encabezado" align="center">{nombre_cia}</td>
    <td class="print_encabezado" align="right">Cia.: {num_cia} </td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="60%" class="print_encabezado" align="center">Saldos de los Expendios <br>
      al d&iacute;a {dia} de {mes} de {anio} </td>
    <td width="20%">&nbsp;</td>
  </tr>
</table>
  <br>
  <table class="print">
    <tr>
      <th colspan="2" class="print" scope="row">N&uacute;mero y nombre del expendio </th>
      <th class="print">Saldo anterior </th>
      <th class="print">Precio Venta </th>
      <th class="print">Precio Expendio </th>
      <th class="print">Diferencia</th>
      <th class="print">%</th>
      <th class="print">Abono</th>
      <th class="print">Devoluci&oacute;n</th>
      <th class="print">Saldo Actual</th>
    </tr>
    <!-- START BLOCK : fila -->
	<tr>
      <td class="print" scope="row">{num_exp}</td>
      <td class="vprint">{nombre_exp}</td>
      <td class="rprint">{saldo_anterior}</td>
      <td class="rprint">{precio_venta}</td>
      <td class="rprint">{precio_exp}</td>
      <td class="rprint">{diferencia}</td>
      <td class="rprint">{porc}</td>
      <td class="rprint">{abono}</td>
      <td class="rprint">{devolucion}</td>
      <td class="rprint">{saldo_actual}</td>
    </tr>
	<!-- END BLOCK : fila -->
    <tr>
      <th colspan="2" class="print" scope="row">Totales del d&iacute;a </th>
      <th class="rprint_total">{saldo_anterior}</th>
      <th class="rprint_total">{precio_venta}</th>
      <th class="rprint_total">{precio_exp}</th>
      <th class="rprint_total">{diferencia}</th>
      <th class="rprint_total">{porc}</th>
      <th class="rprint_total">{abono}</th>
      <th class="rprint_total">{devolucion}</th>
      <th class="rprint_total">{saldo_actual}</th>
    </tr>
  </table>
</td>
</tr>
</table>
<!-- END BLOCK : saldos -->
<!-- START BLOCK : movimientos -->
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="top">
<table width="100%">
  <tr>
    <td class="print_encabezado">Cia.: {num_cia} </td>
    <td class="print_encabezado" align="center">{nombre_cia}</td>
    <td class="print_encabezado" align="right">Cia.: {num_cia}</td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="60%" class="print_encabezado" align="center">Movimientos de Expendios <br>
      al {dia} de {mes} de {anio} </td>
    <td width="20%">&nbsp;</td>
  </tr>
</table>
  <br>
  <table class="print">
    <tr>
      <th class="print" scope="col">Dia</th>
      <th class="print" scope="col">Precio Venta </th>
      <th class="print" scope="col">Precio Expendio </th>
      <th class="print" scope="col">Diferencia</th>
      <th class="print" scope="col">%</th>
      <th class="print" scope="col">Abono</th>
    </tr>
    <!-- START BLOCK : dia -->
	<tr onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
      <td class="print">{dia}</td>
      <td class="rprint">{precio_venta}</td>
      <td class="rprint">{precio_expendio}</td>
      <td class="rprint">{diferencia}</td>
      <td class="rprint">{porc}</td>
      <td class="rprint">{abono}</td>
    </tr>
	<!-- END BLOCK : dia -->
    <tr>
      <th class="print">Totales</th>
      <th class="rprint_total">{precio_venta}</th>
      <th class="rprint_total">{precio_expendio}</th>
      <th class="rprint_total">{diferencia}</th>
      <th class="rprint_total">{porc}</th>
      <th class="rprint_total">{abono}</th>
    </tr>
    <tr>
      <th class="print">Promedios</th>
      <th class="rprint_total">{prom_venta}</th>
      <th class="rprint_total">{prom_expendio}</th>
      <th class="rprint_total">{prom_diferencia}</th>
      <th class="rprint_total">{prom_porc}</th>
      <th class="rprint_total">{prom_abono}</th>
    </tr>
  </table>
</td>
</tr>
</table>
<!-- END BLOCK : movimientos -->
</body>
</html>
