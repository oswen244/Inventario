<?php
/* @var $this UsuarioController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id_usuario=>array('view','id'=>$model->id_usuario),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id_usuario)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User <?php echo $model->id_usuario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>