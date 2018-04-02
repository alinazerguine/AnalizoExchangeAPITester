<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../model/generated-conf/config.php';

use GuzzleHttp\Client;

class CryptoCompareAdapter{
    
    public static function getPriceConversions(array $currenciesFrom, array $currenciesTo){
        $url = "pricemulti";
        $guzzleResp = self::getGuzzleClient()->request(
                'GET',
                $url,
                [
                    'query' => [
                        'fsyms' => implode(',',$currenciesFrom),
                        'tsyms' => implode(',',$currenciesTo)
                    ],
                    'verify'=>false
                ]
        );

        // interprete response
        $guzzleBody = $guzzleResp->getBody();
        $strResponse = $guzzleBody->__toString();
        return json_decode($strResponse,true);
    }
    
    private static function getGuzzleClient(){
        return new Client(['base_uri' => 'https://min-api.cryptocompare.com/data/']);
    }
    
}

