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
				<td>
					<input name="cias" type="text" class="validate toInterval" id="cias" size="40" />
				</td>
			</tr>
			<tr>
				<td class="bold">Administrador</td>
				<td>
					<select name="admin" id="admin">
						<option value="" class="logo_banco"></option>
						<!-- START BLOCK : admin -->
						<option value="{value}">{text}</option>
						<!-- END BLOCK : admin -->
					</select>
				</td>
			</tr>
			<tr>
				<td class="bold">A&ntilde;o</td>
				<td>
					<input name="anio" type="text" class="validate focus toPosInt center" id="anio" size="4" value="{anio}" />
				</td>
			</tr>
			<tr>
				<td class="bold">Mes</td>
				<td>
					<select name="mes" id="mes">
						<!-- START BLOCK : mes -->
						<option value="{value}"{selected}>{text}</option>
						<!-- END BLOCK : mes -->
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
		<input type="button" name="consultar" id="consultar" value="Consultar" />
	</p>
</form>
