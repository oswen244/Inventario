<h1 class="header-tittle">Dispositivos</h1>
<div class="col-xs-10 col-xs-offset-1">
	<form class="form form-horizontal" action="create" method="post" role="form"><br>
		<div class="form-group col-xs-6">
			<label for="dateAdq" class="col-xs-5 control-label">Fecha de adquisición:</label>
			<div class="col-xs-7">
				<input type="date" class="form-control" name="dateAdq" placeholder="dd/mm/aaaa">
			</div>
		</div>
		<div class="form-group col-xs-6">
			<label class="col-xs-5 control-label">Referencia:</label>
			<div class="col-xs-7">
				<input type="text" name="referencia" class="form-control" placeholder="Referencia">
			</div>
		</div>
		<div class="form-group col-xs-6">
			<label class="col-xs-5 control-label">IMEI o referencia:</label>
			<div class="col-xs-7">
				<input type="text" name="imei" class="form-control" placeholder="IMEI o referencia">
			</div>
		</div>
		<div class="form-group col-xs-6">
			<label class="col-xs-5 control-label">Estado:</label>
			<div class="col-xs-7">
				<input type="list" name="estado" class="form-control" placeholder="Seleccionar estado">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-offset-2 col-xs-10">
				<button type="submit" class="btn btn-default">Sign in</button>
			</div>
		</div>
	</form>
</div>