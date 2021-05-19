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
            'except' => [ ],
        ];
        return $behaviors;
    }

    function beforeAction($action){
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    protected static function getReques(){
        return Yii::$app->request;
    }
    protected static function getRequestGet(){
        $result = Yii::$app->request->get();
        unset($result['method']);
        return $result;
    }
    protected static function getRequestPost(){
        return Yii::$app->request->post();
    }

    public function actionIndex(){
        return 'ApiController';
    }

}

interface methodInterface{
    public static function doMethod($request = null);
}

interface methodInterfaceParent{
    public function returnSuccess($data = null);
    public function returnError($message = null, $code = 403);
}

class method implements methodInterfaceParent{
    public function returnSuccess($data = null){
        return [
            'status' => 'success',
            'code' => 200,
            'data' => $data
        ];
    }
    public function returnError($message = null, $code = 403){
        return [
            'status' => 'error',
            'code' => $code,
            'data' => $message
        ];
    }
}

