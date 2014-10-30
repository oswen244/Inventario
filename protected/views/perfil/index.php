<script type="text/javascript">

	$(document).ready(function() {
		$('.helper').hide();
		var nombres = ["Nombre:", "Descripción:", "Tipo:"];
		var datos = <?php echo $perfiles; ?>;
		var atributos = ["Nombre","Descripcion"];
		var table= customDataTable('#perfilTable', datos, atributos, nombres);
		$('#btnEditar').unwrap();
		$('#btnEditar').removeClass();
		$('#btnEditar').addClass('btn btn-primary col-xs-4 col-xs-offset-4');
		$('#dialog').click(function() {
            borrar(table,'#myModal','#delete');
        });
        validar('#editarPerfil');
	});

</script>

<h1 class="header-tittle">Simcards</h1>

<div class="content">
	<?php $this->beginContent('//layouts/column1'); ?>

		<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/perfil/create">Registrar perfil</a></li>
	
	<?php $this->endContent(); ?>
	<div class="content-side">
		<input type="button" id="dialog" data-toggle="modal" class="btnActions btn btn-danger btn-sm" value="Eliminar">
		<table id="perfilTable" class="display responsive nowrap table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr class="busqueda">
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Nombre</th>
					<th>Descripción</th>
				</tr>
			</thead>

			<tbody>
				
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="modalEditLabel">Actualización de perfil</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<form id="editarPerfil" action="update" accept-charset="utf-8" class="form form-horizontal" role="form"><br>
								<div class="form-group col-md-12">
									<label class="col-md-3 control-label">Nombre del perfil:</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="texto" placeholder="Perfil">
									</div>
								</div>

								<div class="form-group col-md-12">
									<label class="col-md-3 control-label">Descripción del perfil:</label>
									<div class="col-md-8">
										<input type="textArea" class="form-control" name="comentario" placeholder="Descripción">
									</div>
								</div>
								<input type="text" name="helper" class="helper form-control">
								<div class="buttons-submit col-sm-12">
									<div class="col-sm-3 col-sm-offset-2">
										<button id="btnGuardar" data-dismiss="modal" type="submit" class="btn btn-primary">Actualizar perfil</button>
									</div>
									<div class="col-sm-2 col-sm-offset-2">
										<a href="" data-dismiss="modal" class="btn btn-success">Cancelar</a>
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