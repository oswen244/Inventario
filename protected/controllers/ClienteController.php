<?php

class ClienteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','deleteCascade'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$sql = "SELECT nombre,tipo_identi,num_id,ciudad,direccion,telefono,email,id_cliente FROM clientes WHERE id_cliente = ".$_POST['id'];
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($result);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cliente;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
			parse_str($_POST['data'], $data);

			$dbNames = $model->getCreatingAttributes(); //Obtiene los atributos de la tabla

			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values

			$model->attributes=$atributos;
			if($model->save()){
				$result['mensaje'] = "El cliente se registró correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo registrar el cliente";
				$result['cod'] = "3";
			}
			echo json_encode($result);
			
		}else{

			$this->render('create',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		if(Yii::app()->request->isPostRequest){

			parse_str($_POST['data'], $data);

			$criteria = new CDbCriteria();
			$criteria->condition = 'id_cliente=:id_cliente';
			$criteria->params = array(':id_cliente'=>$data[7]);
			$cliente = Cliente::model()->find($criteria);
			$dbNames = $cliente->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			
			unset($data[7]);
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$cliente->attributes=$atributos; //se asignan los atributos al modelo
			if($cliente->save()){
				$result['mensaje'] = "El cliente se actualizó correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo actualizar el cliente";
				$result['cod'] = "3";
			}
			echo json_encode($result);
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		//preguntar cuales clientes se pueden borrar TODO
		
		
			$sql = "DELETE FROM clientes WHERE id_cliente IN (".$_POST['data'].")";
			try {
				Yii::app()->db->createCommand($sql)->query();
				echo "1;El(los) registro(s) se ha(n) borrado";			
			} catch (Exception $e) {
				echo "3;Error: existen contactos y/o facturas asociados con los clientes seleccionados.
						¿Borrar de todas formas?";
			}
		
	}

	public function actionDeleteCascade()
	{
			//se realiza el borrado en cascada de los registros seleccionados
			$sql = "UPDATE clientes SET borrado=1 WHERE id_cliente IN (".$_POST['data'].")";

			try {
				Yii::app()->db->createCommand($sql)->query();
				echo "1;El(los) registro(s) se ha(n) borrado";			
			} catch (Exception $e) {
				// echo "3,Error: existen activos asociados con ese estado";
				echo "3;".$e->getMessage();
			}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// $model = Cliente::model();
		// $cl = $model->findAll();

		$sql = "CALL consulta('*','clientes','borrado','0')";
		$cl = Yii::app()->db->createCommand($sql)->queryAll();
		$cliente = CJSON::encode($cl); 


		$this->render('index', array('clientes' => $cliente));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cliente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cliente']))
			$model->attributes=$_GET['Cliente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cliente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cliente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cliente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cliente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
