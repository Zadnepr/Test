<?php


namespace app\controllers;


use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use Yii;
use yii\base\Request;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;


class Bearer extends HttpBearerAuth{
    public function handleFailure($response)
    {
        Yii::$app->response->setStatusCode(403);
        return Yii::$app->response->data = [
            'status' => "error",
            'code' => 403,
            'message' => "Invalid token",
        ];
    }
}

class ApiController extends Controller
{
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => Bearer::className(),
            'except' => [ 'login', 'signup' ],
        ];
        return $behaviors;
    }

    function beforeAction($action){
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionIndex(){
        return 'ApiController';
    }

}
