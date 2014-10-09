<script type="text/javascript">

	$(document).ready(function() {

	    var datos = <?php echo $estados; ?>;
	    var atributos = ["estado","descripcion"];
	    customDataTable('#datatable', datos, atributos);

	    
	});

</script>


<h1 class="header-tittle">Estados</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="estado/create">Registrar estado</a></li>
	
	<?php $this->endContent(); ?>

	<div class="content-side">
		<table id="datatable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Estado</th>
					<th>Descripción</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>

		<input type="button" id="delete" class="btn btn-default btn-danger" value="Eliminar">
	</div>

</div>