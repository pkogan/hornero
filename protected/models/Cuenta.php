<?php

/**
 * This is the model class for table "Cuenta".
 *
 * The followings are the available columns in table 'Cuenta':
 * @property integer $id
 * @property integer $idTorneo
 * @property string $Nombre
 * @property string $Archivo
 * @property string $Inicio
 * @property string $Fin
 * @property integer $Tiempo
 *
 * The followings are the available model relations:
 * @property Parcial[] $parcials
 */
class Cuenta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cuenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Cuenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nombre, Tiempo', 'required'),
			array('idTorneo, Tiempo', 'numerical', 'integerOnly'=>true),
			array('Archivo', 'length', 'max'=>255),
			array('Inicio, Fin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idTorneo, Nombre, Archivo, Inicio, Fin, Tiempo', 'safe', 'on'=>'search'),
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
			'parcials' => array(self::HAS_MANY, 'Parcial', 'idCuenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTorneo' => 'Id Torneo',
			'Nombre' => 'Nombre',
			'Archivo' => 'Archivo',
			'Inicio' => 'Inicio',
			'Fin' => 'Fin',
			'Tiempo' => 'Tiempo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idTorneo',$this->idTorneo);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Archivo',$this->Archivo,true);
		$criteria->compare('Inicio',$this->Inicio,true);
		$criteria->compare('Fin',$this->Fin,true);
		$criteria->compare('Tiempo',$this->Tiempo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}