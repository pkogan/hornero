<?php

/**
 * This is the model class for table "Stub".
 *
 * The followings are the available columns in table 'Stub':
 * @property integer $idStubs
 * @property integer $idLenguaje
 * @property string $Descripcion
 * @property string $Archivo
 *
 * The followings are the available model relations:
 * @property Lenguaje $idLenguaje0
 */
class Stub extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stub the static model class
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
		return 'Stub';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idLenguaje, Descripcion, Archivo', 'required'),
			array('idLenguaje', 'numerical', 'integerOnly'=>true),
			array('Archivo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idStubs, idLenguaje, Descripcion, Archivo', 'safe', 'on'=>'search'),
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
			'idLenguaje0' => array(self::BELONGS_TO, 'Lenguaje', 'idLenguaje'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idStubs' => 'Id Stubs',
			'idLenguaje' => 'Id Lenguaje',
			'Descripcion' => 'Descripcion',
			'Archivo' => 'Archivo',
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

		$criteria->compare('idStubs',$this->idStubs);
		$criteria->compare('idLenguaje',$this->idLenguaje);
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('Archivo',$this->Archivo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}