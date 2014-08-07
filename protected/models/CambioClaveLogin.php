<?php

/**
 * This is the model class for table "Usuario".
 *
 * The followings are the available columns in table 'Usuario':
 * @property integer $idUsuario
 * @property string $NombreUsuario
 * @property string $Clave
 * @property integer $idRol
 * @property string $Email
 * @property integer $idLenguaje
 *
 * The followings are the available model relations:
 * @property Resolucion[] $resolucions
 * @property TorneoUsuario[] $torneoUsuarios
 * @property Lenguaje $idLenguaje0
 * @property Rol $idRol0
 */
class CambioClaveLogin extends Usuario {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Usuario the static model class
     */
    public $ReClave;
    public $ClaveActual;
    public $IniClave;
    
    

    
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $rules=  parent::rules();
        $rules[]=array('Clave, ReClave, ClaveActual', 'required', 'on'=>'update');
        $rules[]=array('ClaveActual', 'compare', 'compareAttribute' => 'IniClave');
        $rules[]=array('ReClave', 'compare', 'compareAttribute' => 'Clave');
        return $rules;
    }

    public function beforeSave() {
        // in this case, we will use the old hashed password.
        if (empty($this->Clave) && empty($this->ReClave) && !empty($this->IniClave))
            $this->Clave = $this->ReClave = $this->IniClave;

        return true;//parent::beforeSave();
    }

    public function afterFind() {
        //reset the Clave to null because we don't want the hash to be shown.
        $this->IniClave = $this->Clave;
        $this->Clave = null;

        parent::afterFind();
    }



    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'resolucions' => array(self::HAS_MANY, 'Resolucion', 'idUsuario'),
            'torneoUsuarios' => array(self::HAS_MANY, 'TorneoUsuario', 'idUsuario'),
            'idLenguaje0' => array(self::BELONGS_TO, 'Lenguaje', 'idLenguaje'),
            'idRol0' => array(self::BELONGS_TO, 'Rol', 'idRol'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        $labels=  parent::attributeLabels();
        $labels['ReClave'] = 'Reingrese la Clave';
        return $labels;
    }



}
