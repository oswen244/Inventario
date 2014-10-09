<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $proveedores; ?>;
	    var id = '#proveedorTable';
	    var atributos = ["nombre","tipo_identi","num_id","ciudad","direccion","telefono","email"];	    
	    customDataTable(id, datos, atributos); 
	});

</script>

<h1 class="header-tittle">Proveedores</h1>

<div class="content">
	
<div class="content-side">
	<table id="proveedorTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Tipo id</th>
					<th>Número id</th>
					<th>Ciudad</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>E-mail</th>
				</tr>
			</thead>

			<tbody>

			</tbody>
	</table>
</div>

</div>