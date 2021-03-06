<form name="inicio_form" class="FormValidator" id="inicio_form">
	<table class="table">
		<thead>
			<tr>
				<th colspan="2" scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="bold">Compa&ntilde;&iacute;a(s)</td>
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
				<td class="bold">Periodo</td>
				<td>
					<input name="fecha1" type="text" class="validate focus toDate center" id="fecha1" size="10" value="{fecha1}" />
					al
					<input name="fecha2" type="text" class="validate focus toDate center" id="fecha2" size="10" value="{fecha2}" />
				</td>
			</tr>
			<tr>
				<td class="bold">Banco</td>
				<td>
					<select name="banco" id="banco">
						<option value="1">BANORTE</option>
						<option value="2">SANTANDER</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="bold">Concepto</td>
				<td>
					<select name="cod_mov" id="cod_mov"></select>
				</td>
			</tr>
			<!-- <tr>
				<td class="bold">Opciones</td>
				<td>
					<input name="agrupar_rfc" type="checkbox" id="agrupar_rfc" value="1" /> Agrupar por R.F.C.
				</td>
			</tr> -->
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</tfoot>
	</table>
	<p>
		<input type="button" name="consultar" id="consultar" value="Consultar" />
	</p>
</form>
