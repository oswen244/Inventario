<?php
/* @var $this DispositivoController */
/* @var $model Dispositivo */

$this->breadcrumbs=array(
	'Dispositivos'=>array('index'),
	$model->id_disp=>array('view','id'=>$model->id_disp),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dispositivo', 'url'=>array('index')),
	array('label'=>'Create Dispositivo', 'url'=>array('create')),
	array('label'=>'View Dispositivo', 'url'=>array('view', 'id'=>$model->id_disp)),
	array('label'=>'Manage Dispositivo', 'url'=>array('admin')),
);
?>

<h1>Update Dispositivo <?php echo $model->id_disp; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>