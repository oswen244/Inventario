<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = [];
	    var datos = <?php echo $contactos; ?>;
	    var atributos = ["Nombre","Telefono","Tipo_entidad","Cargo","Email","Entidad"];
	    $('#contactoTable tr:last-child th').each(function() {
	    	nombres.push($(this).html()+": ");
	    });
	    var table = customDataTable('#contactoTable', datos, atributos, nombres);

	    $('#dialog').click(function() {
            borrar(table,'#myModal','#modalCascade','#delete','#deleteCascade');
        });

        validar('#form_contacto');

	});

</script>

<h1 class="header-tittle">Contactos</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/contacto/create">Registrar contacto</a></li>

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
		<table id="contactoTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
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
		<input type="button" id="dialog" data-toggle="modal" class="btn btn-danger btn-sm" value="Eliminar">

		<div id="modalCascade" class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Advertencia</h4>
					</div>
					<div class="modal-body">
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
						<h4 class="modal-title" id="modalEditLabel">Actualización de contacto</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">

							<!-- Formulario-->
								<form id="form_contacto" class="form form-horizontal" action="update" method="post" role="form"><br>
									<div class="form-group col-md-12">
										<label for="nombre" class="col-md-2 control-label">Nombre:</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="texto" placeholder="Nombre">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label for="tipo_entidad" class="col-md-5 control-label">Tipo de entidad:</label>
										<div class="col-md-7">
											<select id="tipo_entidad" name="texto" data-live-search="true" data-width="100%" class="selectpicker">
												<option value="">Seleccionar tipo entidad</option>
												<option value="Cliente">Cliente</option>
												<option value="Proveedor">Proveedor</option>
											</select>
										</div>
									</div>

									<div class="form-group col-md-6">
										<label for="contactoDe" class="col-md-5 control-label">Contacto de:</label>
										<div class="col-md-7">
											<select id="contactoDe" name="texto" data-live-search="true" data-width="100%" class="selectpicker">
												<option value="">Seleccionar entidad</option>
											</select>
										</div>
									</div>

									<div class="form-group col-md-6">
										<label class="col-md-5 control-label">Teléfono:</label>
										<div class="col-md-7">
											<input type="texto" name="texto" class="form-control" placeholder="Teléfono">
										</div>
									</div>

									<div class="form-group col-md-6">
										<label class="col-md-5 control-label">E-mail:</label>
										<div class="col-md-7">
											<input type="text" name="email" class="form-control" placeholder="E-mail">
										</div>
									</div>

									<div class="form-group col-md-6">
										<label class="col-md-5 control-label">Cargo:</label>
										<div class="col-md-7">
											<input type="text" name="texto" class="form-control" placeholder="Cargo">
										</div>
									</div>

									<input type="text" name="helper" class="helper form-control" placeholder="">


									<div class="buttons-submit col-md-12">
										<div class="col-md-2 col-md-offset-4">
											<button id="btnGuardar" type="submit" class="btn btn-primary">Actualizar contacto</button>
										</div>
										<div class="col-md-2">
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