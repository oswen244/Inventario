<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /> -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-theme.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrapValidator.min.css"/>
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-select.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">
	<!-- Bootstrap -->

	<!-- Latest compiled and minified CSS -->
	<!-- Optional theme -->
	<!-- Latest compiled and minified JavaScript -->
	<!--<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>-->
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/dataTableEdit.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-filestyle.min.js"></script>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<div id="header">
		<nav class="navbar nav-bar" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="boton navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span><strong></strong></span>						
					</button>
					<a id="logo" class="navbar-brand" href="/inventario">LOGO</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="/inventario/dispositivo">Dispositivos</a></li>
						<li><a href="/inventario/sim">Simcard</a></li>
						<li><a href="/inventario/proveedor">Proveedores</a></li>
						<li><a href="/inventario/cliente">Clientes</a></li>
						<li><a href="/inventario/usuario">Usuarios</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Otras opciones <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/inventario/plan">Planes</a></li>
								<li><a href="/inventario/contacto">Contactos</a></li>
								<li><a href="/inventario/estado">Estados</a></li>
							</ul>
						</li>
						<li><a href="/inventario/site/logout">Desconectar</a></li>
					</ul>
					
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</div><!-- header -->
<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Elecsis.<br/>
		All Rights Reserved.
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
