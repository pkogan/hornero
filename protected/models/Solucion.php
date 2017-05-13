<?php

/**
 * This is the model class for table "Solucion".
 *
 * The followings are the available columns in table 'Solucion':
 * @property integer $idSolucion
 * @property integer $idProblema
 * @property string $ParametrosEntrada
 * @property string $Salida
 *
 * The followings are the available model relations:
 * @property Resolucion[] $resolucions
 * @property Problema $idProblema0
 */
class Solucion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Solucion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        /**
         * retorna un array de 4 o menos opciones de soluciones del problema
         */
        public function getOpciones(){
        
            $opciones=array();
            $opciones[]=$this->Salida;
            $soluciones= $this->idProblema0->solucions;
            $cantSoluciones=count($soluciones);
            foreach ($soluciones as $value) {
                $opciones[]=$value->Salida;
            }
            $opciones=array_unique($opciones);
            
            shuffle($opciones);
            $opciones=array_slice($opciones, 0,3);
            $opciones[]=$this->Salida;
            $opciones=array_unique($opciones);
            shuffle($opciones);

            return $opciones;
        
        } 
            
        
    
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Solucion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProblema, ParametrosEntrada, Salida', 'required'),
			array('idSolucion, idProblema', 'numerical', 'integerOnly'=>true),
			array('ParametrosEntrada, Salida', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSolucion, idProblema, ParametrosEntrada, Salida', 'safe', 'on'=>'search'),
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
			'resolucions' => array(self::HAS_MANY, 'Resolucion', 'idSolucion'),
			'idProblema0' => array(self::BELONGS_TO, 'Problema', 'idProblema'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idSolucion' => 'Id Solucion',
			'idProblema' => 'Id Problema',
			'ParametrosEntrada' => 'Parametros Entrada',
			'Salida' => 'Salida',
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

		$criteria->compare('idSolucion',$this->idSolucion);
		$criteria->compare('idProblema',$this->idProblema);
		$criteria->compare('ParametrosEntrada',$this->ParametrosEntrada,true);
		$criteria->compare('Salida',$this->Salida,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}