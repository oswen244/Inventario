<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-select.min.css" />
	<!-- Bootstrap -->

	<!-- Latest compiled and minified CSS -->
	<!-- Optional theme -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/dataTableEdit.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-select.min.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<div id="header">
	<nav class="nav-bar">
		<ul>
			<li><a href="#">LOGO</a></li>
			<li><a href="/inventario/dispositivo">Dispositivos</a></li>
			<li><a href="#">Simcard</a></li>
			<li><a href="/inventario/proveedor">Proveedores</a></li>
			<li><a href="/inventario/cliente">Clientes</a></li>
			<li><a href="/inventario/usuario">Usuarios</a></li>
			<li><a href="/inventario/site/logout">Desconectar</a></li>
		</ul>
	</nav><!-- mainmenu -->
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
