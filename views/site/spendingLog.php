<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\money\MaskMoney;

// use yii\bootstrap\ActiveForm;
// use yii\captcha\Captcha;

$this->title = 'Spending Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $expenseDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d-M-Y']
            ],
            'item_name',
            'total_item',
            [
                'attribute' => 'money',
                'label' => 'Total Price'
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>