<form name="Datos" class="FormValidator FormStyles" id="Datos">
	<table class="tabla_captura">
		<tr class="linea_off">
			<th align="left" scope="row">Compañía(s)</th>
			<td><input name="cias" type="text" class="valid toInterval" id="cias" size="30" /></td>
		</tr>
		<tr class="linea_on">
			<th align="left" scope="row">Administrador</th>
			<td><select name="admin" id="admin">
					<option value="" selected="selected"></option>
					<!-- START BLOCK : admin -->
					<option value="{value}">{text}</option>
					<!-- END BLOCK : admin -->
				</select></td>
		</tr>
	</table>
	<p>
		<input type="button" name="consultar" id="consultar" value="Consultar" />
	</p>
</form>
