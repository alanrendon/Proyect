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
<td align="center" valign="middle"><p class="title">Disponibilidad en Saldos</p>
  <form action="./ban_lib_pro.php" method="get" name="form"><table class="tabla">
    <tr>
      <th class="vtabla" scope="row"><input name="dif" type="radio" value="1" checked>
        Diferencias Positivas </th>
    </tr>
    <tr>
      <th class="vtabla" scope="row"><input name="dif" type="radio" value="2">
        Diferencias Negativas </th>
    </tr>
  </table>  <p>
    <input type="submit" class="boton" value="Siguiente">
  </p></form></td>
</tr>
</table>
<!-- END BLOCK : datos -->
<!-- START BLOCK : listado -->
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="top">
<table width="100%">
  <tr>
    <th width="30%" class="tabla" align="center">&nbsp;</th>
    <th width="40%" class="tabla" align="center">Disponibilidad en Saldos <br>
      al {dia} de {mes} de {anio} </th>
    <th width="30%" class="rtabla" align="center">{hora}</th>
  </tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" class="print">
  <tr>
    <th class="print" scope="col">Cia.</th>
    <th class="print" scope="col">Nombre</th>
    <th class="print" scope="col">Saldo en Libros</th>
    <th class="print" scope="col">Saldo Proveedores </th>
    <th class="print" scope="col">Diferencia</th>
    </tr>
  <!-- START BLOCK : fila -->
  <tr onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
    <td class="print">{num_cia}</td>
    <!-- <td class="print">{cuenta}</td> -->
    <td class="vprint">{nombre_cia}</td>
    <td class="rprint" onMouseOver="this.style.cursor = 'pointer';" onMouseOut="this.style.cursor = 'default';" onClick="window.open('./ban_esc_con.php?listado=cia&num_cia={num_cia}&fecha1=01%2F{mes}%2F{anio}&fecha2={dia}%2F{mes}%2F{anio}&tipo=todos&cerrar=1','','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=1024,height=768')"><strong><font color="#{color_saldo_libros}">{saldo_libros}</font></strong></td>
    <td class="rprint" onMouseOver="this.style.cursor = 'pointer';" onMouseOut="this.style.cursor = 'default';" onClick="window.open('ban_prov1_saldo.php?cia={num_cia}&id=','','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=1024,height=768');"><strong><font color="#0000FF">{saldo_pro}</font></strong></td>
    <td class="rprint" onMouseOver="this.style.cursor = 'pointer';" onMouseOut="this.style.cursor = 'default';" onClick="window.open('ban_prov1_saldo.php?id={id_ultima_fac}','','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=800,height=250');"><strong><font color="#{color_dif}">{diferencia}</font></strong></td>
    </tr>
  <!-- END BLOCK : fila -->
  <tr onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
    <th colspan="2" class="print">Totales</th>
    <th class="rprint_total">{total_saldo_libros}</th>
    <th class="rprint_total">{total_saldo_pro}</th>
    <th class="rprint_total">{total_diferencia}</th>
    </tr>
</table>
</td>
</tr>
</table>
<script language="javascript" type="text/javascript">
	function estado_cuenta() {
		window.open("./ban_esc_con.php?listado=cia&num_cia={num_cia}&fecha1=01%2F{mes}%2F{anio}&fecha2={dia}%2F{mes}%2F{anio}&tipo=todos","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=200");
	}
</script>
<!-- END BLOCK : listado -->
</body>
</html>
