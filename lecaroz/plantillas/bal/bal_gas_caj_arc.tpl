<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../styles/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../styles/pages.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="middle"><p class="title">Carga de Archivo de Gastos</p>
  <form action="./bal_gas_caj_arc.php" method="post" enctype="multipart/form-data" name="form">
    <table class="tabla">
    <tr>
      <th class="vtabla" scope="row">Archivo CSV </th>
      <td class="vtabla"><input name="archivo" type="file" class="insert" id="archivo" onkeydown="if (event.keyCode == 13) this.blur()" size="30" /></td>
    </tr>
    <tr>
      <th class="vtabla" scope="row">Fecha</th>
      <td class="vtabla"><input name="fecha" type="text" class="insert" id="fecha" onfocus="tmp.value=this.value;this.select()" onchange="inputDateFormat(this)" onkeydown="if (event.keyCode == 13) document.form.comentario.focus()" value="{fecha}" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <th class="vtabla" scope="row">Concepto</th>
      <td class="vtabla"><select name="cod_gastos" class="insert" id="cod_gastos">
        <!-- START BLOCK : cod -->
		<option value="{cod}">{desc}</option>
		<!-- END BLOCK : cod -->
      </select>      </td>
    </tr>
    <tr>
      <th class="vtabla" scope="row">Aplica a balance </th>
      <td class="vtabla"><input name="clave_balance" type="checkbox" id="clave_balance" value="1" />
        Si</td>
    </tr>
    <tr>
      <th class="vtabla" scope="row">Tipo</th>
      <td class="vtabla"><input name="tipo_mov" type="radio" value="FALSE" checked="checked" />
        Egresos
          <input name="tipo_mov" type="radio" value="TRUE" />
          Ingresos</td>
    </tr>
    <tr>
      <th class="vtabla" scope="row">Comentario</th>
      <td class="vtabla"><input name="comentario" type="text" class="vinsert" id="comentario" onkeydown="if (event.keyCode == 13) document.form.fecha.select()" value="" size="30" style="width:100%;" maxlength="255" /></td>
    </tr>
  </table>  
    <p style=" font-family:Arial, Helvetica, sans-serif; font-weight:bold;">NOTA: El formato del archivo debe ser 'CSV delimitado por comas', sin t&iacute;tulos ni encabezados y los importes no deben contener 'coma' como separador de miles. </p>
    <p>
    <input type="button" class="boton" value="Cargar" onclick="validar()" />
</p></form></td>
</tr>
</table>
<script language="javascript" type="text/javascript">
<!--
var f = document.form;

function validar() {
	if (f.archivo.value == '') {
		alert('No ha especificado el archivo');
		f.archivo.focus();
	}
	else if (f.fecha.value.length < 8) {
		alert('Debe especificar la fecha');
		f.fecha.select();
	}
	else if (confirm('�Desea cargar el archivo?'))
		f.submit();
}

window.onload = f.archivo.focus();
//-->
</script>
</body>
</html>
