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
<td align="center" valign="middle"><p class="title">Listado de Carpinter&iacute;a</p>
  <form method="get" name="form" action="./bal_lis_mad.php" onKeyPress="if (event.keyCode == 13) return false;"><table class="tabla">
    <tr>
      <th class="vtabla" scope="row">Mes</th>
      <td class="vtabla"><select name="mes" class="insert" id="mes">
        <option value="1" {1}>ENERO</option>
        <option value="2" {2}>FEBRERO</option>
        <option value="3" {3}>MARZO</option>
        <option value="4" {4}>ABRIL</option>
        <option value="5" {5}>MAYO</option>
        <option value="6" {6}>JUNIO</option>
        <option value="7" {7}>JULIO</option>
        <option value="8" {8}>AGOSTO</option>
        <option value="9" {9}>SEPTIEMBRE</option>
        <option value="10" {10}>OCTUBRE</option>
        <option value="11" {11}>NOVIEMBRE</option>
        <option value="12" {12}>DICIEMBRE</option>
      </select></td>
    </tr>
    <tr>
      <th class="vtabla" scope="row">Anio</th>
      <td class="vtabla"><input name="anio" type="text" class="insert" id="anio" value="{anio}" size="4" maxlength="4"></td>
    </tr>
  </table>  <p>
    <input type="button" class="boton" value="Siguiente" onClick="valida_registro(form)"> 
    </p></form></td>
</tr>
</table>
<script language="javascript" type="text/javascript">
	function valida_registro(form) {
		if (form.anio.value <= 0) {
			alert("Debe especificar el a�o");
			form.anio.select();
			return false;
		}
		else
			form.submit();
	}
	
	document.form.anio.select();
</script>
<!-- END BLOCK : datos -->
<!-- START BLOCK : listado -->
<table width="100%">
  <tr>
    <td>&nbsp;</td>
    <td class="print_encabezado" align="center">Oficinas Administrativas Mollendo S. de R.L. y C.V. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="60%" class="print_encabezado" align="center">Carpinter&iacute;as<br>
      al mes de {mes} de {anio} </td>
    <td width="20%">&nbsp;</td>
  </tr>
</table>
  <br>
  <table align="center" class="print">
    <tr>
      <th colspan="2" class="print" scope="col">Compa&ntilde;&iacute;a</th>
      <th class="print" scope="col">Madera</th>
    </tr>
    <!-- START BLOCK : fila -->
	<tr onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
      <td class="vprint">{num_cia}</td>
      <td class="vprint">{nombre}</td>
      <td class="rprint">{madera}</td>
    </tr>
	<!-- END BLOCK : fila -->
	<tr onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
	  <th colspan="2" class="rprint">Total</th>
	  <th class="rprint_total">{total}</th>
    </tr>
  </table>
  <!-- START BLOCK : salto -->
  <br style="page-break-after:always;">
  <!-- END BLOCK : salto -->
<!-- END BLOCK : listado -->
</body>
</html>
