<?php
/* @var $this TipoDispController */
/* @var $model TipoDisp */

$this->breadcrumbs=array(
	'Tipo Disps'=>array('index'),
	$model->id_tipo,
);

$this->menu=array(
	array('label'=>'List TipoDisp', 'url'=>array('index')),
	array('label'=>'Create TipoDisp', 'url'=>array('create')),
	array('label'=>'Update TipoDisp', 'url'=>array('update', 'id'=>$model->id_tipo)),
	array('label'=>'Delete TipoDisp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoDisp', 'url'=>array('admin')),
);
?>

<h1>View TipoDisp #<?php echo $model->id_tipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo',
		'tipo_ref',
		'descripcion',
		'id_proveedor',
		'pc_iva',
		'pc_siva',
		'pv_iva',
		'pv_siva',
		'nombre',
	),
)); ?>
