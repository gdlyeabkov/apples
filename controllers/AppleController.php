<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Apple as AppleModel;
use app\classes\Apple;
use app\models\User;
use app\models\CustomUser;
use DateInterval;
use DateTime;

class AppleController extends Controller
{
    
    public function actionAuth()
    {
        $user = new CustomUser();
        return $this->render('auth', [ "user" => $user ]);
        
    }

    public function actionIndex()
    {
        $user = new CustomUser();
        $notAuth = !\Yii::$app->request->cookies->has("auth");
        if(!$user->load(Yii::$app->request->post()) && $notAuth){
            Yii::$app->response->cookies->add(
                new \yii\web\Cookie(
                    [
                    'name' => 'auth',
                    'value' => true
                    ]
                )
            );
            return $this->redirect(['apple/auth']);
        }

        $applesList = AppleModel::find()->all();

        foreach($applesList as $apple){
            if($apple->drop){
                $plusFiveDays = new DateInterval('P5D');
                $afterFiveDays = DateTime::createFromFormat('Y-m-d', $apple->datedrop)->add($plusFiveDays);
                $now = new DateTime();
                if($afterFiveDays <= $now){
                    $apple->dirty = true;
                    $apple->save();
                }
            }
        }

        $model = new AppleModel();

        return $this->render('index', [ "apples" => $applesList, "model" => $model ]);
    }

    public function actionDrop($id)
    {
        $apple = AppleModel::findOne(['id' => ((int)$id)]);
        $date = new DateTime();
        $apple->datedrop = $date->format('Y-m-d');
        $apple->drop = true;
        $apple->tree = false;
        $apple->status = 'drop';

        $appleInst = new Apple($apple->color);
        $appleInst->fallToGround();

        $apple->save();
        
        return $this->redirect(['apple/index']);
    }

    public function actionEat()
    {
        $currentApple = new AppleModel();
        if(\Yii::$app->request->isPost && $currentApple->load(Yii::$app->request->post())){
            $appleInst = new Apple(((int)Yii::$app->request->post()["Apple"]["percent"]));
            $appleInst->size = ((int)Yii::$app->request->post()["Apple"]["percent"]);
            $appleInst->eat($appleInst->size + ((int)Yii::$app->request->post()["Apple"]["percent"]));

            $apple = AppleModel::findOne(['id' => ((int)Yii::$app->request->post()["Apple"]["id"])]);
            
            $completeEat = $apple->percent + ((int)Yii::$app->request->post()["Apple"]["percent"]) >= 100;
            if($completeEat){
                $apple->percent = 100;
                $apple->delete();
            } else if ($completeEat < 100) {
                $apple->percent += ((int)Yii::$app->request->post()["Apple"]["percent"]);
                $apple->save();
            }
        }
        return $this->redirect(['apple/index']);
    }

    public function actionGenerate()
    {
        $countOfApples = 5;
        $colors = [
            "red",
            "green",
            "blue",
            "margenta",
            "yellow"
        ];
        
        AppleModel::deleteAll();
        
        for($i=0; $i < $countOfApples; $i++){
            $randomCountOfApples = random_int(1, $countOfApples);
            $apple = new Apple($colors[$randomCountOfApples - 1]);
            $model = new AppleModel();
            $model->color = $apple->color;
            
            
            $timestamp = mt_rand(1, time());
            $randomDate = date("Y-m-d", $timestamp);
            $model->dateappears = $randomDate;

            $model->save();
        }
        return $this->redirect(['apple/index']);
        
    }

    
}
