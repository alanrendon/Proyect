<form name="inicio_form" class="FormValidator" id="inicio_form">
	<table class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="bold">Compañía(s)</td>
				<td><input name="cias" type="text" class="validate toInterval" id="cias" size="40" /></td>
			</tr>
			<tr>
				<td class="bold">Administrador</td>
				<td>
					<select name="admin" id="admin">
						<option value=""></option>
						<!-- START BLOCK : admin -->
						<option value="{value}">{text}</option>
						<!-- END BLOCK : admin -->
					</select>
				</td>
			</tr>
			<tr>
				<td class="bold">A&ntilde;o</td>
				<td><input name="anio" type="text" class="validate focus toPosInt center" id="anio" size="4" value="{anio}" /></td>
			</tr>
			<tr>
				<td class="bold">Mes</td>
				<td>
					<select name="mes" id="mes">
						<option value="1"{1}>ENERO</option>
						<option value="2"{2}>FEBRERO</option>
						<option value="3"{3}>MARZO</option>
						<option value="4"{4}>ABRIL</option>
						<option value="5"{5}>MAYO</option>
						<option value="6"{6}>JUNIO</option>
						<option value="7"{7}>JULIO</option>
						<option value="8"{8}>AGOSTO</option>
						<option value="9"{9}>SEPTIEMBRE</option>
						<option value="10"{10}>OCTUBRE</option>
						<option value="11"{11}>NOVIEMBRE</option>
						<option value="12"{12}>DICIEMBRE</option>
					</select>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</tfoot>
	</table>
	<p>
		<input type="button" name="consultar" id="consultar_desglosado" value="Consultar" />
		<!-- <input type="button" name="consultar" id="consultar_totales" value="Consultar (totales)" /> -->
	</p>
</form>
