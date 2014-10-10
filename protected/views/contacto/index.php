<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $contactos; ?>;
	    var id = '#contactoTable';
	    var atributos = ["nombre","telefono","tipo_entidad","cargo","email", "id_entidad"];	    
	    customDataTable(id, datos, atributos); 
	});

</script>

<h1 class="header-tittle">Contactos</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="contacto/create">Registrar contacto</a></li>
	
	<?php $this->endContent(); ?>

	<div class="content-side">
		<div class="actions btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				Acciones <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="contacto/create">Registrar contacto</a></li>
			</ul>
		</div>
		<table id="contactoTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Tipo entidad</th>
					<th>Cargo</th>
					<th>E-mail</th>
					<th>Entidad</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>

</div>