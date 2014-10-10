<script type="text/javascript">
	$(document).ready(function() {
		var datos = <?php echo $dispositivos; ?>;
		var id = '#dispTable';
		var atributos = ["Referencia","Fecha_Adq","Estado","Proveedor","Imei_ref"];
		customDataTable(id, datos, atributos);
	});
</script>
<h1 class="header-tittle">Dispositivos</h1>

<div class="content">
	<div class="content-side">
		<table id="dispTable" class="display responsive nowrap" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Referencia</th>
						<th>Fecha adq</th>
						<th>Estado</th>
						<th>Proveedor</th>
						<th>IMEI</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
		</table>
	</div>
</div>