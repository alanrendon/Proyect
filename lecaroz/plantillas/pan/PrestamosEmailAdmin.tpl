<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
body, td, th {
	font-family: Arial, Helvetica, sans-serif;
}

table {
	border: solid 1px #000;
	border-collapse: collapse;
}

td, th {
	border: solid 1px #000;
}

.red {
	color: #C00;
}

.blue {
	color: #00C;
}

.bold {
	font-weight: bold;
}

.font16 {
	font-size: 16pt;
}

.atraso {
	color: #C00;
	font-weight: bolder;
	text-decoration: underline;
}
</style>
</head>
<body>
<p style="font-size:18pt;">LE ENVIAMOS EL REPORTE DETALLADO DE LOS PRESTAMOS A EMPLEADOS ADEUDADOS AL DIA {fecha}.</p>
<table>
	<!-- START BLOCK : cia -->
	<tr>
		<th colspan="8" align="left" class="font16" scope="col">{num_cia} {nombre_cia}</th>
	</tr>
	<tr>
		<th scope="col">Empleado</th>
		<th scope="col">Prestamo</th>
		<th scope="col">Fecha de<br />
			&uacute;ltimo prestamo</th>
		<th scope="col">Abonos</th>
		<th scope="col">Fecha de<br />
			&uacute;ltimo abono</th>
		<th scope="col">&Uacute;ltimo<br />
			pago</th>
		<th scope="col">D&iacute;as de<br />
			atraso</th>
		<th scope="col">Saldo</th>
	</tr>
	<!-- START BLOCK : row -->
	<tr>
		<td nowrap="nowrap">{num_emp} {nombre_emp}</td>
		<td align="right" class="red">{prestamo}</td>
		<td align="center" class="red">{fecha_ultimo_prestamo}</td>
		<td align="right" class="blue">{abonos}</td>
		<td align="center" class="blue">{fecha_ultimo_abono}</td>
		<td align="right" class="blue">{ultimo_abono}</td>
		<td align="right" class="{atraso}">{dias_atraso}</td>
		<td align="right" class="red bold">{saldo}</td>
	</tr>
	<!-- END BLOCK : row -->
	<tr>
		<th colspan="7" align="right">Adeudo total</th>
		<th align="right" class="red">{total}</th>
	</tr>
	<tr>
		<td colspan="8">&nbsp;</td>
	</tr>
	<!-- END BLOCK : cia -->
</table>
<hr />
<p style="font-size:8pt; font-weight:bold;">Favor de no responder  a este correo electr&oacute;nico, este buz&oacute;n no se supervisa y no recibira respuesta.</p>
<!-- THE CAKE IS A LIE -->
</body>
</html>