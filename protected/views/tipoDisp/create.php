<?php
/* @var $this TipoDispController */
/* @var $model TipoDisp */

$this->breadcrumbs=array(
	'Tipo Disps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoDisp', 'url'=>array('index')),
	array('label'=>'Manage TipoDisp', 'url'=>array('admin')),
);
?>

<h1>Create TipoDisp</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>