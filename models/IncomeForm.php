<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class IncomeForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'dompetku';
    }
    public function rules()
    {
        return [
            [['date',  'money'], 'required'],
        ];
    }
}
