<?php


namespace app\controllers;

use Yii;
use app\controllers\api;

class V1Controller extends ApiController
{
    public function actionIndex($method = null){
        if($method) {
            $Type = ucfirst($method);
            $objectName = "method{$Type}";
            if (class_exists('app\controllers\api\v1\\'.$objectName)) {
                $result = call_user_func_array('app\controllers\api\v1\\'.$objectName.'::doMethod', [self::getReques()]);
            }
            elseif(class_exists('app\controllers\api\\'.$objectName)){
                $result = call_user_func_array('app\controllers\api\\'.$objectName.'::doMethod', [self::getReques(),]);
            }
            else {
                $result = [
                    "status" => "error",
                    "code" => 400,
                    "message" => "Bad request. Method not found"
                ];
            }
        }
        else {
            $result = [
                "status" => "error",
                "code" => 400,
                "message" => "Bad request. Method is required"
            ];
        }
        return $result;
    }

    private static function getReques(){
        return Yii::$app->request;
    }
    private static function getRequestGet(){
        $result = Yii::$app->request->get();
        unset($result['method']);
        return $result;
    }
    private static function getRequestPost(){
        return Yii::$app->request->post();
    }
}

interface methodInterface{
    public static function doMethod($request);
}
class method implements methodInterface{
    public static function doMethod($request){

    }
}

