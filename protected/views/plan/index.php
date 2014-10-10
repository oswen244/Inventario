<script type="text/javascript">

	$(document).ready(function() {
	    var datos = <?php echo $planes; ?>;
	    var id = '#planTable';
	    var atributos = ["nombre_plan","cargo_voz","cargo_datos","desc_p_voz","desc_p_datos"];	    
	    customDataTable(id, datos, atributos); 
	});

</script>

<h1 class="header-tittle">Planes</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="plan/create">Registrar plan</a></li>
	
	<?php $this->endContent(); ?>

<div class="content-side">
	<div class="actions btn-group">
		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
			Acciones <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="plan/create">Registrar plan</a></li>
		</ul>
	</div>
	<table id="planTable" class="display responsive nowrap" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Nombre Plan</th>
					<th>Cargo por voz</th>
					<th>Cargo por datos</th>
					<th>Desc voz</th>
					<th>Desc datos</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
	</table>
</div>

</div>