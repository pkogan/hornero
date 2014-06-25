<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
            <div id="logo"><img alt="logo" src="<?php echo Yii::app()->request->baseUrl?>/images/logo.jpg" width="40px"></img><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index'),'visible'=>Yii::app()->user->isGuest),
                    		array('label'=>'Inicio', 'url'=>array('/bandeja/index'), 'visible'=>!Yii::app()->user->isGuest),
				
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                                array('label'=>'Torneos', 'url'=>array('/torneo/index')),	
                            
                                array('label'=>'Problemas', 'url'=>array('/problema'), 'visible'=>Yii::app()->user->checkAccess('Administrador')),
                                array('label'=>'Usuarios', 'url'=>array('/usuario'), 'visible'=>Yii::app()->user->checkAccess('Administrador')),
                                array('label'=>'Stubs', 'url'=>array('/stub'), 'visible'=>Yii::app()->user->checkAccess('Administrador')),
                            array('label'=>'Equipos', 'url'=>array('/equipo'), 'visible'=>Yii::app()->user->checkAccess('Administrador')),
                            array('label'=>'Torneo', 'url'=>array('/cuenta'), 'visible'=>Yii::app()->user->checkAccess('Administrador')),
				
			array('label'=>'Ayuda', 'url'=>array('/ayuda/index')),
                        array('label'=>'Acerca de', 'url'=>array('/site/page', 'view'=>'about')),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),    
                            ),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo date('Y'); ?> Uncoma. GNU-GPL
                <br/>
                <?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
