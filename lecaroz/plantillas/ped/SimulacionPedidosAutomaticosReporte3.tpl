<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pedidos</title>
<link href="styles/screen.css" rel="stylesheet" type="text/css" media="screen" />
<link href="styles/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="styles/font-style.css" rel="stylesheet" type="text/css" />
<link href="/lecaroz/styles/screen.css" rel="stylesheet" type="text/css" media="screen" />
<link href="/lecaroz/styles/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="/lecaroz/styles/font-style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jscripts/mootools/mootools-1.2-core.js"></script>
<script type="text/javascript" src="jscripts/mootools/mootools-1.2-more.js"></script>
<script type="text/javascript" src="jscripts/mootools/extensiones.js"></script>
<script type="text/javascript" src="jscripts/ped/SimulacionPedidosAutomaticosReporte.js"></script>

<style type="text/css" media="screen">
.Tip {
	background: #FF9;
	border: solid 1px #000;
	padding: 3px 5px;
}

.tip-title {
	font-weight: bold;
	font-size: 8pt;
	border-bottom: solid 2px #FC0;
	padding: 0 5px 3px 5px;
	margin-bottom: 3px;
}

.tip-text {
	font-weight: bold;
	font-size: 8pt;
	padding: 0 5px;
}
</style>

<!--<style type="text/css" media="print">
.Tip, .tip-title, .tip-text {
	display: none;
}
</style>-->

</head>

<body>
<!-- START BLOCK : reporte -->
<table width="98%" align="center" class="encabezado">
  <tr>
  	<td width="15%" class="font14">{num_pro}</td>
  	<td width="70%" align="center" class="font14">{nombre_pro}<br />
  		<span style="font-size:10pt;">{telefono}</span></td>
  	<td width="15%" align="right" class="font14">{num_pro}</td>
  	</tr>
  <tr>
    <td class="font8">&nbsp;</td>
    <td align="center">Pedidos al {dia} de {mes} de {anio}<br />
    (d&iacute;as pedidos: {dias})</td>
    <td align="right" class="font8">&nbsp;</td>
  </tr>
</table>
<br />
<table align="center" class="print">
  <!-- START BLOCK : cia -->
  <tr>
  	<th colspan="5" align="left" class="print font12" scope="col">{num_cia} {nombre_cia}</th>
  	</tr>
  <tr>
    <th colspan="2" class="print" scope="col">Producto</th>
    <th class="print" scope="col">Pedido</th>
    <th class="print" scope="col">Unidad</th>
    <th class="print" scope="col">Entregar</th>
    </tr>
  <!-- START BLOCK : pro -->
  <tr id="row">
    <td align="right" class="print">{codmp}</td>
    <td class="print">{nombre_mp}</td>
    <td align="right" class="print">{pedido}</td>
    <td class="print">{unidad}</td>
    <td align="right" class="print blue">{pedido_pro}</td>
    </tr>
  <!-- END BLOCK : pro -->
  <tr>
  	<td colspan="5" align="right" class="print">&nbsp;</td>
  	</tr>
  <!-- END BLOCK : cia -->
</table>
<p>SE&Ntilde;OR PROVEEDOR LE PEDIMOS VERIFIQUE BIEN NUESTRO PEDIDO Y CORROBORE QUE LOS DATOS SEAN CONGRUENTES CON LOS PEDIDOS DE MESES ANTERIORES, ESTO ES CON EL FIN DE EVITAR ALGUNA DEVOLUCION A LA HORA DE LA ENTREGA Y EN SU DEFECTO EN SU PAGO. SIN MAS POR EL MOMENTO Y AGRADECIENDO SUS ATENCIONES.</p>
{salto} 
<!-- END BLOCK : reporte -->
<p align="center" class="noDisplay">
	<input name="cerrar" type="button" id="cerrar" value="Cerrar" />
</p>
</body>
</html>
