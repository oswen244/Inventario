<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $users; ?>;
	    var id = '#usuariosTable';
	    var atributos = ["usuario","rol","nombre"];	    
	    customDataTable(id, datos, atributos); 
	});

</script>


<h1 class="header-tittle">Usuarios</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="usuario/create">Registrar usuario</a></li>
	
	<?php $this->endContent(); ?>

<div class="content-side">
	<table id="usuariosTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Rol</th>
					<th>Nombre</th>
				</tr>
			</thead>

			<tbody>

			</tbody>
	</table>
</div>

</div>