<?php

class ProveedorController extends Controller
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Proveedor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
			parse_str($_POST['data'], $data);
			$dbNames = $model->getCreatingAttributes(); //Obtiene los atributos de la tabla

			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$elem = $atributos['nombre'].", ".$atributos['ciudad'].", ".$atributos['telefono'].", ".$atributos['email'];
			$accion = "CREADO";
			$sql = "CALL historico('".Yii::app()->user->name."','".$model->tableName()."','".$elem."','".$accion."')";
			try {
				$model->attributes=$atributos;
				Yii::app()->db->createCommand($sql)->query();				
				if($model->save()){
					$result['mensaje'] = "El proveedor se registró correctamente";
					$result['cod'] = "1";
				}else{
					$result['mensaje'] = "Error: No se pudo registrar el proveedor";
					$result['cod'] = "3";
				}
				echo json_encode($result);

			} catch (Exception $e) {
				$result['mensaje'] = $e->getMessage();
				$result['cod'] = "3";
			}

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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_proveedor));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		//se verifica si existen registros asociados antes de borrar

		$sql = "SELECT COUNT(id_contacto) AS total FROM contactos WHERE id_proveedor IN (".$_POST['data'].")";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$contactos = $result[0]['total'];

		$sql = "SELECT COUNT(id_sim) AS total FROM sims WHERE id_proveedor IN (".$_POST['data'].")";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$sims = $result[0]['total'];

		$sql = "SELECT COUNT(id_tipo) AS total FROM tipo_disp WHERE id_proveedor IN (".$_POST['data'].")";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$tipo = $result[0]['total'];

		//Si no existe ningun registro asociado, se procede al borrado
		if($contactos=="0" && $sims=="0" && $tipo=="0"){
			$sql = "DELETE FROM proveedores WHERE id_proveedor IN (".$_POST['data'].")";
			try {
				Yii::app()->db->createCommand($sql)->query();
				echo "1;El(los) registro(s) se ha(n) borrado";			
			} catch (Exception $e) {
				echo "3;Error";
			}
		}else{ //sino, se envia un mensaje advirtiendo que el registro tiene otros registros asoaciados
			echo "3;Error: existen dispositivos, sims y/o contactos asiciados con los proveerdores seleccionados.
			Borrar de todas formas?
			Advertencia: Se borrarán tambien los registros asociados.";
		}
	}

	public function actionDeleteCascade()
	{
			//se realiza el borrado en cascada de los registros seleccionados
			$sql = "DELETE FROM proveedores WHERE id_proveedor IN (".$_POST['data'].")";

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
		$model = Proveedor::model();
		$pr = $model->findAll();
		$proveedor = CJSON::encode($pr); 

		$this->render('index', array('proveedores' => $proveedor));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Proveedor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Proveedor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Proveedor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proveedor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
