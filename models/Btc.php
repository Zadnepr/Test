<?php
namespace app\models;

class Btc
{
    protected static $data, $instance;

    private function __constructor(){ }
    private function __clone(){ }
    private function __wakeup(){ }

    public static function getInstance(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class();
        }
        return self::$instance;
    }

    /**
     * @return false|array
     */
    public static function getData(){
        if(!self::$data) {
            $source = 'https://blockchain.info/ticker';
            $result = @file_get_contents($source);
            if ($result !== false) {
                $result = json_decode($result, true);
            }
        }
        else $result = self::$data;
        return $result;
    }

    public static function getRates(array $currency = null){
        $data = self::getData();
        if(!$data) return false;
        array_walk($data, function(&$a, $b) { $a = $a['sell'] * 1.02; });
        asort ( $data );
        if($currency){
            $data = array_filter($data, function($key) use ($currency){
                if(in_array($key, $currency)) return true;
                return false;
            }, ARRAY_FILTER_USE_KEY );
        }
        return $data;
    }


}