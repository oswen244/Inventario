<?php
/* @var $this DispositivoController */
/* @var $model Dispositivo */

$this->breadcrumbs=array(
	'Dispositivos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dispositivo', 'url'=>array('index')),
	array('label'=>'Manage Dispositivo', 'url'=>array('admin')),
);
?>

<h1>Create Dispositivo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>