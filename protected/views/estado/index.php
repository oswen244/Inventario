<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = [];
	    var atributos = ["estado","descripcion"];
        $('#datatable tr:last-child th').each(function() {
	    	nombres.push($(this).html()+": ");
	    });
	    var table = customDataTable('#datatable', <?php echo $estados; ?>, atributos, nombres);

	    $('#dialog').click(function() {
            borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');
        });

	    validar('#form_estado');

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
		<table id="datatable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class ="busqueda">
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Estado</th>
					<th>Descripción</th>
				</tr>				
			</thead>
			
			<tbody>
			</tbody>
		</table>
		<input type="button" id="dialog" data-toggle="modal" class="btn btn-danger btn-sm" value="Eliminar">
		

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
						<button id="deleteCascade" type="button" class="btn btn-primary" data-dismiss="modal">Si</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="modalEditLabel">Edición de estado</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">

							<!-- Formulario			 -->
								<form id="form_estado" class="form form-horizontal" role="form">
									<div class="form-group col-md-12">
										<label for="estado" class="col-md-2 control-label">Nombre estado:</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="texto" placeholder="Nombre">
										</div>
									</div>

									<div class="form-group col-md-12 text-center">
										<label class="col-md-2 control-label">Comentario:</label>
										<div class="col-md-10 col-md-offset-2">
											<textarea type="textArea" name="texto" class="form-control" placeholder="Comentario..."></textarea>
										</div>
									</div>

									<input  type="text" name="helper" class="helper form-control" placeholder="">
									<div class="buttons-submit col-md-10">
										<div class="col-md-2 col-md-offset-4">
											<button id="btnGuardar" type="submit" class="btn btn-primary">Registrar estado</button>
										</div>
										<div class="col-md-3 col-md-offset-1">
											<button id="cancelar" type="submit" class="btn btn-success" data-dismiss="modal">Cancelar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>

</div>