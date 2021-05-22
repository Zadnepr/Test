<?php
namespace app\controllers\api\v1;

use app\models\Btc;
use yii\helpers\ArrayHelper;

class methodRates extends \app\controllers\method
{
    public static function doMethod($request=null){
        $get = $request->get();
        $currency = $get['currency'] ? explode(',',$get['currency']) : null;
        $data = Btc::getRates($currency);
        if(!$data) return self::returnError('Data source is missing', 400);
        return self::returnSuccess($data);
    }
}