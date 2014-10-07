<?php

/**
 * This is the model class for table "sims".
 *
 * The followings are the available columns in table 'sims':
 * @property integer $id_sim
 * @property string $f_act
 * @property string $num_linea
 * @property string $imei_sc
 * @property string $comentario
 * @property integer $id_cliente
 * @property integer $id_estados
 * @property integer $id_proveedor
 * @property integer $imei_disp
 * @property integer $tipo_plan
 *
 * The followings are the available model relations:
 * @property Planes[] $planes
 * @property Estados $idEstados
 * @property Proveedores $idProveedor
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
			array('f_act, num_linea, imei_sc, id_cliente, id_estados, id_proveedor, imei_disp', 'required'),
			array('id_cliente, id_estados, id_proveedor, imei_disp, tipo_plan', 'numerical', 'integerOnly'=>true),
			array('num_linea', 'length', 'max'=>12),
			array('imei_sc', 'length', 'max'=>30),
			array('comentario', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sim, f_act, num_linea, imei_sc, comentario, id_cliente, id_estados, id_proveedor, imei_disp, tipo_plan', 'safe', 'on'=>'search'),
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
			'planes' => array(self::HAS_MANY, 'Planes', 'id_sim'),
			'idEstados' => array(self::BELONGS_TO, 'Estados', 'id_estados'),
			'idProveedor' => array(self::BELONGS_TO, 'Proveedores', 'id_proveedor'),
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
			'comentario' => 'Comentario',
			'id_cliente' => 'Id Cliente',
			'id_estados' => 'Id Estados',
			'id_proveedor' => 'Id Proveedor',
			'imei_disp' => 'Imei Disp',
			'tipo_plan' => 'Tipo Plan',
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
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('id_cliente',$this->id_cliente);
		$criteria->compare('id_estados',$this->id_estados);
		$criteria->compare('id_proveedor',$this->id_proveedor);
		$criteria->compare('imei_disp',$this->imei_disp);
		$criteria->compare('tipo_plan',$this->tipo_plan);

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
