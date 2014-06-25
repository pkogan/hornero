<?php

/**
 * This is the model class for table "Torneo".
 *
 * The followings are the available columns in table 'Torneo':
 * @property integer $idTorneo
 * @property string $Nombre
 * @property string $Descripcion
 * @property string $FechaInicio
 * @property string $FechaFin
 * @property integer $idEstado
 * @property integer $idTipo
 *
 * The followings are the available model relations:
 * @property Resolucion[] $resolucions
 * @property TipoTorneo $idTipo0
 * @property EstadoTorneo $idEstado0
 * @property TorneoProblema[] $torneoProblemas
 * @property TorneoUsuario[] $torneoUsuarios
 * @property int $problemasCount
 */
class Torneo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Torneo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getCartelEstado(){
            switch ($this->idEstado) {
                case 3:
                    $cartel='Torneo Terminado';

                    break;
                case 1:
                    $cartel = 'Torneo no empezo todavía. Empieza el '.$this->FechaInicio;
                    break;
                case 2:
                    $cartel = 'Torneo en Proceso. Termina el '.$this->FechaFin;
                    break;

                default:
                    $cartel= 'Torneo Error';
                    break;
            }
            return $cartel;
        }
        public function getUsuarioInscripcion(){
             if (Yii::app()->user->isGuest){
                 return false;
             }
             
             $inscripcion=  TorneoUsuario::model()->find('idTorneo=:idTorneo and idUsuario=:idUsuario',array(':idTorneo'=>$this->idTorneo,':idUsuario'=>  Yii::app()->user->idUsuario));
             
             if (is_null($inscripcion)){
                 return false;
             }else{
                 return $inscripcion;
             }
             
        }

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Torneo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nombre, Descripcion, FechaInicio, FechaFin, idEstado, idTipo', 'required'),
			array('idEstado, idTipo', 'numerical', 'integerOnly'=>true),
			array('Nombre', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idTorneo, Nombre, Descripcion, FechaInicio, FechaFin, idEstado, idTipo', 'safe', 'on'=>'search'),
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
			'resolucions' => array(self::HAS_MANY, 'Resolucion', 'idTorneo'),
			'idTipo0' => array(self::BELONGS_TO, 'TipoTorneo', 'idTipo'),
			'idEstado0' => array(self::BELONGS_TO, 'EstadoTorneo', 'idEstado'),
			'torneoProblemas' => array(self::HAS_MANY, 'TorneoProblema', 'idTorneo'),
			'torneoUsuarios' => array(self::HAS_MANY, 'TorneoUsuario', 'idTorneo','order'=>'Puntos DESC, Tiempo'),
                        'problemasCount' => array(self::STAT, 'TorneoProblema', 'idTorneo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idTorneo' => 'Id Torneo',
			'Nombre' => 'Nombre',
			'Descripcion' => 'Descripcion',
			'FechaInicio' => 'Fecha Inicio',
			'FechaFin' => 'Fecha Fin',
			'idEstado' => 'Id Estado',
			'idTipo' => 'Id Tipo',
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

		$criteria->compare('idTorneo',$this->idTorneo);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('FechaInicio',$this->FechaInicio,true);
		$criteria->compare('FechaFin',$this->FechaFin,true);
		$criteria->compare('idEstado',$this->idEstado);
		$criteria->compare('idTipo',$this->idTipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}