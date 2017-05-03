<?php

/**
 * This is the model class for table "TorneoProblema".
 *
 * The followings are the available columns in table 'TorneoProblema':
 * @property integer $idTorneoProblema
 * @property integer $idProblema
 * @property integer $idTorneo
 * @property integer $Orden
 *
 * The followings are the available model relations:
 * @property Torneo $idTorneo0
 * @property Problema $idProblema0
 */
class TorneoProblema extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TorneoProblema the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 
     * @param int $idUsuario
     * @return idProblema
     */
    public function getNoResuelto($idUsuario) {
        $resolucion = array();
        // $clasificacionPalabras= Resolucion::model()->findAll('idTorneo=:idTorneo and idProblema=:idProblema and idEstado=2', array(':idTorneo'=>  $this->idTorneo,':idProblema'=>  $this->idProblema));


        $row = Yii::app()->db->createCommand()
                ->select('t.orden, t.idProblema')
                ->from('TorneoProblema t')
                ->leftJoin('Resolucion r', 't.idTorneo=r.idTorneo and t.idProblema=r.idProblema and r.idEstado=2 and r.idUsuario=:idUsuario', array(':idUsuario' => $idUsuario))
                ->where('t.idTorneo=:id and r.idResolucion is NULL', array(':id' => $this->idTorneo))
                ->limit('1')
                ->order('orden')
                ->queryRow();



        //print_r($proximoProblema);exit;
        if (!is_null($row)) {
            $proximoProblema = $row['idProblema'];
        } else {
            $proximoProblema = NULL;
        }
        return $proximoProblema;
    }

    public function getResuelto() {
        $resolucion = array();
        // $clasificacionPalabras= Resolucion::model()->findAll('idTorneo=:idTorneo and idProblema=:idProblema and idEstado=2', array(':idTorneo'=>  $this->idTorneo,':idProblema'=>  $this->idProblema));


        $clasificacionPalabras = Yii::app()->db->createCommand()
                ->select('t.idUsuario,u.NombreUsuario,min(FechaSolicitud) as FechaSolicitud,FechaRespuesta ')
                ->from('Resolucion t')
                ->join('Usuario u', 't.idUsuario=u.idUsuario')
                ->where('idTorneo=:id and idProblema=:idProblema and idEstado=2', array(':id' => $this->idTorneo, ':idProblema' => $this->idProblema))
                ->group('t.idUsuario')
                ->order('FechaSolicitud')
                ->queryAll();



        //print_r($clasificacionPalabras);exit;

        foreach ($clasificacionPalabras as $key => $value) {
            /* @var $value ClasificacionPalabra */
            // $resolucion[]=$value->idUsuario0->NombreUsuario.'('.$value->FechaSolicitud.','.($value->FechaRespuesta-$value->FechaSolicitud).')';
            $resolucion[] = $value['NombreUsuario']; //.'('.$value['FechaSolicitud'].','.($value['FechaRespuesta']-$value['FechaSolicitud']).')';
        }
        return implode(', ', $resolucion);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'TorneoProblema';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idProblema, idTorneo, Orden', 'required'),
            array('idProblema, idTorneo, Orden', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idTorneoProblema, idProblema, idTorneo, Orden', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idTorneo0' => array(self::BELONGS_TO, 'Torneo', 'idTorneo'),
            'idProblema0' => array(self::BELONGS_TO, 'Problema', 'idProblema'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idTorneoProblema' => 'Id Torneo Problema',
            'idProblema' => 'Id Problema',
            'idTorneo' => 'Id Torneo',
            'Orden' => 'Orden',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idTorneoProblema', $this->idTorneoProblema);
        $criteria->compare('idProblema', $this->idProblema);
        $criteria->compare('idTorneo', $this->idTorneo);
        $criteria->compare('Orden', $this->Orden);
        $criteria->order = 'Orden';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
