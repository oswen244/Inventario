<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $clientes; ?>;
	    var id = '#clienteTable';
	    var atributos = ["nombre","tipo_identi","num_id","ciudad","direccion","telefono","email"];	    
	    customDataTable(id, datos, atributos); 
	});

</script>


<h1 class="header-tittle">Clientes</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="cliente/create">Registrar clientes</a></li>
	
	<?php $this->endContent(); ?>

<div class="content-side">
	<table id="clienteTable" class="table table-striped table-bordered" width="100%" cellspacing="0">
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
			<tfoot>
				<tr>
					<th>Nombre</th>
					<th>Tipo id</th>
					<th>Número id</th>
					<th>Ciudad</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>E-mail</th>
				</tr>
			</tfoot>

			<tbody>

			</tbody>
	</table>
</div>

</div>