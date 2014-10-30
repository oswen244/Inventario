<?php

class UsuarioController extends Controller
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
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny', // deny all users
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
		// $model = User::model();
		// $us = $model->findAll();
		// $user = CJSON::encode($us);

		// echo $user;
		$sql = "SELECT u.nombre, u.usuario, r.itemname, u.id_usuario FROM usuarios u, authassignment r WHERE u.id_usuario = r.userid AND id_usuario=".$_POST['id'];
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($result);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
			parse_str($_POST['data'], $data);
			$data[3] = sha1($data[3]);
			$dbNames = $model->getCreatingAttributes();

			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values

			$model->attributes=$atributos;
			if($model->save()){
				$r=Yii::app()->db->createCommand("SELECT LAST_INSERT_ID() Id")->queryAll();
				$id = $r[0]['Id'];
				Yii::app()->authManager->assign($data[2],$id);
				$result['mensaje'] = "El usuario se registró correctamente";
				$result['cod'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo registrar el usuario";
				$result['cod'] = "3";
			}
			echo json_encode($result);
			
		}else{

			$this->render('create',array(
				'perfiles'=>Yii::app()->authManager->getAuthItems(2),
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
			$criteria->condition = 'id_usuario=:id_usuario';
			$criteria->params = array(':id_usuario'=>$data[3]);
			$usuario = User::model()->find($criteria);
			$dbNames = $usuario->getCreatingAttributes(); //Obtiene solo los atributos para crear de la tabla
			$role = $usuario->rol;
			unset($data[3]);
			unset($dbNames[3]);
			
			$atributos = array_combine($dbNames, $data); //se forma un nuevo array con las keys de dbNames y los valores de values
			$usuario->attributes=$atributos; //se asignan los atributos al modelo
			if($usuario->save()){
				$r=Yii::app()->db->createCommand("SELECT a.itemname role FROM authassignment a, authitem i WHERE i.type = 2 AND i.name = a.itemname AND a.userid = ".$usuario->id_usuario)->queryAll();
				Yii::app()->authManager->revoke($r[0]['role'], $usuario->id_usuario);
				Yii::app()->authManager->assign($data[2], $usuario->id_usuario);
				$result['mensaje'] = "El usuario se actualizó correctamente";
				$result['cod'] = "1";
				$result['reload'] = "1";
			}else{
				$result['mensaje'] = "Error: No se pudo actualizar el usuario";
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
		$model = new User;

		$sql = "DELETE FROM usuarios WHERE id_usuario IN (".$_POST['data'].") AND id_usuario<>1";
		try {

				Yii::app()->db->createCommand($sql)->query();
				echo "1; El(los) usuario(s) ha(n) sido borrado(s)";

		} catch (Exception $e) {
			echo "3; Error: No se pueden borrar los usuarios seleccionados";
		}
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// $model = User::model();
		// $result = $model->findAll();
		$sql = "SELECT u.id_usuario,u.usuario,u.nombre,r.itemname perfil FROM usuarios u, authassignment r WHERE u.id_usuario = r.userid";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		$user = CJSON::encode($result);

		$this->render('index', array('users' => $user, 'perfiles'=>Yii::app()->authManager->getAuthItems(2)));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
