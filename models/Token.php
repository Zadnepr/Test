<?php


namespace app\models;


class Token
{
    /**
     * @return false|string
     */
    public static function getToken(){
        $token = @file_get_contents('token.txt');
        if(!$token){
            $token = Yii::$app->getSecurity()->generateRandomString(64);
            file_put_contents('token.txt', $token);
        }
        return $token;
    }

}