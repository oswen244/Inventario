<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	'Estados'=>array('index'),
	$model->id_estados=>array('view','id'=>$model->id_estados),
	'Update',
);

$this->menu=array(
	array('label'=>'List Estado', 'url'=>array('index')),
	array('label'=>'Create Estado', 'url'=>array('create')),
	array('label'=>'View Estado', 'url'=>array('view', 'id'=>$model->id_estados)),
	array('label'=>'Manage Estado', 'url'=>array('admin')),
);
?>

<h1>Update Estado <?php echo $model->id_estados; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>