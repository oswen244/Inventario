<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->id_plan=>array('view','id'=>$model->id_plan),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'View Plan', 'url'=>array('view', 'id'=>$model->id_plan)),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>Update Plan <?php echo $model->id_plan; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>