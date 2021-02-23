<?php


namespace common\models;
use yii\db\ActiveRecord;

class Apple extends ActiveRecord
{
    public $eaten;
    public $hours_after_fallout;

    public function rules()
    {
        return [
            ['eaten', 'number', 'max'=>100]
        ];
    }
}