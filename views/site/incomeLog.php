<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;


$this->title = 'Income Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $incomeDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d-M-Y']
            ],
            [
                'attribute' => 'money',
                'label' => 'Total income'
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>