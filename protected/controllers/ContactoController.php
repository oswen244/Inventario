<?php

class ContactoController extends Controller
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
				'actions'=>array('create','update','getClients','getProveedores'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new Contacto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
			$data = str_replace('+', ' ', $_POST['data']);
			$data = str_replace('%40', '@', $data);
			$values = preg_split("/[&]?([a-zA-Z0-9\._\-@])+[=]{1}/", $data, null, PREG_SPLIT_NO_EMPTY);
			$dbNames = $model->getCreatingAttributes(); //Obtiene los atributos de la tabla
			
			$atributos = array_combine($dbNames, $values); //se forma un nuevo array con las keys de dbNames y los valores de values
			
			if($atributos['tipo_entidad']=="Proveedor") //Pregunta si el contacto es de cliente o proveedor
				$model->attributes->id_cliente = '';
			else
				$model->attributes->id_proveedor = '';
			$model->attributes=$atributos;

			if($model->save()){ //se guardan los datos en la bd
				echo "El contacto se registró correctamente";
			}else{
				echo "Error";
			}
		}else{
			$this->render('create');
		}
	}


	public function actionGetClients(){
		if(Yii::app()->request->isPostRequest){
			$connection = Yii::app()->db;
			$sql = "SELECT id_cliente, nombre FROM clientes";
			$command=$connection->createCommand($sql);
			$result=$command->queryAll();
			echo CJSON::encode($result);
		}else{
			echo "nada!";
		}
	}

	public function actionGetProveedores(){
		if(Yii::app()->request->isPostRequest){
			$connection = Yii::app()->db;
			$sql = "SELECT id_proveedor, nombre FROM proveedores";
			$command=$connection->createCommand($sql);
			$result=$command->queryAll();
			echo CJSON::encode($result);
		}else{
			echo "nada!";
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

		if(isset($_POST['Contacto']))
		{
			$model->attributes=$_POST['Contacto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_contacto));
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
		//validar cuales sims se pueden borrar
		$sql = "DELETE FROM contactos WHERE id_contacto IN (".$_POST['data'].")";
		if(Yii::app()->db->createCommand($sql)->query())
			echo "1";
		else
			echo "2";
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = Contacto::model();
		$con = $model->findAll();
		$contacto = CJSON::encode($con); 

		$this->render('index', array('contactos' => $contacto));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contacto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contacto']))
			$model->attributes=$_GET['Contacto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contacto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contacto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contacto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contacto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
