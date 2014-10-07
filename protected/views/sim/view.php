<?php
/* @var $this SimController */
/* @var $model Sim */

$this->breadcrumbs=array(
	'Sims'=>array('index'),
	$model->id_sim,
);

$this->menu=array(
	array('label'=>'List Sim', 'url'=>array('index')),
	array('label'=>'Create Sim', 'url'=>array('create')),
	array('label'=>'Update Sim', 'url'=>array('update', 'id'=>$model->id_sim)),
	array('label'=>'Delete Sim', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_sim),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sim', 'url'=>array('admin')),
);
?>

<h1>View Sim #<?php echo $model->id_sim; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_sim',
		'f_act',
		'num_linea',
		'imei_sc',
		'comentario',
		'id_cliente',
		'id_estados',
		'id_proveedor',
		'imei_disp',
		'tipo_plan',
	),
)); ?>
