<?php

class PerfilController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
		if(Yii::app()->request->isPostRequest){
			$sql = "SELECT name, description, name Id FROM authitem WHERE name = '".$_POST['id']."'";
			$result = CJSON::encode(Yii::app()->db->createCommand($sql)->queryAll());
			echo $result;
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
	public function actionCreate()
	{
		// Yii::app()->authManager->createRole("admin");
		// Yii::app()->authManager->assign("admin",Yii::app()->user->id);
		// Yii::app()->authManager->assign("admin",id del usuario);
		// Yii::app()->authManager->revoke("admin",id del usuario);
		// if(Yii::app()->user->checkAccess("admin"))
		// if(Yii::app()->authManager->checkAccess("admin", id del usuario))
		// 												Yii::app()->user->id
		if(Yii::app()->request->isPostRequest){
			parse_str($_POST['data'], $data);
			try{
				Yii::app()->authManager->createRole($data[0],$data[1]);
				$result['mensaje'] = "El perfil se registró correctamente";
				$result['cod'] = "1";
			}catch (Exception $e) {
				$result['mensaje'] = "No se pudo registrar el perfil, intente nuevamente, asegúrese que el perfil que intenta crear no exista";
				$result['cod'] = "3";
			}
			echo json_encode($result);
		}else{
			$this->render('create');
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
			try{
				$sql = "UPDATE authitem SET name = '".$data[0]."', description = '".$data[1]."' WHERE name = '".$data[2]."'";
				$result = CJSON::encode(Yii::app()->db->createCommand($sql)->execute());
				$r['mensaje'] = "El perfil se actualizó correctamente";
				$r['cod'] = "1";
			}catch (Exception $e) {
				$r['mensaje'] = "No se pudo actualizar el perfil || ".$e->getMessage();
				$r['cod'] = "3";
			}
			echo json_encode($r);
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// print_r(Yii::app()->authManager->getAuthItems(2));
		// print_r(Yii::app()->authManager->getRoles());
		// $datos = [];
		// foreach (Yii::app()->authManager->getRoles() as $value) {
		// $model = new Perfil('search');
		// $model->unsetAttributes();
		// print_r($model->search());
		$connection = Yii::app()->db;
		$sql = "SELECT name, name Nombre, description Descripcion, type FROM authitem";
		$result = CJSON::encode($connection->createCommand($sql)->queryAll());
		// }
		// print_r(CJSON::encode(Yii::app()->authManager->getRoles()));
		$this->render('index', array(
			'perfiles' => $result,)
		);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Perfil('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Perfil']))
			$model->attributes=$_GET['Perfil'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Perfil the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Perfil::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Perfil $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='perfil-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
