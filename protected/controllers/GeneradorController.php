<?php

class GeneradorController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'roles' => array('Administrador'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        //suma
//            for ($index = 0; $index < 100; $index++) {
//                $x=  rand(-10000, 10000);
//                $y=  rand(-10000, 10000);
//                $solucion=new Solucion();
//                $solucion->ParametrosEntrada=$x.','.$y;
//                $solucion->Salida=$x+$y;
//                $solucion->idProblema=1;
//                if (!$solucion->insert()){
//                    throw new Exception('Error al insertar');
//                }
//            }
//max            
//             for ($index = 0; $index < 100; $index++) {
//                $x=  rand(-10000, 10000);
//                $y=  rand(-10000, 10000);
//                $solucion=new Solucion();
//                $solucion->ParametrosEntrada=$x.','.$y;
//                $solucion->Salida=  max(array($x,$y));
//                $solucion->idProblema=2;
//                if (!$solucion->insert()){
//                    throw new Exception('Error al insertar');
//                }
//            }
//corona circular
//Cuál es el área de una vereda en forma de corona circular, si el radio interior es r y el radio exterior R?
//            for ($index = 0; $index < 100; $index++) {
//                $x=  rand(1, 10000);
//                $y=  rand(1, 10000);
//                if($x>$y){
//                    $aux=$x;
//                    $x=$y;
//                    $y=$aux;
//                }
//                $solucion=new Solucion();
//                $solucion->ParametrosEntrada=$x.','.$y;
//                
//                $solucion->Salida=  round((pi()*$y*$y)-(pi()*$x*$x),2);
//              
        //suma de múltiplos
        /*for ($index = 0; $index < 100; $index++) {
            $x = rand(10, 10000);
            $solucion = new Solucion();
            $solucion->ParametrosEntrada = $x;

            $solucion->Salida = $this->sumaMultiplos($x);

            $solucion->idProblema = 5;
            if (!$solucion->insert()) {
                throw new Exception('Error al insertar');
            }
        }*/
        for ($index = 0; $index < 100; $index++) {
            $x=array();
            $suma=0;
            for($i=0;$i<5;$i++){
                $x[$i] = rand(-10000, 10000);
                $suma+=$x[$i];
            }
            $solucion = new Solucion();
            $solucion->ParametrosEntrada = implode(',', $x);

            $solucion->Salida = $suma;

            $solucion->idProblema = 9;
            if (!$solucion->insert()) {
                throw new Exception('Error al insertar');
            }
        }
        
        
        //echo '<br>'.$this->sumaDigitosFactorial(10);
        $this->render('index');
       
    }

    private function sumaMultiplos($numero) {
        $suma = 0;
        for ($index = 1; $index * 5 < $numero; $index++) {
            $suma+=$index * 5;
        }
        for ($index = 1; $index * 3 < $numero; $index++) {
            $suma+=$index * 3;
        }
        return $suma;
    }
    
    private function factorial($n){
        $resultado=1;
        for ($index = 2; $index <= $n; $index++) {
            $resultado=gmp_mul($resultado,$index);
        }
        return $resultado;
    }
    private function sumaDigitosFactorial($numero) {
        $suma = 0;
        $factorial=$this->factorial($numero);
        $str= gmp_strval($factorial);
        echo $str;
        //var_dump($str); exit();
        for ($index = 0; $index < strlen($str); $index++) {
             $digito=substr($str,$index,1);
             $suma+=$digito;
        }

        return $suma;
    }

// Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
