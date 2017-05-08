<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../styles/tablas.css" rel="stylesheet" type="text/css">
<link href="../../styles/pages.css" rel="stylesheet" type="text/css">
<link href="../../styles/impresion.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- START BLOCK : datos -->
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="middle"><p class="title">Consumos Anuales por Compa&ntilde;&iacute;a </p>
  <form action="./fac_con_cia.php" method="get" name="form">
  <input name="temp" type="hidden">
  <table class="tabla">
    <tr>
      <th class="vtabla">Compa&ntilde;&iacute;a</th>
      <td class="vtabla"><input name="num_cia" type="text" class="insert" id="num_cia" onFocus="temp.value=this.value" onChange="isInt(this,temp)" onKeyDown="if (event.keyCode == 13 || event.keyCode == 40 || event.keyCode == 38) anio.select();" size="4" maxlength="4"></td>
    </tr>
    <tr>
      <th class="vtabla">A&ntilde;o</th>
      <td class="vtabla"><input name="anio" type="text" class="insert" id="anio" onFocus="temp.value=this.value" onChange="isInt(this,temp)" onKeyDown="if (event.keyCode == 13 || event.keyCode == 40 || event.keyCode == 38) num_cia.select();" value="{anio}" size="4" maxlength="4"></td>
    </tr>
  </table>  <p>
    <input type="button" class="boton" value="Siguiente" onClick="valida_registro(form)">
  </p></form></td>
</tr>
</table>
<script language="javascript" type="text/javascript">
	function valida_registro(form) {
		if (form.num_cia.value <= 0) {
			alert("Debe especificar el c�digo de materia prima");
			form.num_cia.select();
			return false;
		}
		else if (form.anio.value < 2000) {
			alert("Debe especificar el a�o");
			form.anio.select();
			return false;
		}
		else
			form.submit();
	}
</script>
<!-- END BLOCK : datos -->

<!-- START BLOCK : listado -->
<table width="100%" align="center">
  <tr>
    <td width="20%" class="print_encabezado">Cia.: {num_cia} </td>
    <td width="60%" class="print_encabezado" align="center">{nombre_cia}<br>
    Consumos Anuales del {anio} </td>
    <td width="20%" align="right" class="print_encabezado">Cia.: {num_cia} </td>
  </tr>
</table>
  <br>
  <table width="100%" align="center" cellpadding="0" cellspacing="0" class="print">
    <tr>
      <th class="print" scope="col">Materia Prima </th>
      <th width="6%" class="print" scope="col">Ene</th>
      <th width="6%" class="print" scope="col">Feb</th>
      <th width="6%" class="print" scope="col">Mar</th>
      <th width="6%" class="print" scope="col">Abr</th>
      <th width="6%" class="print" scope="col">May</th>
      <th width="6%" class="print" scope="col">Jun</th>
      <th width="6%" class="print" scope="col">Jul</th>
      <th width="6%" class="print" scope="col">Ago</th>
      <th width="6%" class="print" scope="col">Sep</th>
      <th width="6%" class="print" scope="col">Oct</th>
      <th width="6%" class="print" scope="col">Nov</th>
      <th width="6%" class="print" scope="col">Dic</th>
      <th width="6%" class="print" scope="col">Total</th>
      <th width="6%" class="print" scope="col">Promedio</th>
    </tr>
    <!-- START BLOCK : fila -->
	<tr onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
      <td class="vprint">{codmp} {nombre_mp} </td>
      <td class="rprint">{1}</td>
      <td class="rprint">{2}</td>
      <td class="rprint">{3}</td>
      <td class="rprint">{4}</td>
      <td class="rprint">{5}</td>
      <td class="rprint">{6}</td>
      <td class="rprint">{7}</td>
      <td class="rprint">{8}</td>
      <td class="rprint">{9}</td>
      <td class="rprint">{10}</td>
      <td class="rprint">{11}</td>
      <td class="rprint">{12}</td>
      <td class="rprint">{total}</td>
      <td class="rprint">{promedio}</td>
	</tr>
	<!-- END BLOCK : fila -->
	  <!-- START BLOCK : total -->
  <!-- END BLOCK : total -->
</table>
<br style="page-break-after:always;">

  <!-- END BLOCK : listado -->
</body>
</html>
