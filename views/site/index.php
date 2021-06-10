<?php

/* @var $this yii\web\View */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\jui\DatePicker;

$this->title = 'Dompetku';
?>
<?php $this->registerCss("
    #income-form{
        height:300px;
    }
    
    .site-index {
        text-align: center;
        margin-top:50px;
    }
    "); ?>
<small class="alert alert-info" style="margin:0px auto;">SISA UANG ANDA SAAT INI : <?= "Rp. " . number_format($remainingMoney, 2, ',', '.') ?> </small>
<div class="site-index">
    <div class="row">
        <!-- income form -->
        <div id="income-form" class="card col-sm-5">

            <div class="card-header bg-success">
                <strong style="color: whitesmoke;">INCOME</strong>
            </div>
            <?php
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => Url::to(['site/index'])
            ]);
            ?>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?= $form->field($incomeModel, 'date')->widget(
                        DatePicker::className(),
                        [
                            'dateFormat' => "php:Y-m-d"
                        ]
                    ) ?>
                </li>
                <li class="list-group-item">
                    <?php
                    echo $form->field($incomeModel, 'money')->widget(
                        MaskMoney::classname(),
                        [
                            'value' => null,
                            'options' => [
                                'placeholder' => 'Enter a valid amount...'
                            ],
                            'pluginOptions' => [
                                'allowZero' => false,
                                'allowEmpty' => true,
                                'prefix' => 'Rp.',
                                'thousands' => '.',
                                'decimal' => ',',
                                'precision' => 0
                            ]
                        ]
                    );
                    ?>
                </li>
                <li class="list-group-item">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
                </li>
            </ul>
            <?php
            ActiveForm::end();
            ?>
        </div>


        <span class="col-sm-1" style="margin:0 auto;"></span>


        <!-- //expense form -->
        <div class="card col-sm-5">
            <div class="card-header bg-danger">
                <strong style="color: whitesmoke;">EXPENSE</strong>
            </div>
            <?php
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => Url::to(['site/index'])
            ]);
            ?>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?= $form->field($expenseModel, 'date')->widget(
                        DatePicker::className(),
                        [
                            'dateFormat' => "php:Y-m-d"
                        ]
                    ) ?>
                </li>
                <li class="list-group-item">
                    <?= $form->field($expenseModel, 'item_name')->textInput() ?>
                </li>
                <li class="list-group-item">
                    <?= $form->field($expenseModel, 'total_item')->textInput() ?>
                </li>
                <li class="list-group-item">
                    <?php
                    echo $form->field($expenseModel, 'money')->widget(
                        MaskMoney::classname(),
                        [
                            'value' => null,
                            'options' => [
                                'placeholder' => 'Enter a valid amount...'
                            ],
                            'pluginOptions' => [
                                'allowZero' => false,
                                'allowEmpty' => true,
                                'prefix' => 'Rp.',
                                'thousands' => '.',
                                'decimal' => ',',
                                'precision' => 0
                            ]
                        ]
                    );
                    ?>
                </li>

                <li class="list-group-item">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
                </li>
            </ul>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>