<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class ExpenseForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'dompetku';
    }
    public function rules()
    {
        //jika act === 2 (spending)
        return [
            [['date', 'item_name', 'total_item', 'money'], 'required'],
        ];
        //jika act === 1 (income)
    }
}
