<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\components\AppleComponent as apple;
use common\models\Apple as modelApple;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $arr_colors = ['зеленое', 'красное', 'желтое', 'темно-красное', 'светло-зеленое', 'светло-желтое'];
        $arr_submit = Yii::$app->request->post();

        if($arr_submit != []) {
            modelApple::deleteAll();
            $count = rand(2,10);
            $arr_apples = [];
            for($i = 0; $i < $count; $i++) {
                $color = $arr_colors[rand(0,count($arr_colors)-1)];
                $apple = new apple($color);
                $arr_apples[] =  $apple->model;
            }
        } else {

            //добавляем поле hours_after_fallout к выборке
            $arr_apples = modelApple::find()
                ->select([
                    '{{apple}}.*',
                    '( HOUR( TIMEDIFF ( NOW(), [[fallout_date]] ) ) )  AS hours_after_fallout'])
                ->all();
        }
        return $this->render('index', ['arr_apples' =>$arr_apples]);
    }

    public function actionFallout() {
        $arr_submit = Yii::$app->request->post();
        $apple = new apple('', $arr_submit["Model"]["id"]);
        $apple->FallOut();
        return $this->goHome();
    }

    public function actionEat() {
        $arr_submit = Yii::$app->request->post();
        if(count($arr_submit)>0) {
            $id = $arr_submit["Model"]["id"];
            $eaten = $arr_submit["Apple"]["eaten"];
            $apple = new apple('', $id, $eaten);
            $apple->Eat();
        }
        return $this->goHome();
    }

    /**
     * Logs in a group.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        $model_group = UserGroup::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                'model_group' => $model_group
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
