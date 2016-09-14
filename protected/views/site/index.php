<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<img style="float: right" width="50%"src="<?php echo Yii::app()->request->baseUrl?>/images/prisma455.png">
<h1 style="text-align: center;font-size: 60px"> <!--<img alt="logo"  src="<?php echo Yii::app()->request->baseUrl?>/images/logo.jpg" width="150px">--><br/><br/>Bienvenidos !!!!! </h1>
<h2 style="text-align: center">Al torneo de programación <i><?php echo CHtml::encode(Yii::app()->name); ?></i>  </h1>
<h1 style="text-align: center"><?php echo CHtml::button("Empezar a jugar",array(
                          'submit'=>$this->createUrl('login',array()),
));?></h1>



<hr/>
<img style="float: right" alt="logo"  src="<?php echo Yii::app()->request->baseUrl?>/images/lenguajesremolino.jpg" >
<h3>"Se puede programar/competir con cualquier lenguaje" java, python, php, c, c++, pascal, javascript, c#, ciao-prolog, perl, bash, lisp, ruby, smalltalk, PSeInt, ..... cualquier lenguaje.
</h3>
<h3>"Puede jugar el que quiera. Está abierto a cualquier programador, de cualquier lugar del mundo, sin límite ni de edad ni de título"
</h3>
<hr/>
