<script type="text/javascript">

	$(document).ready(function() {
		var nombres = [];
	    var datos = <?php echo $planes; ?>;
	    var atributos = ["nombre_plan","cargo_voz","cargo_datos","desc_p_voz","desc_p_datos"];	    
	    var table = customDataTable('#planTable', datos, atributos, nombres);

	    $('#dialog').click(function() {
            borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');
        });

	    $('#planTable tr th').each(function() {
	    	nombres.push($(this).html());
	    });
	   

	});

</script>

<h1 class="header-tittle">Planes</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/plan/create">Registrar plan</a></li>
	
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
	<table id="planTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
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
	
	<div id="modalCascade" class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Advertencia</h4>
					</div>
					<div class="cascada modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
</div>

</div>