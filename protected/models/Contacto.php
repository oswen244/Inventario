<?php

/**
 * This is the model class for table "contactos".
 *
 * The followings are the available columns in table 'contactos':
 * @property integer $id_contacto
 * @property string $nombre
 * @property string $telefono
 * @property string $tipo_entidad
 * @property string $cargo
 * @property string $email
 * @property integer $id_entidad
 *
 * The followings are the available model relations:
 * @property Clientes $idEntidad
 */
class Contacto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contactos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, tipo_entidad, email, id_entidad', 'required'),
			array('id_entidad', 'numerical', 'integerOnly'=>true),
			array('nombre, cargo, email', 'length', 'max'=>45),
			array('telefono', 'length', 'max'=>20),
			array('tipo_entidad', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_contacto, nombre, telefono, tipo_entidad, cargo, email, id_entidad', 'safe', 'on'=>'search'),
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
			'idEntidad' => array(self::BELONGS_TO, 'Clientes', 'id_entidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_contacto' => 'Id Contacto',
			'nombre' => 'Nombre',
			'telefono' => 'Telefono',
			'tipo_entidad' => 'Tipo Entidad',
			'cargo' => 'Cargo',
			'email' => 'Email',
			'id_entidad' => 'Id Entidad',
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function getCreatingAttributes()
	{
		return array(
			'nombre',
			'tipo_entidad',
			'id_entidad',
			'telefono',
			'email',
			'cargo',
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

		$criteria->compare('id_contacto',$this->id_contacto);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('tipo_entidad',$this->tipo_entidad,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_entidad',$this->id_entidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contacto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
