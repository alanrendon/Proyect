<!-- START BLOCK : obtener_datos -->
<script type="text/javascript" language="JavaScript">
function valida()
{
if (document.form.num_cia.value==0 && document.form.temp1.value==0){
	alert("Debe especificar una compa��a");
	document.form.num_cia.select();
}	
else document.form.submit();
}	
</script>
<link href="/styles/impresion.css" rel="stylesheet" type="text/css">





<link href="/styles/tablas.css" rel="stylesheet" type="text/css">
<link href="/styles/listado.css" rel="stylesheet" type="text/css">
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="middle">
<p class="title">Consulta de existencias de materia prima a inicio de mes </P>
<form name="form" method="get" action="./ped_inv_con.php">
<input name="temp" type="hidden" value="">
  <table class="tabla">
  <tr class="tabla">
  <th class="tabla" colspan="2">TIPO DE CONSULTA</th>
  </tr>
  <tr class="tabla">
    <td class="vtabla">
	  <label> <input type="radio" name="tipo_con" value="0" checked onChange="document.form.temp1.value=0;">Compa��a</label>
	  <input name="num_cia" type="text" id="num_cia" size="5" maxlength="5" class="insert" onChange="valor=isInt(this,form.temp);" onFocus="form.temp.value=this.value">
	  <input name="temp1" type="hidden" class="insert" id="temp1" value="0" size="5" maxlength="5">
	  <input name="temp2" type="hidden" class="insert" id="temp2" value="0" size="5" maxlength="5">
	  
	</td>
	<td class="vtabla">
	  <p>
	    <label>
	    <input type="radio" name="tipo_con" value="1" onChange="document.form.temp1.value=1;">
	    Todas</label>
las	compa&ntilde;&iacute;as  </p>
	  </td>
	
  </tr>
  <tr class="tabla">
  	<td class="vtabla" colspan="2">
	    <label>
	    <input type="radio" name="mat_prima" value="1" onChange="document.form.temp2.value=1;">
Todas los productos</label>
<br>
	    <label>
	    <input type="radio" name="mat_prima" value="0" checked onChange="document.form.temp2.value=0;">
			Materia Prima</label>	    
		<!-- START BLOCK : codmp -->
	    <input name="codmp{i}" type="text" id="codmp{i}" size="5" maxlength="5" class="insert" onChange="valor=isInt(this,form.temp);" onFocus="form.temp.value=this.value" onKeyDown="if(event.keyCode==13) form.codmp{next}.select();">
		<!-- END BLOCK : codmp -->
	</td>
  
  </tr>
  
</table>
  <p>
  <img src="./menus/insert.gif" align="middle">&nbsp;&nbsp;<input type="button" name="enviar" class="boton" value="Consultar" onclick='valida()'>
  </p>
</form>
<script language="javascript" type="text/javascript">window.onload = document.form.num_cia.select();</script>
</td>
</tr>
</table>
<!-- END BLOCK : obtener_datos -->


<!-- START BLOCK : listado_cia -->
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="top">

<p class="title">OFICINAS ADMINISTRATIVAS MOLLENDO S. DE R.L. DE C.V.</p>
<p class="title">EXISTENCIAS DE MATERIA PRIMA PARA LA COMPA��A AL {dia} DE {mes} DE {anio}</p>
<table border="1" class="tabla">
  <tr class="tabla">
    <td scope="col" class="tabla" colspan="6"><font size="+1">{num_cia} &#8212; {nom_cia}</font></td>
  </tr>
  <tr class="tabla">
    <th scope="row" class="tabla" colspan="2">Materia Prima</th>
    <th class="tabla">Existencia</th>

    <th class="tabla" colspan="2">Materia Prima</th>
    <th class="tabla">Existencia</th>
  </tr>

<!-- START BLOCK : rows -->

  <tr class="tabla">
    <th class="rtabla">&nbsp;&nbsp;&nbsp;&nbsp;{codmp}</th>
    <td class="vtabla">{nom_mp}</td>
    <td class="rtabla">{existencia}</td>

    <th class="rtabla">&nbsp;&nbsp;&nbsp;&nbsp;{codmp1}</th>
    <td class="vtabla">{nom_mp1}</td>
    <td class="rtabla">{existencia1}</td>
  </tr>
<!-- END BLOCK : rows -->
</table>
</td>
</tr>
</table>
<!-- END BLOCK : listado_cia -->

<!-- START BLOCK : listado_todos -->
<table width="100%"  height="98%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" valign="top"><p class="listado_encabezado">OFICINAS ADMINISTRATIVAS MOLLENDO S. DE R.L. DE C.V.<br>
EXISTENCIAS DE MATERIA PRIMA  AL {dia} DE {mes} DE {anio}
</p>

	<table width="100%" cellpadding="0" cellspacing="2" class="listado">
	  <tr class="listado">
		<th scope="col" class="vlistado">Cia</th>
		<!-- START BLOCK : mat_prima -->
		<th scope="col" class="listado"> {codmp} <br> {nom_mp}</th>
		<!-- END BLOCK : mat_prima -->
	  </tr>
		<!-- START BLOCK : rows1 -->
	  <tr class="listado" onMouseOver="overTR(this,'#ACD2DD');" onMouseOut="outTR(this,'');">
		<th class="vlistado">
		{num_cia}&nbsp;{nom_cia}
		</th>
		<!-- START BLOCK : existencia -->
		<td class="listado">{existencia}</td>
		<!-- END BLOCK : existencia -->
	  </tr>
		<!-- END BLOCK : rows1 -->
	</table>
</td>
</tr>
</table>
<!-- END BLOCK : listado_todos -->
