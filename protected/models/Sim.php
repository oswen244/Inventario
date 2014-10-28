<?php

/**
 * This is the model class for table "sims".
 *
 * The followings are the available columns in table 'sims':
 * @property integer $id_sim
 * @property string $f_act
 * @property string $num_linea
 * @property string $imei_sc
 * @property string $tipo_plan
 * @property string $comentario
 * @property integer $id_estado
 * @property integer $id_proveedor
 * @property integer $id_plan
 * @property string $imei_disp
 * @property string $f_asig
 *
 * The followings are the available model relations:
 * @property Estados $idEstado
 * @property Proveedores $idProveedor
 * @property Planes $idPlan
 * @property Dispositivos $imeiDisp
 */
class Sim extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sims';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_act, num_linea, imei_sc, tipo_plan, id_estado, id_proveedor, id_plan', 'required'),
			array('id_estado, id_proveedor, id_plan', 'numerical', 'integerOnly'=>true),
			array('num_linea', 'length', 'max'=>12),
			array('imei_sc', 'length', 'max'=>30),
			array('tipo_plan', 'length', 'max'=>15),
			array('comentario', 'length', 'max'=>1000),
			array('imei_disp', 'length', 'max'=>25),
			array('f_asig', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sim, f_act, num_linea, imei_sc, tipo_plan, comentario, id_estado, id_proveedor, id_plan, imei_disp, f_asig', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idEstado' => array(self::BELONGS_TO, 'Estados', 'id_estado'),
			'idProveedor' => array(self::BELONGS_TO, 'Proveedores', 'id_proveedor'),
			'idPlan' => array(self::BELONGS_TO, 'Planes', 'id_plan'),
			'imeiDisp' => array(self::BELONGS_TO, 'Dispositivos', 'imei_disp'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sim' => 'Id Sim',
			'f_act' => 'F Act',
			'num_linea' => 'Num Linea',
			'imei_sc' => 'Imei Sc',
			'tipo_plan' => 'Tipo Plan',
			'comentario' => 'Comentario',
			'id_estado' => 'Id Estado',
			'id_proveedor' => 'Id Proveedor',
			'id_plan' => 'Id Plan',
			'imei_disp' => 'Imei Disp',
			'f_asig' => 'F Asig',
		);
	}
	/**
	 * @return array customized attributes
	 */
	public function getCreatingAttributes()
	{
		return array(
			'imei_sc',
			'f_act',
			'num_linea',
			'id_plan',
			'id_estado',
			'id_proveedor',
			'comentario',
		);
	}

	public function getUpdatingAttributes()
	{
		return array(
			'imei_sc',
			'f_act',
			'f_asig',
			'num_linea',
			'id_plan',
			'id_estado',
			'id_proveedor',
			'comentario',
		);
	}



	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_sim',$this->id_sim);
		$criteria->compare('f_act',$this->f_act,true);
		$criteria->compare('num_linea',$this->num_linea,true);
		$criteria->compare('imei_sc',$this->imei_sc,true);
		$criteria->compare('tipo_plan',$this->tipo_plan,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('id_estado',$this->id_estado);
		$criteria->compare('id_proveedor',$this->id_proveedor);
		$criteria->compare('id_plan',$this->id_plan);
		$criteria->compare('imei_disp',$this->imei_disp,true);
		$criteria->compare('f_asig',$this->f_asig,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sim the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
