<?php
/* @var $this SimController */
/* @var $model Sim */

$this->breadcrumbs=array(
	'Sims'=>array('index'),
	$model->id_sim=>array('view','id'=>$model->id_sim),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sim', 'url'=>array('index')),
	array('label'=>'Create Sim', 'url'=>array('create')),
	array('label'=>'View Sim', 'url'=>array('view', 'id'=>$model->id_sim)),
	array('label'=>'Manage Sim', 'url'=>array('admin')),
);
?>

<h1>Update Sim <?php echo $model->id_sim; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>