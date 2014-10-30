<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = [];
	    var datos = <?php echo $planes; ?>;
	    var atributos = ["nombre_plan","cargo_voz","cargo_datos","Total","desc_p_voz","desc_p_datos"];	    
	    $('#planTable tr:last-child th').each(function() {
	    	nombres.push($(this).html()+":");
	    });
	    var table = customDataTable('#planTable', datos, atributos, nombres);

	    $('#dialog').click(function() {
            borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');
        });

	   validar('#form_plan');

	   $('.precio').on('change', function() {
			var precios = parseFloat($('#datos').val())+parseFloat($('#voz').val());
			$('#modalEdit #cargo_fijo').val(precios);
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
				<tr class="busqueda">
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Nombre Plan</th>
					<th>Cargo por voz</th>
					<th>Cargo por datos</th>
					<th>Total</th>
					<th>Desc voz</th>
					<th>Desc datos</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
	</table>
	<input type="button" id="dialog" data-toggle="modal"  class="btn btn-danger btn-sm" value="Eliminar">

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

					<!-- Modal de edicion -->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="modalEditLabel">Actualización de Planes</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">

							<!-- Formulario			 -->
							<form id="form_plan" class="form form-horizontal" action="update" role="form"><br>

								<div class="form-group col-md-9">
									<label for="nombre_plan" class="col-md-5 control-label">Nombre del plan:</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="texto" placeholder="Nombre del plan">
									</div>
								</div>

								<div class="form-group col-md-9">
									<label for="cargo_datos" class="col-md-5 control-label">Cargo por datos:</label>
									<div class="col-md-7 input-group">
										<span class="input-group-addon">$</span><input id="datos" type="number" class="precio form-control" name="texto"><span class="input-group-addon">.00</span>
									</div>
								</div>

								<div class="form-group col-md-9">
									<label for="cargo_voz" class="col-md-5 control-label">Cargo por voz:</label>
									<div class="col-md-7 input-group">
										<span class="input-group-addon">$</span><input id="voz" type="number" class="precio form-control" name="texto"><span class="input-group-addon">.00</span>
									</div>
								</div>
								<div class="form-group col-md-9">
									<label for="desc_p_datos" class="col-md-5 control-label">Plan datos:</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="texto" placeholder="Ej: 200MB">
									</div>
								</div>

								<div class="form-group col-md-9">
									<label for="desc_p_voz" class="col-md-5 control-label">Plan voz:</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="texto" placeholder="Ej: 200 MINS">
									</div>
								</div>


								<input  type="text" name="helper" class="helper form-control" placeholder="">

								<div class="form-group col-md-9">
									<label for="c_fijoM" class="col-md-5 control-label">Cargo fijo mensual:</label>
									<div class="col-md-7 input-group">
										<span class="input-group-addon">$</span><input id="cargo_fijo" type="number" readonly class="ignorar form-control" name="texto"><span class="input-group-addon">.00</span>
									</div>
								</div>
								


								<div class="buttons-submit col-md-12">
									<div class="col-md-2 col-md-offset-4">
										<button id="btnGuardar"  type="submit" class="btn btn-primary">Actualizar plan</button>
									</div>
									<div class="col-md-2">
										<button  class="btn btn-success" data-dismiss="modal">Cancelar</button>
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