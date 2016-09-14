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
 
echo 'aaaaaaaaaa';

        for ($x1 = 1;$x1<=498; $x1++) {
	  $Solution=$this->to_roman($x1);
	  echo " $x1--$Solution";
	  
              $solucion = new Solucion();
	      $solucion->ParametrosEntrada=$x1;
	      $solucion->Salida=$Solution;
	      $solucion->idProblema=58;
	      if (!$solucion->insert()) {
			      throw new Exception('Error al insertar');
			  }
           
        


        //echo '<br>'.$this->sumaDigitosFactorial(10);
        
      }
    $this->render('index');
    }
    
    
public function to_roman($num) {
    if ($num < 0 || $num > 9999) {
        return -1;
    }
    $r_ones = array(1 => "I", 2 => "II", 3 => "III", 4 => "IV", 5 => "V", 6 => "VI", 7 => "VII", 8 => "VIII",
        9 => "IX");
    $r_tens = array(1 => "X", 2 => "XX", 3 => "XXX", 4 => "XL", 5 => "L", 6 => "LX", 7 => "LXX",
        8 => "LXXX", 9 => "XC");
    $r_hund = array(1 => "C", 2 => "CC", 3 => "CCC", 4 => "CD", 5 => "D", 6 => "DC", 7 => "DCC",
        8 => "DCCC", 9 => "CM");
    $r_thou = array(1 => "M", 2 => "MM", 3 => "MMM", 4 => "MMMM", 5 => "MMMMM", 6 => "MMMMMM",
        7 => "MMMMMMM", 8 => "MMMMMMMM", 9 => "MMMMMMMMM");
    $ones = $num % 10;
    $tens = ($num - $ones) % 100;
    $hundreds = ($num - $tens - $ones) % 1000;
    $thou = ($num - $hundreds - $tens - $ones) % 10000;
    $tens = $tens / 10;
    $hundreds = $hundreds / 100;
    $thou = $thou / 1000;
    $rnum = '';
    if ($thou) {
        $rnum .= $r_thou[$thou];
    }
    if ($hundreds) {
        $rnum .= $r_hund[$hundreds];
    }
    if ($tens) {
        $rnum .= $r_tens[$tens];
    }
    if ($ones) {
        $rnum .= $r_ones[$ones];
    }
    return $rnum;
}
    
    private function cuentavocales($a) {
        $cantidad=substr_count($a, 'a')+substr_count($a, 'e')+substr_count($a, 'i')+substr_count($a, 'o')+substr_count($a, 'u');
        return $cantidad;
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

    private function factorial($n) {
        $resultado = 1;
        for ($index = 2; $index <= $n; $index++) {
            $resultado = $resultado * $index;
        }
        return $resultado;
    }

    private function sumaDigitosFactorial($numero) {
        $suma = 0;
        $factorial = $this->factorial($numero);
        $str = gmp_strval($factorial);
        echo $str;
        //var_dump($str); exit();
        for ($index = 0; $index < strlen($str); $index++) {
            $digito = substr($str, $index, 1);
            $suma+=$digito;
        }

        return $suma;
    }

    private function diaAnno($dia) {
        $date = DateTime::createFromFormat('z Y', strval($dia - 1) . ' 2014');
        /* @var $date DateTime */
        //print_r ($date);
        return $date->format("n,j");
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
