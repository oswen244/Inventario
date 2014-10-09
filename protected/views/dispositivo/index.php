<script type="text/javascript">
	$(document).ready(function() {
		var datos = <?php echo $dispositivos; ?>;
		var id = '#dispTable';
		var atributos = ["imei_ref","f_adquirido","id_estado","comentario","ubicacion","tipo_disp"];
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
						<th>Comentario</th>
						<th>Ubicación</th>
						<th>Tipo</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
		</table>
	</div>
</div>