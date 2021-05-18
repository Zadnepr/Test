<?php


namespace app\models;

class Btc
{
    /**
     * @return false|array
     */
    public static function getData(){
        $source = 'https://blockchain.info/ticker';
        $result = @file_get_contents($source);
        if($result!==false){
            $result = json_decode($result, true);
        }
        return $result;
    }

}