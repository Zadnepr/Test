<?php
namespace app\controllers\api\v1;

use app\models\Btc;
use yii\helpers\ArrayHelper;

class methodConvert extends \app\controllers\method
{
    public static function doMethod($request=null){
        $get = $request->get();
        $post = $request->post();

        $data = Btc::getData();
        if(!$data) return [
            'status' => "error",
            'code' => 400,
            'message' => 'Data source is missing',
        ];
        if(!$post['currency_from'] or !$post['currency_to'] or !$post['value']) return [
                'status' => "error",
                'code' => 400,
                'message' => 'Bad request',
            ];
        if($post['value'] < 0.01) return [
            'status' => "error",
            'code' => 400,
            'message' => 'Bad request. Min value "currency_from" is 0.01',
        ];
        $rate = 1.02;
        if($post['currency_from'] == 'BTC' AND isset($data[$post['currency_to']])){
            $currency = $data[$post['currency_to']]['sell'] * $rate;
            $converted_value = round($post['value'] * $currency, 2);

        }
        elseif($post['currency_to'] == 'BTC' AND isset($data[$post['currency_from']])){
            $currency = $data[$post['currency_from']]['sell'] * $rate;
            $converted_value = round(1 /  $currency * $post['value'], 10 );
        }
        $data = [
            'currency_from' => $post['currency_from'],
            'currency_to' => $post['currency_to'],
            'value' => $post['value'],
            'converted_value' => $converted_value,
            'rate' => $rate,
        ];

        return [
            'status' => 'success',
            'code' => 200,
            'data' => $data
        ];
    }
}