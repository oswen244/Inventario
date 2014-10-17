<script type="text/javascript">

	$(document).ready(function() {
		var nombres = [];
	    var datos = <?php echo $estados; ?>;
	    var atributos = ["estado","descripcion"];
	    var table = customDataTable('#datatable', datos, atributos);

	    $('#dialog').click(function() {
            borrar(table,'#myModal','#delete');
        });

        $('#datatable tr th').each(function() {
	    	nombres.push($(this).html());
	    });

	});

</script>


<h1 class="header-tittle">Estados</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/estado/create">Registrar estado</a></li>
	
	<?php $this->endContent(); ?>

	<div class="content-side">
		<div class="actions btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				Acciones <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="estado/create">Registrar estado</a></li>
			</ul>
		</div>
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
		<input type="button" id="dialog" data-toggle="modal"  class="btn btn-danger btn-sm" value="Eliminar">
		<div id="myModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Advertencia</h4>
				</div>
				<div class="modal-body">
					<p>Se borrarán los registros seleccionados</p>
				</div>
				<div class="modal-footer">
					<button id="delete" type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	</div>

</div>