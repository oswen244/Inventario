<?php
/* @var $this TipoDispController */
/* @var $model TipoDisp */

$this->breadcrumbs=array(
	'Tipo Disps'=>array('index'),
	$model->id_tipo=>array('view','id'=>$model->id_tipo),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoDisp', 'url'=>array('index')),
	array('label'=>'Create TipoDisp', 'url'=>array('create')),
	array('label'=>'View TipoDisp', 'url'=>array('view', 'id'=>$model->id_tipo)),
	array('label'=>'Manage TipoDisp', 'url'=>array('admin')),
);
?>

<h1>Update TipoDisp <?php echo $model->id_tipo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>