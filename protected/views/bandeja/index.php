<?php
/* @var $this BandejaController */
/* @var $torneos  CArrayDataProvider */
/* @var $usuario Usuario */


$this->breadcrumbs = array(
    'Bandeja',
);
?>
<h1 style="text-align: center;font-size: 60px"> <img alt="logo"  src="<?php echo Yii::app()->request->baseUrl ?>/images/logo.jpg" width="150px"><br/>Bienvenido equipo <?php echo CHtml::encode($usuario->NombreUsuario); ?> !!!!! </h1>
<h2 style="text-align: center">Al torneo de programación <i><?php echo CHtml::encode(Yii::app()->name); ?></i>  </h1>
<h1 style="text-align: center"><?php
echo CHtml::button("Inscribirse en torneos", array(
    'submit' => $this->createUrl('/torneo', array()),
));
?>
    <?php
    echo CHtml::button("Descargar Stubs", array(
        'submit' => $this->createUrl('/ayuda/stubs', array()),
    ));
    ?>
<?php
echo CHtml::button("Modificar Datos Cuenta", array(
    'submit' => $this->createUrl('/bandeja/cuenta', array()),
));
?>
</h1>

<hr/>


<?php if (!is_null($usuario->torneoUsuarios)): ?>
    <h1>Torneos que estoy inscripto</h1>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $torneos,
        'itemView' => '_view',
    ));
    ?>

<?php else: ?>


<?php endif; ?>
