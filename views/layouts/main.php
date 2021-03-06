<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->getHomeUrl(); ?>/favicon.png" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php  $session = Yii::$app->session;

// comprueba si una sesión está ya abierta
if ($session->isActive){
    if($session->get('rol')==1){ ?>
        <div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [   'label' => '<span class="glyphicon glyphicon-file"></span> Informes',
                'encode' => false,
                'items' => [
                    ['label' => 'Informe Mensual', 'url' => ['/informes/index']],
                    ['label' => 'Informe Areas', 'url' => ['/informes/create']],
                ],

            ],
            ['label' => 'Recibo de caja', 'url' => ['/recibo-caja/index']],
            ['label' => 'Comprobante Egreso', 'url' => ['/comprobante-egreso/index']],
            ['label' => '<span class="glyphicon glyphicon-user"></span> Terceros',
            'encode' => false,
            'items'=>[
                ['label' => 'Pastores', 'url' => ['/pastores/index']],
                ['label' => 'Terceros', 'url' => ['/terceros/index']],
                ['label' => 'Diezmos Pastores', 'url' => ['/diezmo-pastores/index']],
                    ],
            ],
            ['label'=>'<span class="glyphicon glyphicon-globe"></span> Datos Geograficos',
             'encode' => false,
                'items'=>[
                    ['label'=>'Pais','url'=>['/pais/index']],
                    ['label'=>'Departamento','url'=>['/departamento/index']],
                    ['label' =>'Ciudades', 'url' => ['/ciudades/index']],
                ]            

            ],            
            ['label' => '<span class="glyphicon glyphicon-cog"></span>  Adicionales',
            'encode' => false,
             'items' => [
                ['label' => 'Areas', 'url' => ['/area/index']],
                 ['label' => 'Centros de costos', 'url' => ['/centro-area/index']],                               
                 ['label' => 'Conceptos', 'url' => ['/concepto/index']],
                 ['label' => 'Iglesias', 'url' => ['/centro-costos/index']],
                 ['label' => 'Tipos de Ingresos', 'url' => ['/tipo-ingreso/index']],
                 ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                 ['label' => 'Membresias', 'url' => ['/membresia/index']], 
                 ['label' => 'Tipos de identificaicon', 'url' => ['/tipo-id/index']], 
                        ],
             ],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
   <?php }
  else{?>
      <div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            [   'label' => 'Informes',
                'items' => [
                    ['label' => 'Informe Mensual', 'url' => ['/informes/index']],
                    ['label' => 'Informe Areas', 'url' => ['/informes/create']],
                ],

            ],
            ['label' => 'Recibo de caja', 'url' => ['/recibo-caja/index']],
            ['label' => 'Comprobante Egreso', 'url' => ['/comprobante-egreso/index']],
            //['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Adcionales',
            'items' =>  [
                ['label' => 'Teceros', 'url' => ['/terceros/index']],
                ['label' => 'Membresias', 'url' => ['/membresia/index']], 
                ['label' => 'Diezmos Pastores', 'url' => ['/diezmo-pastores/index']],
                        ],
             ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div><?php
  } 
}
?>




<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; </p> Iglesia Evangélica Discípulos de Cristo de Colombia

        <p class="pull-right"><?=  date('Y')?></p>
    </div>
</footer>
<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
   
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
