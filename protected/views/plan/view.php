<?php
/* @var $this PlanController */
/* @var $model Plan */

$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->id_plan,
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'Update Plan', 'url'=>array('update', 'id'=>$model->id_plan)),
	array('label'=>'Delete Plan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_plan),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>View Plan #<?php echo $model->id_plan; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_plan',
		'nombre_plan',
		'cargo_voz',
		'cargo_datos',
		'desc_p_voz',
		'desc_p_datos',
	),
)); ?>
