<?php

/**
 * This is the model class for table "Lenguaje".
 *
 * The followings are the available columns in table 'Lenguaje':
 * @property integer $idLenguaje
 * @property string $Lenguaje
 *
 * The followings are the available model relations:
 * @property Stub[] $stubs
 * @property Usuario[] $usuarios
 */
class Lenguaje extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lenguaje the static model class
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
		return 'Lenguaje';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Lenguaje', 'required'),
			array('Lenguaje', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idLenguaje, Lenguaje', 'safe', 'on'=>'search'),
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
			'stubs' => array(self::HAS_MANY, 'Stub', 'idLenguaje'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'idLenguaje'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idLenguaje' => 'Id Lenguaje',
			'Lenguaje' => 'Lenguaje',
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

		$criteria->compare('idLenguaje',$this->idLenguaje);
		$criteria->compare('Lenguaje',$this->Lenguaje,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}