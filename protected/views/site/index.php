<div class="row">
	<div class="col-md-6 col-md-offset-3 ">
		<div class="panel panel-success">
			<div class="panel-heading">
		   		<h3 class="panel-title">Ingresar</h3>
		  	</div>
			<div class="panel-body">
			   	<form method="post" action="login" role="form" class="form form-horizontal">
					<div class="form-group">
                        <label class="text-left control-label col-md-3" for="">Usuario</label>
                        <div class="col-md-9">
						     <input type="text" name="username" placeholder="Usuario" class="form-control" required>
                        </div>
					</div>
					<div class="form-group">
                        <label class="text-left control-label col-md-3" for="">Contraseña</label>
                        <div class="col-md-9">
                                <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
                        </div>
				    </div>
				    <div class="form-group">
                        <div class="checkbox col-md-10 col-md-offset-1">
							<label>
				            	<input type="checkbox" name="rememberMe" value="remember-me"> Recordarme?
				        	</label>
				        </div>
					</div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
				        	<input type="submit" class="btn btn-lg btn-primary" value="Ingresar">
				        </div>
	                </div>
			   	</form>
			</div>
		</div>
	</div>
</div>
