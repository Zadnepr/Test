<?php
namespace app\controllers\api\v1;

use app\models\Btc;
use yii\helpers\ArrayHelper;

class methodRates extends \app\controllers\method
{
    public static function doMethod($request=null){
        $get = $request->get();
        $data = Btc::getData();
        if(!$data) return self::returnError('Data source is missing', 400);
        array_walk($data, function(&$a, $b) { $a = $a['sell'] * 1.02; });
        asort ( $data );
        if($get['currency']){
            $cur = explode(',',$get['currency']);
            $data = array_filter($data, function($key) use ($cur){
                if(in_array($key, $cur)) return true;
                return false;
            }, ARRAY_FILTER_USE_KEY );
        }
        return self::returnSuccess($data);
    }
}