<?php

/**
 * This is the model class for table "proveedores".
 *
 * The followings are the available columns in table 'proveedores':
 * @property integer $id_proveedor
 * @property string $nombre
 * @property string $tipo_identi
 * @property string $num_id
 * @property string $ciudad
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Sims[] $sims
 * @property TipoDisp[] $tipoDisps
 */
class Proveedor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proveedores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, tipo_identi, num_id', 'required'),
			array('nombre, ciudad, direccion, email', 'length', 'max'=>45),
			array('tipo_identi', 'length', 'max'=>10),
			array('num_id', 'length', 'max'=>30),
			array('telefono', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_proveedor, nombre, tipo_identi, num_id, ciudad, direccion, telefono, email', 'safe', 'on'=>'search'),
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
			'sims' => array(self::HAS_MANY, 'Sims', 'id_proveedor'),
			'tipoDisps' => array(self::HAS_MANY, 'TipoDisp', 'id_proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_proveedor' => 'Id Proveedor',
			'nombre' => 'Nombre',
			'tipo_identi' => 'Tipo Identi',
			'num_id' => 'Num',
			'ciudad' => 'Ciudad',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'email' => 'Email',
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function getCreatingAttributes()
	{
		return array(
			'nombre',
			'tipo_identi',
			'num_id',
			'ciudad',
			'direccion',
			'telefono',
			'email',
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

		$criteria->compare('id_proveedor',$this->id_proveedor);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('tipo_identi',$this->tipo_identi,true);
		$criteria->compare('num_id',$this->num_id,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proveedor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
