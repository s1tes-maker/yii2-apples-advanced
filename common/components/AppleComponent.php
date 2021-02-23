<?php
namespace common\components;
use yii\base\BaseObject;
use common\models\Apple;

class AppleComponent extends BaseObject
{
    const EVENT_FALL_OUT = 'fall_out'; //яблоко упало с дерева
    const EVENT_EAT = 'eat'; // яблоко откусили

    public $model;

    public function __construct($color, $id = false, $eaten = false) {
        parent::__construct();
        if(!$id) {
            $apple = new Apple();
            $apple->color = $color;
            $apple->status = 'висит на дереве';
            $apple->size = 1;
            $apple->appearance_date = new \yii\db\Expression('NOW()');
            $apple->save();
            $id = $apple->id;
        }

        $new_apple = Apple::findOne($id);

        $new_apple->eaten = 100 - $new_apple->size*100;
        if($eaten !== false) {
            $new_apple->eaten = $eaten;
        }

        $this->model = $new_apple;
    }

    public function getColor() {
        return $this->model->color;
    }

    public function FallOut() {
        $this->model->status = 'упало';
        $this->model->fallout_date = new \yii\db\Expression('NOW()');
        $this->model->save();
    }

    public function Eat() {
        $eaten = $this->model->eaten*($this->model->size)/100;
        $this->model->size -= $eaten;
        if($this->model->size > 0) {
            $this->model->save();
        } else if($this->model->size == 0) {

            $this->model->delete();
        }
    }

}