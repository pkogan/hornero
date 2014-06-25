<?php

/**
 * This is the model class for table "Problema".
 *
 * The followings are the available columns in table 'Problema':
 * @property integer $idProblema
 * @property integer $idTipo
 * @property string $Nombre
 * @property string $Archivo
 * @property string $Enunciado
 * @property integer $idComplejidad
 * @property double $TiempoEjecucionMax
 *
 * The followings are the available model relations:
 * @property Complejidad $idComplejidad0
 * @property TipoProblema $idTipo0
 * @property Resolucion[] $resolucions
 * @property Solucion[] $solucions
 * @property TorneoProblema[] $torneoProblemas
 * @property int $solucionCount
 */
class Problema extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Problema the static model class
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
		return 'Problema';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTipo, Nombre, Enunciado, idComplejidad, TiempoEjecucionMax', 'required'),
			array('idTipo, idComplejidad', 'numerical', 'integerOnly'=>true),
			array('TiempoEjecucionMax', 'numerical'),
			array('Nombre, Archivo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idProblema, idTipo, Nombre, Archivo, Enunciado, idComplejidad, TiempoEjecucionMax', 'safe', 'on'=>'search'),
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
			'idComplejidad0' => array(self::BELONGS_TO, 'Complejidad', 'idComplejidad'),
			'idTipo0' => array(self::BELONGS_TO, 'TipoProblema', 'idTipo'),
			'resolucions' => array(self::HAS_MANY, 'Resolucion', 'idProblema'),
			'solucions' => array(self::HAS_MANY, 'Solucion', 'idProblema'),
			'torneoProblemas' => array(self::HAS_MANY, 'TorneoProblema', 'idProblema'),
                        'solucionCount' => array(self::STAT, 'Solucion' , 'idProblema'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idProblema' => 'Id Problema',
			'idTipo' => 'Id Tipo',
			'Nombre' => 'Nombre',
			'Archivo' => 'Archivo',
			'Enunciado' => 'Enunciado',
			'idComplejidad' => 'Id Complejidad',
			'TiempoEjecucionMax' => 'Tiempo Ejecucion Max',
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

		$criteria->compare('idProblema',$this->idProblema);
		$criteria->compare('idTipo',$this->idTipo);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Archivo',$this->Archivo,true);
		$criteria->compare('Enunciado',$this->Enunciado,true);
		$criteria->compare('idComplejidad',$this->idComplejidad);
		$criteria->compare('TiempoEjecucionMax',$this->TiempoEjecucionMax);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}