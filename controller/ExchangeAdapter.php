<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../model/generated-conf/config.php';
require_once __DIR__.'/../vendor/ccxt/ccxt/ccxt.php';
require_once __DIR__.'/../model/Balance.php';
require_once __DIR__.'/../model/OrderBook.php';
require_once __DIR__.'/../model/Deposit.php';
require_once __DIR__.'/CryptoCompareAdapter.php';
require_once __DIR__.'/CacheHandler.php';
require_once __DIR__.'/../tools/helperfunctions.php';

use Propel\Runtime\Propel;
use Propel\Runtime\Collection\ObjectCollection;

class ExceptionAPINotImplemented extends Exception{
    
}

class ExchangeAdapter{
    
    private static $witdrawalFees = array(
        'hitbtc2' => array(
            'BTC' => 0.001,
            'ETH' => 0.00958,
            'BCH' => 0.0018,
            'USDT' => null,
            'BTG' => 0.0005,
            'XRP' => 0.509,
            'DASH' => 0.03,
            'LTC' => 0.003,
            'ZEC' => 0.0001,
            'XMR' => 0.09,
            '1ST' => 0.84,
            '8BT' => null,
            'ADX' => 5.7,
            'AE' => 6.7,
            'AEON' => 0.01006,
            'AIR' => 565,
            'AMB' => null,
            'AMM' => null,
            'AMP' => null,
            'ANT' => 6.7,
            'ARDR' => null,
            'ARN' => 18.5,
            'ART' => 26,
            'ATB' => 0.0004,
            'ATL' => 27,
            'ATM' => 504,
            'ATS' => 860,
            'AVT' => 1.9,
            'B2X' => null,
            'BAS' => 113,
            'BCC' => 0.004,
            'BCN' => 0.1,
            'BET' => 124,
            'BKB' => 46,
            'BMC' => 32,
            'BMT' => 100,
            'BNT' => 2.57,
            'BOS' => null,
            'BQX' => 4.7,
            'BTCA' => 351.21,
            'BTM' => 40,
            'BTX' => 0.04,
            'BUS' => 0.004,
            'CAPP' => 97,
            'CAT' => null,
            'CTT' => 6,
            'CDT' => 100,
            'CDX' => 30,
            'CFI' => 61,
            'CL' => 13.85,
            'CLD' => 0.88 ,
            'CND' => 574,
            'CNX' => 0.04 ,
            'COSS' => 65 ,
            'CPAY' => 5.487,
            'CRS' => null,
            'CSNO' => 16 ,
            'CTR' => 15,
            'CTX' => 146,
            'CVC' => 8.46,
            'DATA' => 12.949,
            'DBIX' => 0.0168,
            'DCN' => 1280,
            'DCT' => 0.02,
            'DDF' => 342,
            'DENT' => 1000,
            'DGB' => 0.4,
            'DGD'=> 0.01,
            'DICE' => 0.32 ,
            'DIM' => 8.357,
            'DLT' => 0.26,
            'DNT' => 0.21,
            'DOGE' => 2,
            'DOV' => 34,
            'DRPU' => 24,
            'DRT' => 240,
            'DSH' => 0.017,
            'EBET' => 84,
            'EBTC' => 20,
            'EBTCOLD' => 6.6,
            'ECAT' => 14,
            'ECH' => null,
            'EDG' => 2,
            'EDO' => 2.9,
            'EKO' => 1136.36,
            'ELE' => 0.00172,
            'ELM' => 0.004,
            'EMC' => 0.03,
            'EMGO' => 14,
            'ENJ' => 163,
            'EOS' => 1.5,
            'ERO' => 34,
            'ETBS' => 15,
            'ETC' => 0.002,
            'ETP' => 0.004,
            'EVX' => 5.4,
            'EXN' => 456,
            'FCN' => 0.000005,
            'FRD' => 65,
            'FUEL' => 123.00105,
            'FUN' => 202.9598309,
            'FYN' => 1.849,
            'FYP' => 66.13,
            'GAME' => 0.004,
            'GNO' => 0.0034,
            'GRPH' => null,
            'GUP' => 4,
            'GVT' => 1.2,
            'HAC' => 144,
            'HDG' => 7,
            'HGT' => null,
            'HPC' => null,
            'HRB' => null,
            'HSR' => 0.04,
            'HVN' => 120,
            'ICN' => 0.55,
            'ICO' => 34,
            'ICOS' => 0.35,
            'ICX' => null,
            'IGNIS' => null,
            'IML' => null,
            'IND' => 76,
            'INDI' => 790,
            'ITS' => 15.0012,
            'IXT' => 11,
            'KBR' => 143,
            'KICK' => 112,
            'KMD' => 4,
            'LA' => 41,
            'LAT' => 1.44,
            'LEND' => 388,
            'LIFE' => 13000,
            'LOC' => 11.076,
            'LRC' => 27 ,
            'LSK' => 0.3,
            'LUN' => 0.34,
            'MAID' => null,
            'MANA' => 143,
            'MCAP' => 5.44 ,
            'MCO' => 0.357,
            'MIPS' => 43,
            'MNE' => 1.33 ,
            'MPK' => null,
            'MRV' => null,
            'MSP' => 121,
            'MTH' => 92,
            'MYB' => 3.9,
            'NDC' => 165,
            'NEBL' => 0.04,
            'NEO' => null,
            'NET' => 3.96,
            'NGC' => 2.368,
            'NTO' => 998,
            'NXC' => 13.39,
            'NXT' => 3,
            'OAX' => 15,
            'ODN' => 0.004,
            'OMG' => 2,
            'OPT' => 335,
            'ORME' => 2.8 ,
            'OTN' => 0.57,
            'OTX' => null,
            'PAY' => 3.1,
            'PBKX' => null,
            'PING' => null,
            'PIX' => 96,
            'PLBT' => 0.33,
            'PLR' => 114,
            'PLU' => 0.87,
            'POE' => 784,
            'POLL' => 3.5,
            'PPC' => 0.02 ,
            'PPT' => 2,
            'PQT' => null,
            'PRE' => 32,
            'PRG' => 39,
            'PRO' => 41,
            'PRS' => 60,
            'PTOY' => 0.5,
            'QAU' => 63,
            'QCN' => 0.03,
            'QTUM' => 0.04,
            'QVT' => 64,
            'REP' => 0.02,
            'RKC' => 15,
            'RLC' => 1.21,
            'ROOTS' => null,
            'RVT' => 14,
            'SAN' => 2.24,
            'SBD' => null,
            'SBTC' => null,
            'SC' => null,
            'SCL' => 2.6,
            'SISA' => 1640,
            'SKIN' => 407,
            'SMART' => null,
            'SMS' => 0.0375,
            'SNC' => 36,
            'SNGLS' => null,
            'SNM' => 48,
            'SNT' => 233,
            'SPF' => 14.4,
            'STAR' => 0.144,
            'STEEM' => null,
            'STORM' => 153.19,
            'STRAT' => 0.01,
            'STU' => 14,
            'STX' => 11,
            'SUB' => 17,
            'SUR' => 3,
            'SWFTC' => 352.94,
            'SWT' => 0.51,
            'TAAS' => 0.91 ,
            'TBT' => 2.37,
            'TFL' => null,
            'TGT' => 173,
            'TIME' => 0.03,
            'TIX' => 7.1,
            'TKN' => 1,
            'TKR' => 84,
            'TNT' => 90,
            'TRST' => 1.6,
            'TRX' => 270,
            'UET' => 480,
            'UGT' => 15,
            'UTT' => 3,
            'VEN' => 14 ,
            'VERI' => 0.037,
            'VIB' => 50,
            'VIBE' => 145,
            'VOISE' => 618,
            'WAVES' => null,
            'WEALTH' => null,
            'WINGS' => 2.4,
            'WMGO' => null,
            'WRC' => 48,
            'WTC' => 0.75,
            'WTT' => null,
            'XAUR' => 3.23,
            'XDN' => null,
            'XDNCO' => null,
            'XDNICCO' => null,
            'XEM' => 15,
            'XLC' => null,
            'XTC' => null,
            'XUC' => 0.9,
            'XVG' => null,
            'YOYOW' => 140,
            'ZAP' => 24,
            'ZRC' => null,
            'ZRX' => 23,
            'ZSC' => 191
        )
    );
    
    public static $exchanges = array();
    private static $syncEvents = array();
        
    public static function getExchangeForAccount(Account $acc){
        $exchangeName=  $acc->getExchangeName();
        $keys = $acc->getExchangeKeysArray();
        return self::getExchange($exchangeName, $keys);
    }
    
    public static function getExchange($exchangeName, $keys = null){
        $key = $exchangeName . (isset($keys) ? json_encode($keys) : '');
        if(array_key_exists($key,self::$exchanges) === false){  
            $exchangeClassName = "ccxt\\".$exchangeName;
            if(isset($keys))
                self::$exchanges[$key] = new $exchangeClassName($keys);
            else
                self::$exchanges[$key] = new $exchangeClassName();
        }
        return self::$exchanges[$key]; 
    }
    
    
    public static function getOrderBook($exchangeName, $symbol, $depth=100) : ?OrderBook{
        $dataFromExchange = self::getOrderbookData($exchangeName, $symbol,$depth);
        $ticker = self::getTicker($exchangeName, $symbol);
        $orderBook = new OrderBook();
        $orderBook->hydrate($dataFromExchange, $ticker->getFeeRateBuy(), $ticker->getFeeRateSell());
        return $orderBook;
    }

    
    private static function getOrderbookData($exchangeName, $symbol, $depth=100) { 
        $cacheKey = 'orderbook_'.$exchangeName."_".$symbol; 
        
        // try to get from cache first and return if found
        $books = CacheHandler::getFromCache($cacheKey);
        if(isset($books)) return $books;
        
        // not found in cache or refresh, so fetch them
        // but acquire semaphore lock first to ensure that only 1 thread fetches the data
        // use a SyncEvent to unblock all waiting threads once the cache is loaded
        $sem = CacheHandler::getSemaphore($cacheKey);
        if($sem === false) {
            CacheHandler::getSyncEvent($cacheKey)->wait(5000); // another process is fetching tickers and storing to cache
            $books = CacheHandler::getFromCache($cacheKey);
            if(isset($books)) return $books;
        }
        
        try{
            $exchange = self::getExchange($exchangeName);
            if(!isset($exchange)) throw new Exception('No exchange found for name ' . $exchangeName);
            
            $books =  ($exchange->fetch_order_book ($symbol, $depth));
           
            CacheHandler::addToCache($books,$cacheKey,2);
            CacheHandler::getSyncEvent($cacheKey)->fire(); // signal other threads that tickers are in cache
            
            return $books;
        }
        catch(Exception $e){
            self::getLogger()->addError('getOrderBooks - Exception '.$e->getMessage().' - '.$e->getTraceAsString());
            throw $e;
        }
        finally{
           if($sem !== false) CacheHandler::releaseSemaphore($sem);
        }
                
    }
    
    public static function getTickerCollection($exchangeName, $onlyActive=true) : ?ObjectCollection{
        $arrTickers = self::getTickers($exchangeName,$onlyActive);
        $res = array();
        foreach($arrTickers as $cur=>$curTickers){
            foreach($curTickers as $curTicker){
                $res[$curTicker->getSymbol()] = $curTicker;
            }
        }
        $oc = new ObjectCollection();
        $oc->setModel('Ticker');
        //$oc->fromArray(array_values($res));
        $oc->setData(array_values($res));
        return $oc;
    }
    
    public static function getTickers($exchangeName, $onlyActive=true) : ?array{
        $cacheKey = 'tickers_'.$exchangeName; 

        // try to get from cache first and return if found
        /* jef : this does not work for the matrixitems, which are lost */
        $tickers = CacheHandler::getFromCache($cacheKey);
        if(isset($tickers)) return ($onlyActive) ? $tickers['active'] : $tickers['all'];
        
        
        // not found in cache or refresh, so fetch them
        // but acquire semaphore lock first to ensure that only 1 thread fetches the data
        // use a SyncEvent to unblock all waiting threads once the cache is loaded
        $sem = CacheHandler::getSemaphore($cacheKey);
        if($sem === false) {
            self::getLogger()->addInfo('ExchangeAdapter - waiting for event');
            CacheHandler::getSyncEvent($cacheKey)->wait(5000); // another process is fetching tickers and storing to cache
            self::getLogger()->addInfo('ExchangeAdapter - event fired');
            $tickers = CacheHandler::getFromCache($cacheKey);
            if(isset($tickers)) {
                return ($onlyActive) ? $tickers['active'] : $tickers['all'];
            }
        }/**/
        try{
            // fetch tickers and add to cache
            $exchange = self::getExchange($exchangeName);
            if(!isset($exchange)) throw new Exception('No exchange found for name ' . $exchangeName);

            if($exchangeName === 'binance'){
                // binance has a fetch_tickers implementation that fetches symbols 1-by-1
                // better to use the allBookTickers api to get them all in 1 call
                $arrTickers = $exchange->publicGetTickerAllBookTickers();
                foreach($arrTickers as &$arrTicker){
                    $market = self::getMarket($exchangeName,$arrTicker['symbol']);
                    $arrTicker = $exchange->parse_ticker($arrTicker,$market);
                }
            }       
            else{
                // this is the standad case where fetch tickers is implemented. 
                try{
                    if($exchangeName === 'yobit'){
                        $arrTickers = self::getTickersYobit();
                    }
                    else
                        $arrTickers = $exchange->fetch_tickers(array());
                }
                catch(ccxt\NotSupported $e){
                    //$exchangeName == 'bitstamp' or $exchangeName == 'gdax' or $exchangeName == 'bitmex'
                    $exchange = self::getExchange($exchangeName); 
                    $ticker = array() ; 
                    $markets = $exchange->fetch_markets();
                    foreach ($markets as $market) {
                        $isActive = array_key_exists('active',$market) ? $market['active'] : true;
                       if ($isActive){
                           $ticker= $exchange->fetch_ticker($market['symbol']);  
                           $arrTickers[] = $ticker; 
                            
                       }
                    }
                }
            }
            self::getLogger()->addInfo('ExchangeAdapter - fetched '.count($arrTickers).' tickers using fetch_tickers');
            $tmpAllTickers = array();
            $tmpActiveTickers = array();
            foreach($arrTickers as $arrTicker){
                try{
                    $market = self::getMarket($exchangeName,$arrTicker['symbol']);
                    if(!isset($market)) continue; // skip this ticker, it does not seem to exist as a market
                    if(array_key_exists('active',$market)) $arrTicker['active'] = $market['active'];
                    $ticker = Ticker::createFromExchangeData($arrTicker, $exchangeName);
                }
                catch(TickerHasNoPriceException $e){
                    continue; // continue to next iteration on foreach loop
                }
                $feeRateSell = self::getTradingFeeRate($exchangeName,$ticker,OrderSideEnum::SELL);
                $feeRateBuy = self::getTradingFeeRate($exchangeName,$ticker,OrderSideEnum::BUY);
                $ticker->setFeeRateBuy($feeRateBuy);
                $ticker->setFeeRateSell($feeRateSell);
                $tmpAllTickers[$ticker->getCurrencyBase()][$ticker->getCurrencyQuote()] = $ticker;
                $tmpAllTickers[$ticker->getCurrencyQuote()][$ticker->getCurrencyBase()] = $ticker;
                if($ticker->getIsActive() !== false){
                    $tmpActiveTickers[$ticker->getCurrencyBase()][$ticker->getCurrencyQuote()] = $ticker;
                    $tmpActiveTickers[$ticker->getCurrencyQuote()][$ticker->getCurrencyBase()] = $ticker;
                }
             }
             $tickers = array('all'=>array(), 'active'=>array());
             foreach($tmpAllTickers as $symbol=>$arrTickers){
                 $tickers['all'][$symbol] = array_values($arrTickers);
             }
             foreach($tmpActiveTickers as $symbol=>$arrTickers){
                 $tickers['active'][$symbol] = array_values($arrTickers);
             }

             // push them to cache
             /* jef : this does not work for the matrixitems, which are lost */
             CacheHandler::addToCache($tickers,$cacheKey);
             CacheHandler::getSyncEvent($cacheKey)->fire(); // signal other threads that tickers are in cache
             self::getLogger()->addInfo('ExchangeAdapter - firing event');
             /**/
             
             return ($onlyActive) ? $tickers['active'] : $tickers['all'];
        }
        catch(Exception $e){
            self::getLogger()->addError('getTickers - Exception '.$e->getMessage().' - '.$e->getTraceAsString());
            throw $e;
        }
        finally{
          /* jef : this does not work for the matrixitems, which are lost */
           if($sem !== false) CacheHandler::releaseSemaphore($sem);
           
        }
    }
    
    public static function getTickerForCurrencies($exchangeName, $currencyOne, $currencyTwo){
        $tickerSymbol = $currencyOne . '/' . $currencyTwo;
        $ticker  = self::getTicker($exchangeName, $tickerSymbol);
        if(!isset($ticker)){
            $tickerSymbol = $currencyTwo . '/' . $currencyOne;
            $ticker  = self::getTicker($exchangeName, $tickerSymbol);
        }
        return $ticker;
    }
    
    public static function getTicker($exchangeName,$tickerSymbol) : Ticker{
        $currencies = explode('/',$tickerSymbol);
        $tickers = self::getTickers($exchangeName,false);
        if(array_key_exists($currencies[0],$tickers)){
            foreach($tickers[$currencies[0]] as $ticker){
                if($ticker->getSymbol() === $tickerSymbol){
                    return $ticker;
                }
            }
        }
        
        return null;
    }
    
    private static function getTickersYobit(){
        $e = self::getExchange('yobit') ; 
        $markets = self::getMarkets('yobit');
        $exchange_result = array();
        $symbols = array();
        $market_keys = array_keys($markets);
        for($i=0; $i<count($market_keys); $i++){
            $symbols[] = $markets[$market_keys[$i]]['symbol'];
            // if((count($symbols) === 300) or ($i=== count($markets)-1)){
            //     // echo "fetching tickers : ".join($symbols,',').PHP_EOL;
            //     // $exchange_result = array_merge($exchange_result,$e->fetch_tickers($symbols));
            //     // $symbols = array();
            // }
            if ($i == 10) {
                break;
            }
            $exchange_result[] = $e->fetch_ticker($markets[$market_keys[$i]]['symbol']);
        }
        return $exchange_result;
    }
    
    public static function getCurrency($exchangeName, $currency) {
        $currencies = self::getCurrencies($exchangeName);
        if (array_key_exists($currency,$currencies)) {
            return $currencies[$currency];
        } else {
            return null;
        }
    }
    
    public static function getCurrencies($exchangeName) {
        $cacheKey = 'currencies_'.$exchangeName;
                
         // first try to get from cache
        $currencies = CacheHandler::getFromCache($cacheKey);
        if (isset($currencies)) {
             self::getLogger()->addInfo('ExchangeAdapter - fetched ' . count($currencies) . ' markets from cache');
             return $currencies;
        }
        
        $exchange = self::getExchange($exchangeName);
        if (!isset($exchange)) {
            throw new Exception('No exchange found for name ' . $exchangeName);
        }
        // no methode fetch_curriencies for gdax
        
        if ($exchangeName == 'gdax'){
            $currencies = self::getCurrenciesGdax('gdax'); 
        } elseif ($exchangeName === 'binance'){
            $currencies = self::getCurrenciesBinance();
        } elseif ($exchangeName == 'bitstamp'){
            $currencies = self::getCurrenciesBitstamp('bitstamp'); 
        } elseif ($exchangeName == 'cex') {
            $currencies = self::getCurrenciesCex('cex'); 
        } elseif ($exchangeName == 'bitmex') {
            $currencies = self::getCurrenciesBitmex('bitmex'); 
        } elseif ($exchangeName == 'bitfinex') {
            $currencies = self::getCurrenciesBitmex('bitfinex'); 
        } elseif ($exchangeName == 'yobit') {
            $currencies = self::getCurrenciesYobit('yobit'); 
        } elseif (method_exists($exchange,'fetch_currencies')) {
            $currencies = $exchange->fetch_currencies();
            self::getLogger()->addInfo('ExchangeAdapter - fetched '.count($currencies).' markets from exchange');
        } else {
            throw new ExceptionAPINotImplemented('Trying to fetch currencies for exchange '.$exchangeName. ' that has no implementation for fetch_currencies');
        }
        
        CacheHandler::addToCache($currencies,$cacheKey,2400);
        return $currencies;
    }
    
    public static function numberOfDecimals($value) {
        if ((int)$value == $value) {
            return 0;
        } else if (! is_numeric($value)) {
            // throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
            return false;
        }
        return strlen($value) - strrpos($value, '.') - 1;
    }
    
    private static function getCurrenciesGdax($exchangeName) {
        $e = self::getExchange($exchangeName) ; 
        $exchange_result = $e->publicGetCurrencies(array());
        $currencies = array(); 
        foreach ($exchange_result as $result) {
            $currencies[$result['id']]['id'] = $result['id'];
            $currencies[$result['id']]['code'] = $result['id'];
            $currencies[$result['id']]['fee'] = 0;
            $currencies[$result['id']]['info']['aclass'] = 'currency';
            $currencies[$result['id']]['info']['altname'] = $result['id'];
            $currencies[$result['id']]['info']['decimals'] = ExchangeAdapter::numberOfDecimals($result['min_size']);
            $currencies[$result['id']]['info']['display_decimals'] = 5;
            $currencies[$result['id']]['active'] = ($result['status'] == 'online' ? true : false);
            $currencies[$result['id']]['status'] = $result['status'];
        }
        
        return $currencies ; 
    }
    
    public static function getCurrenciesBinance(){
        $exchange = self::getExchange('binance');
        
        // add method to api definition on exchange class
        $exchange->api['web']['get'][] = 'assetWithdraw/getAllAsset.html';
        $exchange->define_rest_api ($exchange->api, 'request');

        // call method, result is array
        $exchange_result = $exchange->webGetAssetWithdrawGetAllAssetHtml();
        
        $currencies = array(); 
        foreach ($exchange_result as $result) {
            $assetCode = $result['assetCode'];
            $currencies[$assetCode]['id']=$result['id'];
            $currencies[$assetCode]['fee']=$result['transactionFee'];
            $currencies[$assetCode]['code']=$result['assetCode'];
            $currencies[$assetCode]['info']['aclass']='currency';
            $currencies[$assetCode]['info']['altname']=$result['assetCode'];
            $currencies[$assetCode]['info']['decimals']= $result['feeDigit'];
            $currencies[$assetCode]['info']['display_decimals']=5 ;
            $depositEnabled = $result['enableCharge'];
            $withdrawEnabled = $result['enableWithdraw'];
            $currencies[$assetCode]['active']= ($depositEnabled and $withdrawEnabled);
            if (!isset($currencies[$assetCode]['active'])){
                $currencies[$assetCode]['active']=false; 
            }
            //$currencies[$result['id']]['status']=  $result['status']; 
        }
        
        return $currencies ; 
    }
    
    private static function getCurrenciesBitStamp($exchangeName){
        $bitstamps = array('BTC' ,'BCH','LTC','ETH','XRP') ;   
        foreach ($bitstamps as $bitstamp){
                
            $assetCode = $bitstamp;
                       
            $currencies[$assetCode]['id']=$bitstamp;
            $currencies[$assetCode]['code']=$bitstamp;
            $currencies[$assetCode]['fee']=0;
            $currencies[$assetCode]['info']['aclass']='currency';
            $currencies[$assetCode]['info']['decimals']= 7;
            $currencies[$assetCode]['info']['display_decimals']=5 ;
            $depositEnabled = true;
            $withdrawEnabled = true;
            $currencies[$assetCode]['active']= ($depositEnabled and $withdrawEnabled);
        }
        return $currencies ; 
    }
    
    public static function getCurrenciesCex($exchangeName){
        $cexs= array(
            'BTC' => 0.001,
            'ETH' => 0.01,
            'BTG' => 0.001,
            'XRP' => 0.02,
            'ZEC' => 0.001,
            'XLM' => 0.00001,
            'BCH' => 0.001,
            // 'USD' => null,
            // 'EUR' => null,
            // 'RUB' => null,
            // 'GBP' => null,
            'DASH' => 0.01
        );
        
         foreach ($cexs as $assetCode=>$fee){                       
            $currencies[$assetCode]['id']=$assetCode;
            $currencies[$assetCode]['code']=$assetCode;
            $currencies[$assetCode]['fee']=$fee;
            $currencies[$assetCode]['info']['aclass']='currency';
            $currencies[$assetCode]['info']['decimals']= 7;
            $currencies[$assetCode]['info']['display_decimals']=5 ;
            $depositEnabled = true;
            $withdrawEnabled = true;
            $currencies[$assetCode]['active']= ($depositEnabled and $withdrawEnabled);
        }
        return $currencies ; 
        

    }
    
    /*
     * Example bitmex dump 
     * {"symbol":"NEOG18","rootSymbol":"NEO","state":"Open","typ":"FFCCSX",
     * "listing":"2018-02-04T20:00:00.000Z","front":"2018-01-26T12:00:00.000Z","expiry":"2018-02-23T12:00:00.000Z",
     * "settle":"2018-02-23T12:00:00.000Z","relistInterval":null,"inverseLeg":"","sellLeg":"","buyLeg":"",
     * "positionCurrency":"NEO","underlying":"NEO","quoteCurrency":"XBT","underlyingSymbol":"NEOXBT=",
     * "reference":"BMEX","referenceSymbol":".NEOXBT30M","calcInterval":null,"publishInterval":null,"publishTime":null,
     * "maxOrderQty":10000000,"maxPrice":100,"lotSize":1,"tickSize":0.000001,"multiplier":100000000,"settlCurrency":"XBt","
     * underlyingToPositionMultiplier":1,"underlyingToSettleMultiplier":null,"quoteToSettleMultiplier":100000000,"isQuanto":false,"
     * isInverse":false,"initMargin":0.05,"maintMargin":0.025,"riskLimit":5000000000,"riskStep":5000000000,"limit":null,"capped":false,
     * "taxed":true,"deleverage":true,"makerFee":-0.0005,"takerFee":0.0025,"settlementFee":0.0025,"insuranceFee":0,"fundingBaseSymbol":""
     * ,"fundingQuoteSymbol":"","fundingPremiumSymbol":"","fundingTimestamp":null,"fundingInterval":null,"fundingRate":null,
     * "indicativeFundingRate":null,"rebalanceTimestamp":null,"rebalanceInterval":null,"openingTimestamp":"2018-02-08T14:00:00.000Z",
     * "closingTimestamp":"2018-02-08T16:00:00.000Z","sessionInterval":"2000-01-01T02:00:00.000Z","prevClosePrice":0.013339,"limitDownPrice":null,
     * "limitUpPrice":null,"bankruptLimitDownPrice":null,"bankruptLimitUpPrice":null,"prevTotalVolume":55828,"totalVolume":58574,"volume":2746,
     * "volume24h":33060,"prevTotalTurnover":75539895300,"totalTurnover":79165735100,"turnover":3625839800,"turnover24h":45570079800,
     * "prevPrice24h":0.013967,"vwap":0.01378406,"highPrice":0.014431,"lowPrice":0.013001,"lastPrice":0.01324,"lastPriceProtected":0.01324,
     * "lastTickDirection":"ZeroPlusTick","lastChangePcnt":-0.0521,"bidPrice":0.013002,"midPrice":0.013121,"askPrice":0.01324,"impactBidPrice":0.01298484,"
     * impactMidPrice":0.0131125,"impactAskPrice":0.01324,"hasLiquidity":true,"openInterest":4777,"openValue":6263268010,"fairMethod":"ImpactMidPrice",
     * "fairBasisRate":-1.61,"fairBasis":-0.0009197,"fairPrice":0.0131113,"markMethod":"FairPrice","markPrice":0.0131113,"indicativeTaxRate":0,"
     * indicativeSettlePrice":0.014031,"settledPrice":null,"timestamp":"2018-02-08T15:20:00.000Z"}
     * 
     */
    public static function getCurrenciesBitmex($exchangeName) {
        $e=self::getExchange($exchangeName); 
        $exchange_results = $e->publicGetInstrumentActive(array()); 
        foreach($exchange_results as $result) {
            $id= $result['rootSymbol'];
            if ($id = 'XBT'){
                $id = 'BTC'; 
            }
                        
            $currencies[$id]['id']=$id;
            $currencies[$id]['code']=$id;
            $currencies[$id]['info']['aclass']='currency';
            $currencies[$id]['info']['altname']=$result['symbol'];
            $currencies[$id]['info']['decimals']= ExchangeAdapter::numberOfDecimals($result['tickSize']) ; 
            $currencies[$id]['info']['display_decimals']=5 ;
            $currencies[$id]['active'] = ($result['state'] == 'open' ? true : false) ;
            $currencies[$id]['status'] = $result['state']; 
        }
        return $currencies; 
    }

    //"EUR","USD","BTC","LTC","ETH","ETC","RRT","ZEC","XMR","DSH","XRP","IOT","EOS","SAN","OMG","BCH","NEO","ETP","QTM","AVT","EDO","BTG","DAT","QSH","YYW","GNT","SNT","BAT","MNA","FUN","ZRX","TNB","SPK","TRX","RCN","RLC","AID","SNG","REP","ELF"
    //"EUR","USD","BTC","LTC","ETH","ETC","RRT","ZEC","XMR","DSH","XRP","IOT","EOS","SAN","OMG","BCH","NEO","ETP","QTM","AVT","EDO","BTG","DAT","QSH","YYW","GNT","SNT","BAT","MNA","FUN","ZRX","TNB","SPK","TRX","RCN","RLC","AID","SNG","REP","ELF"
    public static function getCurrenciesBitfinex($exchangeName) {
        $bitfinexs= array("EUR","USD","BTC","LTC","ETH","ETC","RRT","ZEC","XMR","DSH","XRP","IOT","EOS","SAN","OMG","BCH","NEO","ETP","QTM","AVT","EDO","BTG","DAT","QSH","YYW","GNT","SNT","BAT","MNA","FUN","ZRX","TNB","SPK","TRX","RCN","RLC","AID","SNG","REP","ELF");
        
         foreach ($bitfinexs as $bitfinex){
                
            $assetCode = $bitfinex;
                       
            $currencies[$assetCode]['id']=$bitfinex;
            $currencies[$assetCode]['code']=$bitfinex;
            $currencies[$assetCode]['info']['aclass']='currency';
            $currencies[$assetCode]['info']['decimals']= 7;
            $currencies[$assetCode]['info']['display_decimals']=5 ;
            //dees is dangerous he 
            $depositEnabled = true;
            $withdrawEnabled = true;
            $currencies[$assetCode]['active']= ($depositEnabled and $withdrawEnabled);
        }
        return $currencies ; 
        

    }
    
    private static function getCurrenciesYobit($exchangeName) {
        $e = self::getExchange('yobit') ; 
        $markets = self::getMarkets('yobit');
        $market_keys = array_keys($markets);
        $currencies = array();
        $symbol = array();
        $info = array();
        for ($i = 0; $i < count($market_keys); $i++) {
            $symbol = $markets[$market_keys[$i]]['symbol'];
            $info = $markets[$market_keys[$i]]['info'];
            $currencies[$symbol]['id'] = $markets[$market_keys[$i]]['id'];
            $currencies[$symbol]['code'] = $markets[$market_keys[$i]]['symbol'];
            $currencies[$symbol]['info'] = $info;
            $currencies[$symbol]['fee'] = $info['fee'];
            $currencies[$symbol]['precision'] = $markets[$market_keys[$i]]['precision'];
            $currencies[$symbol]['active'] = $markets[$market_keys[$i]]['active'];
            $currencies[$symbol]['status'] = ($markets[$market_keys[$i]]['active'] ? 'open' : 'close');
        }
        return $currencies;
    }
    
    public static function isWalletActive($exchangeName, $currency){
        try{
            //if($exchangeName === 'binance') return true; // todo : find a solution for this hack. binance has no currency api!
            $currencyData = self::getCurrency($exchangeName,$currency);
            if(isset($currencyData)){
                if(array_key_exists('active',$currencyData)){
                    return $currencyData['active'];
                }
            }
            return null;
        }
        catch(ExceptionAPINotImplemented $e){
            throw $e;
            //return true; // for now, should be improved by implementing alternative method
        }
        
    }
    
    public static function getMarkets($exchangeName,$byId=false){
        $cacheKey = 'markets_'.$exchangeName;
        
        // first try to get from cache
        $markets = CacheHandler::getFromCache($cacheKey);
        if(isset($markets)){
             //self::getLogger()->addInfo('ExchangeAdapter - fetched '.count($markets).' markets from cache');
             return $byId ? $markets['byid'] : $markets['byticker'];
        }
        
        $exchange = self::getExchange($exchangeName, array('timeout'=> 300000));
        if(!isset($exchange)) throw new Exception('No exchange found for name ' . $exchangeName);

        //$markets = $exchange->load_markets();
        $exchange->load_markets();
        $markets['byticker'] = $exchange->markets;
        $markets['byid'] = $exchange->markets_by_id;
        self::getLogger()->addInfo('ExchangeAdapter - fetched '.count($markets).' markets from exchange');
        
        CacheHandler::addToCache($markets,$cacheKey,2400);
        
        return $byId ? $markets['byid'] : $markets['byticker'];
    }
    
    public static function findTickerSymbol($exchangeName, $symbol){
        $e = self::getExchange($exchangeName);
        
        $markets = ExchangeAdapter::getMarkets($exchangeName,false);

        // clean up special chars
        $tickerClean = stripStringOfSpecialChars($symbol);
        // create reverse array
        $arrTickerSearch = array($tickerClean);
        for($i=0; $i<strlen($tickerClean); $i++){
            $searchPart1 = $e->common_currency_code(substr($tickerClean,0,$i));
            $searchPart2 = $e->common_currency_code(substr($tickerClean,$i,strlen($tickerClean)-1));
            $arrTickerSearch[] = $searchPart2.$searchPart1;
        }

        foreach($markets as $tickerSymbolSlash=>$market){
            if(in_array(stripStringOfSpecialChars($tickerSymbolSlash),$arrTickerSearch)){
                return $market['symbol'];
            }
        }                   
        
        return null;
    }
    
    public static function getMarket($exchangeName, $symbol){
        $arr = self::getMarkets($exchangeName,false);
        if(array_key_exists($symbol,$arr)){
            return $arr[$symbol];
        }        
        
        $arr = self::getMarkets($exchangeName,true);
        if(array_key_exists($symbol,$arr)){
            return $arr[$symbol];
        }   
        
        return null;
        
    }
    
    public static function getBTCTickerForCurrency($exchangeName, $currency){
        $res = self::getTicker($exchangeName,$currency.'/BTC');
        if(!isset($res))
            $res = self::getTicker($exchangeName,'BTC/'.$currency);
        return $res;
    }
    
    public static function getBTCValue($exchangeName,$currency,$amount){
        $ticker = self::getBTCTickerForCurrency($exchangeName, $currency);
        $price = $ticker->getMidPrice();
        return $amount * $price; 
    }
    
    public static function getAmountFromBTCAmount($exchangeName,$currency,$btcAmount){
        $btcValue = self::getBTCValue($exchangeName,$currency,$btcAmount);
        if(isset($btcValue)) return 1/$btcValue;
        else return null;
    }
    
    public static function getSymbols($exchangeName){
        return array_keys(ExchangeAdapter::getTickers($exchangeName));
    }
    
    public static function getSymbol($exchangeName,$symbol){
        $arr = self::getSymbols($exchangeName);
        if(array_key_exists($symbol,$arr))
            return $arr[$symbol];
        else return null;
    }
    
    /*public static function getCurrency($exchangeName, $cur){
        $cacheKey = 'currency_'.$cur.'_'.$exchangeName;
        
        // first try to get from cache
        if(self::getCache()->has($cacheKey)){
             $currency = self::getCache()->get($cacheKey);
             return $currency;
        }
        
        $exchange = self::getExchange($exchangeName);
        if(!isset($exchange)) throw new Exception('No exchange found for name ' . $exchangeName);
        
        $markets = $exchange->load_markets();
        $currency = $exchange->currency($cur);
        
        self::getCache()->set($cacheKey,$currency,4);
        
        return $currency;
    }*/
    
    public static function cancelOrder(Order $order){
        $acc = $order->getAccount();
        $exchange = self::getExchangeForAccount($acc);
        $exchange->load_markets(); // because of bug in market() function used by cancel_order()
        // note : binance does not seem to work?
        $params = array();
        if($acc->getExchangeName() == 'binance'){
            $params = array(
                    'timestamp'=>$exchange->nonce()+0,
                    'recvWindow' => 10000000,
                    'origClientOrderId' =>'RH7axJtTxtErD4aPfF5pgq'
                     );
        }
        try{
            $res = $exchange->cancel_order(
                $order->getExchangeOrderId(),
                $order->getTickerSymbol(),
                $params
            );
            self::getLogger()->addInfo('ExchangeAdapter - cancelled order '.$order->getId());
        
            
        }
        catch(Exception $e){
            $doIgnore= false;
            if(isset($exchange)){
                if ($exchange->last_json_response) {
                    $message = $exchange::safe_string($exchange->last_json_response, 'message');
                    if ($message == 'ORDER_NOT_OPEN'){
                        $doIgnore = true;
                         self::getLogger()->addInfo('ExchangeAdapter - cancelled order '.$order->getId());
                    }
                }
            }
            if(!$doIgnore) throw $e;
        }
        finally{
            return $order;
        }
           
    }
    
    public static function amountToLots($exchangeName,$tickerSymbol, $amount){
        $exchange = self::getExchange($exchangeName);
        if(!isset($exchange)) throw new Exception('No exchange found for name ' . $exchangeName);
        
        $exchange->load_markets(); // markets must be loaded for ampountToLoads to work
        return $exchange->amountToLots($tickerSymbol,$amount);
    }
    
    public static function priceToPrecision($exchangeName,$tickerSymbol,$price){
        $exchange = self::getExchange($exchangeName);
        if(!isset($exchange)) throw new Exception('No exchange found for name ' . $exchangeName);
        
        $exchange->load_markets(); // markets must be loaded for ampountToLoads to work
        return $exchange->price_to_precision($tickerSymbol,$price);
    }
    
    public static function fetchOpenOrders(Account $acc, $tickerSymbol){
        $exchangeName = $acc->getExchangeName();
        $exchange = self::getExchangeForAccount($acc);
        $orderData = $exchange->fetchOpenOrders ($tickerSymbol);
        return $orderData;
    }
    
    public static function fetchOrderUpdate(Order $order){
        $acc = $order->getAccount();
        $exchangeName = $acc->getExchangeName();
        $exchange = self::getExchangeForAccount($acc);
        if($order->getExchangeOrderId() == null){
            throw new Exception('Trying to fetch update on order '.$order->getId().' without exchange order id');
        }
        try{
            $order_from_exchange = $exchange->fetch_order ($order->getExchangeOrderId(),$order->getTickerSymbol());
            $order = self::parseOrder($order, $order_from_exchange);
            return $order;
        }
        catch(ccxt\OrderNotCached $e){
            if($exchangeName == 'poloniex'){
                // poloniex only fetches open orders with fetch_order.Use 
                /*$order_from_exchange = $exchange->fetch_my_trades(
                        $order->getTickerSymbol()//$symbol = null, 
                        //$since = null, $limit = null, $params = array ()
                );*/
                $order_from_exchange = $exchange->fetch_order_trades($order->getExchangeOrderId());
                $totalTradedAmount = 0;
                $totalFee = 0;
                $totalCost = 0;
                foreach($order_from_exchange as $trade){
                    $totalTradedAmount += $trade['amount'];
                    $totalFee += $trade['fee']['cost'];
                    $totalCost += $trade['cost'];
                }
                if($totalTradedAmount == $order->getAmount()){
                    $order->setFilled($totalTradedAmount);
                    $order->setCodeState(OrderStateEnum::CLOSED_STATE);
                    $order->setPriceActual(($totalCost-$totalFee)/$totalTradedAmount);
                    $order->setFee($totalFee);
                }
                return $order;
            }
            else throw $e;
        }
        finally{
            self::getLogger()->addInfo('ExchangeAdapter - fetched order '.$order->getId());
            
        }
        
        
    }
    
    public static function fetchWithdrawalUpdate(Withdrawal $wd){
        $acc = $wd->getAccount();
        $e = self::getExchangeForAccount($acc);
        $exchangeName= $acc->getExchangeName();
        
        // check if account is supported
        $implementedExchanges = array('binance','bittrex','kraken','hitbtc2');
        if(in_array(strtolower($exchangeName),$implementedExchanges) == false)
            throw new Exception('Trying to get info on withdrawal on exchange '. $acc->getExchangeName(). ' that has no implementation for withdrawal');
        
        // get information from exchange
        if($exchangeName === 'binance'){
            $data_from_exchange = $e->wapiGetWithdrawHistory(array(
                'asset'=>$wd->getCurrency()
            ));
        }
        elseif($exchangeName === 'bittrex'){  
            $data_from_exchange = $e->accountGetWithdrawalhistory(array(
                'currency'=>$wd->getCurrency()
            ));
        }
        elseif($exchangeName === 'kraken'){
            $data_from_exchange = $e->privatePostWithdrawStatus(array(
                'asset' => $wd->getCurrency()
            ));
        }
        elseif($exchangeName === 'hitBTC2'){
            $data_from_exchange = $e->privateGetAccountTransactionsId(array(
                'id'=> $wd->getExchangeWithdrawalId()
            ));
        }
        
        // parse the data
        if(isset($data_from_exchange)){
            self::getLogger()->addInfo('ExchangeAdapter - fetched withdrawal '.$wd->getId());
            $wd = self::parseWithdrawal($wd,$data_from_exchange);
        }
        return $wd;
    }
    
    public static function getDepositMethods(Account $acc, $currency)
    {
        
        $exchange = self::getExchangeForAccount($acc); 
        if (method_exists($exchange, 'fetch_deposit_methods') )
        {
            try{
            $response  = $exchange->fetch_deposit_methods($currency); 
            return $response;  
            }catch (Exception $e) {
                throw new ccxt\NotSupported($acc->getExchangeName(). ' no deposit possible for '.$currency['id'] ); 
            }
        }
        else { 
            throw new ccxt\NotSupported ($acc->getExchangeName() . ' fetch_deposit_methods() not implemented yet');
        }
    }
    
    public static function getDepositAdress(Account $acc, $currency)
    {
        
        /*      RETURN FORMAT 
         *   return array (
            'currency' => $currency,
            'address' => $address,
            'tag' => $tag,
            'status' => 'ok',
            'info' => $response,
        );
          */
         
        $exchange = self::getExchangeForAccount($acc); 
        if (method_exists($exchange, 'fetch_deposit_address') )
        {
            $param = array(); 
            if ($acc->getExchangeName() == 'kraken'){
                $method = self::getDepositMethods($acc, $currency); 
                $param['method']=$method[0]['method'];  
            }
            
            $response  = $exchange->fetch_deposit_address($currency, $param); 
            return $response;  
        }
        else { 
            throw new ccxt\NotSupported ($acc->getExchangeName() . ' fetch_deposit_address() not implemented yet');
        }
    }

    public static function createDepositAdress(Account $acc, $currency)
    {
        
        /*      RETURN FORMAT 
         *   return array (
            'currency' => $currency,
            'address' => $address,
            'tag' => $tag,
            'status' => 'ok',
            'info' => $response,
        );
          */
         
        $exchange = self::getExchangeForAccount($acc); 
        if (method_exists($exchange, 'create_deposit_address') )
        {
            $response  = $exchange->create_deposit_address($currency); 
            return $response;  
        }
        else { 
            throw new ccxt\NotSupported ($acc->getExchangeName()  . ' create deposit address () not implemented yet');
        }
    }

    
    public static function fetchBalanceCurrency(Account $acc, $currency, $type=Balance::TYPE_TOTAL) : BalancePosition{
        $bal = self::fetchBalance($acc,$type);
        if(isset($bal)){
            $pos = $bal->getPosition($currency);
            if(isset($pos)) return $pos;
        }
        return new BalancePosition($currency,0);
    }
    
    
    
    
    public static function fetchBalance(Account $acc, $type=Balance::TYPE_TOTAL){
        $exchange = self::getExchangeForAccount($acc);
        
        // for hitBTC, we need to sum for TOTAL
        if((strtolower($exchange->id) === 'hitbtc2') and ($type === Balance::TYPE_TOTAL)){
            $balanceAccount = self::fetchBalance($acc,Balance::TYPE_ACCOUNT);
            $balanceTrading = self::fetchBalance($acc,Balance::TYPE_TRADING);
            $res = $balanceAccount->addBalance($balanceTrading);
            return $res;
        }
        
        $cacheKey = 'balance_'.$acc->getName().(isset($type) ? $type : '');
        
        // first try to get from cache
        $balance = CacheHandler::getFromCache($cacheKey);
        if(isset($balance)){
             self::getLogger()->addInfo('ExchangeAdapter - fetched balance for account '.$acc->getName().' from cache');
             return $balance;
        }
        
        // not found in cache or refresh, so fetch them
        // but acquire semaphore lock first to ensure that only 1 thread fetches the data
        // use a SyncEvent to unblock all waiting threads once the cache is loaded
        $sem = CacheHandler::getSemaphore($cacheKey);
        if($sem === false) {
            //self::getLogger()->addInfo('ExchangeAdapter - waiting for event');
            CacheHandler::getSyncEvent($cacheKey)->wait(5000); // another process is fetching tickers and storing to cache
            //self::getLogger()->addInfo('ExchangeAdapter - event fired');
            $balance = CacheHandler::getFromCache($cacheKey);
            if(isset($balance)) {
                return $balance;
            }
        }

        try{
            
            $params = array();
            if(($exchange->id == 'binance') ){
                /*$params = array(
                    'timestamp'=>$exchange->nonce(),
                    'recvWindow' => 10000000
                );*/
            }
            if( ($exchange->id == 'poloniex')){
               $params = array(
                    //'timestamp'=>($exchange->nonce()*1000000),
                    'timestamp'=>($exchange->nonce()*1000000),
                    'recvWindow' => 10000000
                );
                
            }
            elseif($exchange->id === 'hitbtc2'){
                if(!isset($type)) throw new Exception('Trying to get balance for a hitBTC account without specifying the type (trading or account balance)');
                $params = array(
                    'type' => ($type === Balance::TYPE_TRADING) ? 'trading' : 'account'
                );
            }
            $balanceData = $exchange->fetch_balance($params);
            self::getLogger()->addInfo('ExchangeAdapter - fetched balance for account '.$acc->getName().' with '.count($balanceData).' items');
            $balance = new Balance($acc,$balanceData);
            
            // push  to cache
            CacheHandler::addToCache($balance,$cacheKey,20);
            CacheHandler::getSyncEvent($cacheKey)->fire(); // signal other threads that tickers are in cache

            return $balance;
        }
        catch(Exception $e){
            $msg = 'Failed to fetchBalance';
            if(isset($exchange)){
                $msg .= ' on exchanage '.$exchange->id;
                if(isset($exchange->last_http_response)){
                    $msg .= ', with http message '.$exchange->last_http_response;
                }
            }
            self::getLogger()->addError($msg);
            throw $e;
        }
        finally{
           if($sem !== false) CacheHandler::releaseSemaphore($sem);
        }
    }
    
    public static function fetchDeposit(Account $acc, $currency, $txId=null, $amount=null){
        $deposits = self::fetchDepositHistory($acc, $currency);
        foreach($deposits as $deposit){
            if(isset($txId) and ($deposit->getTxId() == $txId)){
                return $deposit;
            }
            if(isset($amount) and ($deposit->getAmount() == $amount)){
                return $deposit;
            }
        }
        return null;
    }
    
    /*
     * gets deposit history info  
     */
    public static function fetchDepositHistory(Account $acc, $currency=null){
        $e = self::getExchangeForAccount($acc);
        
        $res = array();
         
        // check if account is supported
        $implementedExchanges = array('binance','bittrex');
        if(in_array($acc->getExchangeName(),$implementedExchanges) == false)
            throw new Exception('Trying to get info on deposit history on exchange '. $acc->getExchangeName(). ' that has no implementation for withdrawal');
        
        // get information from exchange
        if($acc->getExchangeName() == 'binance'){
            $params = array(
                'timestamp'=>$e->nonce(),
                'recvWindow' => 10000000
            );
            if(isset($currency)) $params['asset']=$currency;
            $data_from_exchange = $e->wapiGetDepositHistory($params);
            self::getLogger()->addInfo('ExchangeAdapter - fetched deposit history');
            
            $statusMap = array(0=>OrderStateEnum::OPEN_STATE, 1=>OrderStateEnum::CLOSED_STATE); // 0:pending, 1 : success
            if($data_from_exchange['success'] == 1){
                foreach($data_from_exchange['depositList'] as $data_item){
                    $dt = new DateTime();
                    $dt->setTimestamp($data_item['insertTime']);
                    $d = new Deposit(
                        $data_item['txId'],
                        $statusMap[$data_item['status']],
                        $data_item['asset'],
                        $data_item['amount'],
                        $data_item['address'],
                        $dt,
                        $data_item['addressTag']
                    );
                    $res[] = $d;
                }
            }
            else throw new Exception('Failed to fetch deposit history for account '.$acc->getName());
            
        }
        elseif($acc->getExchangeName() == 'bittrex'){  
            $params = array(
                //'timestamp'=>$e->nonce(),
                //'recvWindow' => 10000000
            );
            if(isset($currency)) $params['currency']=$currency;
            $data_from_exchange = $e->accountGetDeposithistory($params);
            self::getLogger()->addInfo('ExchangeAdapter - fetched deposit history');
            
            if($data_from_exchange['success'] == 1){
                foreach($data_from_exchange['result'] as $data_item){
                    $dt = new DateTime();
                    $dt->setTimestamp($data_item['LastUpdated']);
                    $d = new Deposit(
                        $data_item['TxId'],
                        OrderStateEnum::CLOSED_STATE, // no status info on deposit object
                        $data_item['Currency'],
                        $data_item['Amount'],
                        $data_item['CryptoAddress'],
                        $dt/*,
                        $data_item['addressTag']*/
                    );
                    $res[] = $d;
                }
            }
        }
        
        return $res;
        
    }
    
    /* returns the current balance, while trying to fix the balance first where possible (e.g. hitBTC)*/
    // TODO : after changing the balance, we should invalidate the cache
    private static function checkBalanceBeforeOrder(Order $order){
        // check balance
        $balance = ExchangeAdapter::fetchBalance($order->getAccount(),Balance::TYPE_TRADING);
        $position = $balance->getPosition($order->getSymbolFrom());
        // try to fix on hitBTC
        if(($position->getPositionFree() < $order->getAmountSymbolFrom()) and ($order->getAccount()->getExchangeName() === 'hitBTC2')){
            // in hitBTC2, we should also check if we can transfer from the trading balance
            $balanceAccount = ExchangeAdapter::fetchBalance($order->getAccount(),Balance::TYPE_ACCOUNT);
            $positionAccount = $balanceAccount->getPosition($order->getSymbolFrom())->getPositionFree();    
            if($positionAccount >= $order->getAmount()){
                // transfer to account balance first
                $exchange = self::getExchangeForAccount($order->getAccount());
                $transactionId = $exchange->privatePostAccountTransfer(array(
                    'currency'=>$order->getSymbolFrom(),
                    'amount'=>$order->getAmount() - $position->getPositionFree(),
                    'type'=>'bankToExchange'
                ));
                if(!isset($transactionId)){
                    throw new Exception('Failed to transfer '.$order->getAmount().' from exchange to bank on hitBTC for currency '.$order->getSymbolFrom());
                }
                else return $order->getAmount();
            }
            else return $position->getPositionFree();
        }
        else return $position->getPositionFree();
        
    }
    
    /*
     * Place an order on an account. If no $acc is provided, it is placed on the 'source account'
     */
    public static function placeOrder(Order $order,$marketOrderIfBalanceEqualsAmount = false){
        $acc = $order->getAccount();
        $exchange = self::getExchangeForAccount($acc);
        $allowedDeviation = 0.01;
        
        $params = array();
        
        // check (and if possible fix) balance
        $availablePosition = self::checkBalanceBeforeOrder($order);
        $availablePositionDeviation = $availablePosition - $order->getAmountSymbolFrom();
        
        /*if((abs($availablePositionDeviation) <= $allowedDeviation*$order->getAmountSymbolFrom()) and $marketOrderIfBalanceEqualsAmount){
            // in case the balance equanls the amount we want to trade, we can turn the trade
            // into a market order for a slightly higher amount, so we are sure it is 
            // executed (quickly)
            // mind that we accept a deviation of 5%, so we can include 'star dust' in the trade
            // Note : some (or most?) exchanges don't allow market orders for amount > balance
         
            $order->setCodeType(OrdertypeEnum::MARKET);
            $order->setPrice(null);
            /*if($order->getCodeSide() === OrderSideEnum::BUY){
                // for a buy order, we can try to increase the amount a bit to make sure we sell everything we've got
                // mind that for a sell order, we were able to determine the amount to sell from the previous step exactly
                $lot = $exchange->markets[$order->getTickerSymbol()]['lot'];
                $incr = max($lot,$order->getAmount()*$allowedDeviation);
                $order->setAmount($order->getAmount()+ $incr);
            }*/
        /*}
        else*/
        if($availablePosition < $order->getAmountSymbolFrom())
            throw new Exception("Cannot execute order because account '".$acc->getName()."' has an insufficient balance of $availablePosition of currency ".$order->getSymbolFrom()." to execute order of ".$order->getAmount() . " on ticker " . $order->getTickerSymbol()." for which a balance of ".$order->getAmountSymbolFrom(). " is required");
        
        
        if(($order->getCodeType() === OrderTypeEnum::MARKET) and ( strtolower($exchange->id) ==='hitbtc2')){
            $params['price'] = 0; // we need to provide a price of null, which ccxt does not do
            $params['timeInForce'] = 'IOC';
        }
        
        $order_from_exchange = $exchange->create_order(
                $order->getTickerSymbol(), 
                $order->getOrderTypeEnum()->getDescriptionEn(), 
                $order->getOrderSideEnum()->getDescriptionEn(), 
                $order->getAmount(), 
                $order->getPrice(),
                $params
                );
        self::getLogger()->addInfo('ExchangeAdapter - placed order on account '.$acc->getName().' with result '.json_encode($order_from_exchange));
        
        $order = self::parseOrder($order, $order_from_exchange);
        
        return $order;
    }
    
    /* returns the current balance, while trying to fix the balance first where possible (e.g. hitBTC)*/
    // TODO : after changing the balance, we should invalidate the cache
    private static function checkBalanceBeforeWithdrawal(Withdrawal $wd){
        // check balance
        $balance = ExchangeAdapter::fetchBalance($wd->getAccount(),Balance::TYPE_ACCOUNT);
        $position = $balance->getPosition($wd->getCurrency());
        // try to fix on hitBTC
        if(($position->getPositionFree() < $wd->getAmount()) and ($wd->getAccount()->getExchangeName() === 'hitBTC2')){
            // in hitBTC2, we should also check if we can transfer from the trading balance
            $shortageInAccountBalance = $wd->getAmount() - $position->getPositionFree();
            $balanceTrading = ExchangeAdapter::fetchBalance($wd->getAccount(),Balance::TYPE_TRADING);
            $positionTrading = $balanceTrading->getPosition($wd->getCurrency())->getPositionFree();    
            if($positionTrading >= $shortageInAccountBalance){
                // transfer to account balance first
                $exchange = self::getExchangeForAccount($wd->getAccount());
                $transactionId = $exchange->privatePostAccountTransfer(array(
                    'currency'=>$wd->getCurrency(),
                    'amount'=>$shortageInAccountBalance,
                    'type'=>'exchangeToBank'
                ));
                if(!isset($transactionId)){
                    throw new Exception('Failed to transfer '.$wd->getAmount().' from exchange to bank on hitBTC for currency '.$wd->getCurrency());
                }
                else return $wd->getAmount();
            }
            else return $positionTrading;
        }
        else return $position->getPositionFree();
        
    }
    
    private static function convertAmountToPrecision($exchangeName, $currency,$amount){
        $exchange = self::getExchange($exchangeName);
        $curData = self::getCurrency($exchangeName,$currency);
        $precision = $curData['precision'];
        return $exchange->truncate (floatval ($amount), $precision);
    }
    
    private static function getWithdrawalSecondaryAddressParamName($exchangeName){
        $res = array(
            'kraken'=>null,
            'bittrex'=>'paymentid',
            'poloniex'=>'paymentId',
            'hitBTC'=>'paymentId',
            'binance'=>'paymentid'
        );
                
        if(array_key_exists($exchangeName,$res))
            return $res[$exchangeName];
        else throw new Exception('No parameter name specified for withdrawal secondary address on exchange '.$exchangeName);
    }
    
    public static function placeWithdrawal(Withdrawal $wd){
        // get exchange object
        $acc = $wd->getAccount();
        $exchange = self::getExchangeForAccount($acc);
        $exchangeName = $acc->getExchangeName();
        if (!isset($exchange)) {
            throw new Exception('No exchange found for name ' . $exchangeName);
        }

        // check if exchange is supported
        $implementedExchanges = array('binance','bittrex','kraken','hitBTC2','gdax');
        if (in_array($exchangeName, $implementedExchanges) == false) {
            throw new Exception('Trying to place a withdrawal on exchange ' . $exchangeName . ' that has no implementation for withdrawal');
        }
        
        // set amount to right precision
        if($exchangeName === 'kraken'){
            $amount = $exchange->fee_to_precision($wd->getCurrency(), $wd->getAmount());
            $wd->setAmount($amount);
        }
        elseif($exchangeName !== 'binance'){
            $amount = self::convertAmountToPrecision($exchangeName,$wd->getCurrency(),$wd->getAmount());
            $wd->setAmount($amount);
        }
        
        // check (and if possible fix) balance
        $availablePosition = self::checkBalanceBeforeWithdrawal($wd);
        if($availablePosition < $wd->getAmount())
            throw new Exception("Cannot execute withdrawal because account '".$acc->getName()."' has an insufficient balance of $availablePosition to execute withrawal of ".$wd->getAmount());

        // set address information (name, secondary part)
        // Attention!!! important to implement that!
        $params = array();
        $secondaryAddressParamName = self::getWithdrawalSecondaryAddressParamName($exchangeName);
        if(isset($secondaryAddressParamName)){
            $params[$secondaryAddressParamName] = $wd->getAccountAddressTo()->getAddressSecondaryPart();
        }
        /*if(($exchangeName === 'binance') or ($exchangeName === 'bittrex')){
            $params = array(
                    'name'=>$wd->getAccountAddressTo()->getName(), // name = alias for this address
                    'paymentid'=>$wd->getAccountAddressTo()->getAddressSecondaryPart()
                ) ;
        }*/
        // for kraken, no need to specify the secondary part, as we need to pass the 'key' of the deposit address
        // that you have configured 
        elseif($exchangeName === 'kraken'){
            $addrs = $acc->getAccountAddressesWithdrawalForCurrency($wd->getCurrency());
            if($addrs->count() == 0)
                throw new Exception('Trying to place a withdrawal on exchange '.$exchangeName.' that has no withdrawal address specified for currency '.$wd->getCurrency);
            $addr = $addrs->getFirst();
            $params = array('key'=>$addr->getName());
        }
        
        
        // for hitbtc, we want to instruct the api to take the fees from the specified amount
        if($exchangeName === 'hitBTC2'){
            $params = array('includeFee'=>true);
        }
        
        // execute on exchange
        $data_from_exchange = $exchange->withdraw (
            $wd->getCurrency(),//$currency, 
            $wd->getAmount(),//$amount, 
            $wd->getAccountAddressTo()->getAddress(),//$address, 
            $params
        );

        // log results
        self::getLogger()->addInfo('ExchangeAdapter - placed withdrawal on exchange '.$exchangeName.' with result '.json_encode($data_from_exchange));

        if(($exchangeName == 'binance') or ($exchangeName == 'bittrex')){
            // Parse results : withdraw res = array('success'=>1,'msg'=>'Success','id'=>'4ce....ed5');
            if ($data_from_exchange['info']['success'] == 1) {
                $wd->setCodeState(OrderStateEnum::OPEN_STATE);
                if (array_key_exists('id', $data_from_exchange['info'])) {
                    $wd->setExchangeWithdrawalId($data_from_exchange['info']['id']);
                } elseif (array_key_exists('id', $data_from_exchange)) {
                    $wd->setExchangeWithdrawalId($data_from_exchange['id']);
                }
                $wd->setExchangeCreationDateTime(new DateTime());
            } else {
                throw new Exception('Placing withdrawal for ' . $wd->getCurrency() . ' on exchange ' . $exchangeName . ' failed with message ' . $exchange->last_http_response);
            }
        }
        elseif($exchangeName == 'kraken'){
            $id = null;
            if(array_key_exists('id',$data_from_exchange)){
                if(array_key_exists('refid',$data_from_exchange['id'])){
                    $id = $data_from_exchange['id']['refid'];
                }
            }
            if(isset($id)){
                $wd->setCodeState(OrderStateEnum::OPEN_STATE);
                $wd->setExchangeWithdrawalId($id);
                $wd->setExchangeCreationDateTime(new DateTime());
            }else {
                $msg = '';
                if(array_key_exists('info',$data_from_exchange)){
                    if(array_key_exists('error',$data_from_exchange))
                       $msg = $data_from_exchange['info']['error'];
                }
                throw new Exception('Placing withdrawal for ' . $wd->getCurrency() . ' on exchange ' . $exchangeName . ' failed with message ' . $msg. ' and http result '.$exchange->last_http_response);
            }
        }
        elseif($exchangeName === 'hitBTC2'){
            if(array_key_exists('id',$data_from_exchange)){
                $wd->setExchangeWithdrawalId($data_from_exchange['id']);
                $wd->setExchangeCreationDateTime(new DateTime());
                $wd->setCodeState(OrderStateEnum::OPEN_STATE);
            }
            else throw new Exception('Placing withdrawal for '. $wd->getCurrency(). ' on exchange ' . $exchangeName . ' has response without field id. response = '.json_encode($data_from_exchange). ' and http result '.$exchange->last_http_response);
        }
        elseif($exchangeName === 'hitBTC2'){
            if(array_key_exists('id',$data_from_exchange)){
                $wd->setExchangeWithdrawalId($data_from_exchange['id']);
                $wd->setExchangeCreationDateTime(new DateTime());
                $wd->setCodeState(OrderStateEnum::OPEN_STATE);
            }
            else throw new Exception('Placing withdrawal for '. $wd->getCurrency(). ' on exchange ' . $exchangeName . ' has response without field id. response = '.json_encode($data_from_exchange));
        }
        return $wd;
    }
    
    private static function getTradingFeeInformation($exchangeName, Ticker $ticker, $codeSide,$amount=1){
        // get exchange object
        $exchange = self::getExchange($exchangeName);
        if (!isset($exchange)) {
            throw new Exception('No exchange found for name ' . $exchangeName);
        }
        
        
        $exchange->load_markets();
        // get fee
        return $exchange->calculate_fee (
                $ticker->getSymbol(),
                null,//$type, 
                $codeSide,
                $amount, 
                $ticker->getPriceForOrderSide($codeSide),
                'taker',//$takerOrMaker = 'taker', 
                array()//$params = array ()
        ) ;
    }
    
    public static function getTradingFeeRate($exchangeName, Ticker $ticker, $codeSide){
        if($exchangeName === 'bl3p'){
            $market = self::getMarket($exchangeName, $ticker->getSymbol());
            return $market['taker'];
        }
        $info = self::getTradingFeeInformation($exchangeName, $ticker, $codeSide);
        if(array_key_exists('rate',$info)){
            return $info['rate'];
        }
        return null;
    }
    
    /*
     * Attention : the fee (= rate * amount * price) is in the source/start/from currency, so not necessarily in the same
     * currency as parameter $amount. If you do want it in the same currency, use method
     * getTradingFeeInSameCurrencyAsAmount
     */
    public static function getTradingFee($exchangeName,Ticker $ticker,$codeSide,$amount=1){
        $info = self::getTradingFeeInformation($exchangeName, $ticker, $codeSide,$amount);
        if(array_key_exists('cost',$info)){
            return $info['cost']; // the fee is not rounded when substracted
        }
        return 0;
    }
    
    public static function parseWithdrawal(Withdrawal $wd, $data){
        // check if exchange is supported
        $exchangeName = $wd->getAccount()->getExchangeName();
        $implementedExchanges = array('binance','bittrex','kraken','hitBTC2');
        if (in_array($exchangeName, $implementedExchanges) == false) {
            throw new Exception('Trying to parse a withdrawal on exchange ' . $exchangeName . ' that has no implementation for withdrawal');
        }
        
        if($exchangeName == 'bittrex'){
            /*
             * BITTREX: res = array(
             *      "success" : true,
                    "message" : "",
                    "result" : [{
                                    "PaymentUuid" : "b52c7a5c-90c6-4c6e-835c-e16df12708b1",
                                    "Currency" : "BTC",
                                    "Amount" : 17.00000000,
                                    "Address" : "1DeaaFBdbB5nrHj87x3NHS4onvw1GPNyAu",
                                    "Opened" : "2014-07-09T04:24:47.217",
                                    "Authorized" : true,
                                    "PendingPayment" : false,
                                    "TxCost" : 0.00020000,
                                    "TxId" : null,
                                    "Canceled" : true,
                                    "InvalidAddress" : false
                            }, {
                                   ...
                            }
                    ]
             * )
             */
            foreach($data['result'] as $data_item){
                if($data_item['PaymentUuid'] == $wd->getExchangeWithdrawalId()){
                    if($data_item['Authorized'] == true)
                        $wd->setCodeState(OrderStateEnum::OPEN_STATE);
                    if($data_item['PendingPayment'] == false)
                        $wd->setCodeState(OrderStateEnum::CLOSED_STATE);
                    if($data_item['Canceled'] == true)
                        $wd->setCodeState(OrderStateEnum::CANCELED_STATE);
                    if($data_item['InvalidAddress'] == true)
                        $wd->setCodeState(OrderStateEnum::ERROR_STATE);
                    $wd->setExchangeTransactionId($data_item['TxId']);
                    $wd->setAmount($data_item['Amount']);
                    $wd->setFee($data_item['TxCost']);
                    $dt = new DateTime($data_item['Opened']);
                    $wd->setExchangeCreationDateTime($dt);
                }
            }
        }
        elseif($exchangeName == 'hitBTC2'){
            $stateMapping = array(
                        'success'=>OrderStateEnum::CLOSED_STATE, // email sent
                        'pending'=>OrderStateEnum::OPEN_STATE, // cancelled
                        'failed'=>OrderStateEnum::ERROR_STATE // awaiting approval
                    );
            $wd->setCodeState($stateMapping[$data['status']]);
            $fee = array_key_exists('fee',$data) ? $data['fee'] : 0;
            $fee += array_key_exists('networkFee',$data) ? $data['networkFee'] : 0;
            $wd->setFee($fee); 
        }
        elseif($exchangeName == 'binance'){
            /* BINANCE:
            * getWithdrawHistory res = array(
            *      'success'=>1,
            *      'withdrawList'=>array(
            *          'txId'=>'3be....ed5',
            *          'successTime'=>1513346032000,
            *          'status'=>6, // 0(0:Email Sent,1:Cancelled 2:Awaiting Approval 3:Rejected 4:Processing 5:Failure 6Completed)
            *          'id'=>'4ce....ed5', // cf withdraw response
            *          'asset'=>'BTC',
            *          'applyTime'=>1513345433000,
            *          'amount'=>0.015,
            *          'address'=>'1ApX...3p6tu8',
            *          'addressTag'=>''
            *      )
            * ));
            */
            foreach($data['withdrawList'] as $data_item){
                if($data_item['id'] == $wd->getExchangeWithdrawalId()){
                    $stateMapping = array(
                        0=>OrderStateEnum::OPEN_STATE, // email sent
                        1=>OrderStateEnum::CANCELED_STATE, // cancelled
                        2=>OrderStateEnum::OPEN_STATE, // awaiting approval
                        3=>OrderStateEnum::REFUSED_STATE, // Rejected
                        4=>OrderStateEnum::OPEN_STATE, // Processing
                        5=>OrderStateEnum::ERROR_STATE, // Failure
                        6=>OrderStateEnum::CLOSED_STATE, // Completed
                    );
                    $wd->setCodeState($stateMapping[$data_item['status']]);
                    $wd->setExchangeTransactionId($data_item['txId']);
                    /* jef 21/12/2017 for some reason binance passes back wrong amounts
                     * $wd->setAmount($data_item['amount']);
                     */
                }
            }
        }
         elseif($exchangeName == 'kraken'){
             /* kraken:
              * res = array(
              *      'result'=>array(
              *         [0] => array(
              *             'time' => 1514380160k,
              *             'status' => 'Pending',
              *             'refid' => "A4EOFMU-TQM5BU-IJ37V5",
              *             'method' => "MLN",
              *             'info' => "0x1bb13aeb76cf328bb41724d4b1ed3bf409938744",
              *             'fee' => "0.00300",
              *             'asset' => "XMLN",
              *             'amount' => "0.2057597400",
              *             'aclass' => "currency"
              *         ),
              *         [1] => array(...)
              *      )
              * ));
              */
             $stateMapping = array(
                        'Open'=>OrderStateEnum::OPEN_STATE, // email sent
                        'Canceled'=>OrderStateEnum::CANCELED_STATE, // cancelled
                        'Closed'=>OrderStateEnum::CLOSED_STATE, // Completed
                        'Pending'=>OrderStateEnum::OPEN_STATE,
                        'Expired'=>  OrderStateEnum::ERROR_STATE,
                        'Success'=>OrderStateEnum::CLOSED_STATE,
                        'Initial'=>OrderStateEnum::NEW_STATE,
                        'Settled'=>OrderStateEnum::OPEN_STATE
                    );
             if(count($data ['error'])>0){
                 throw new Exception('Fetched withdrawal info for exchange kraken with errors: '.json_encode($data['error']));
             }
             if(!array_key_exists('result',$data)){
                 throw new Exception("Fetched withdrawal info for kraken, but did not find 'result' index in response array ".json_encode($data));
             }
             foreach($data['result'] as $resData){
                 if($resData['refid'] == $wd->getExchangeWithdrawalId()){
                     if(array_key_exists('status',$resData)) $wd->setCodeState($stateMapping[$resData['status']]);
                     if(array_key_exists('fee',$resData)) $wd->setFee($resData['fee']);
                     if(array_key_exists('amount',$resData)) $wd->setAmount($resData['amount']);
                 }
             }
         }
        
        return $wd;
    }
    
    public static function parseOrder(Order $order, $data){
         // get exchange object
        $acc = $order->getAccount();
        $exchange = self::getExchangeForAccount($acc);
        $exchangeName = $acc->getExchangeName();
        if (!isset($exchange)) {
            throw new Exception('No exchange found for name ' . $exchangeName);
        }
        
        // get info from exchange
        if(($exchangeName == 'kraken') or ($exchangeName =='poloniex')){
            if(array_key_exists('info',$data))
                $data = $data['info'];
            $parsed_res = $exchange->parse_order($data);
        }
        elseif($exchangeName === 'binance'){
            if(array_key_exists('info',$data))
                $data = $data['info'];
            $parsed_res = $exchange->parse_order($data);
            // get fee, because it is not in the response
            $ticker = self::getTicker($exchangeName, $order->getTickerSymbol());
            $fee = self::getTradingFee($exchangeName, $ticker, $order->getCodeSide(), $order->getAmount());
            $parsed_res['fee'] = array('cost'=>$fee);
        }
        elseif($exchangeName == 'hitBTC2'){
            if(array_key_exists('info',$data))
                $data = $data['info'];
            $parsed_res = $exchange->parse_order($data);
            // if closed, fetch trades to know price and fees
            $trades = $exchange->fetch_order_trades($parsed_res['info']['id']);
            $totalFee = 0;
            $totalQty = 0;
            $totalCost = 0;
            //$totalCost = 
            foreach($trades as $trade){
                $totalFee += $trade['fee']['cost'];
                $totalQty += $trade['amount'];
                $totalCost += $trade['cost'] ;//* $trade['price'];
            }
            $parsed_res['fee'] = array('cost'=>$totalFee);
            $parsed_res['filled'] = $totalQty;
            $parsed_res['cost'] = $totalCost;
            if(array_key_exists('status',$parsed_res) === false){
                $parsed_res['status'] = OrderStateEnum::OPEN_STATE; // todo : what if already filled?
                $dt = new DateTime();
                $parsed_res['timestamp'] = $dt->getTimestamp();
            }
        }
        elseif($exchangeName =='bittrex'){
            // for newly created orders, bittrex hardly returns any data apart from an id
            if(array_key_exists('OrderUuid',$data['info']))
                $parsed_res = $exchange->parse_order($data['info']);
            else{
                $id = $data['id'];
                if(!isset($id)){
                    throw new Exception('Failed to created order on bittrex. Returned data : '.json_encode($data));
                }
                $order->setExchangeOrderId($data['id']);
                $order->setCodeState(OrderStateEnum::OPEN_STATE);
                //$parsed_res['status'] = OrderStateEnum::OPEN_STATE; // todo : what if already filled?
                $dt = new DateTime();
                $order->setCreatedAt($dt);
                //$parsed_res['timestamp'] = $dt->getTimestamp();
                //$parsed_res['filled'] =0;
                return $order;
            }
        }
        
        // get the id (which is in different places for different exchange types
        $id = null;
        if(array_key_exists('id',$parsed_res)){
            $id = (strlen($parsed_res['id'])>0) ? $parsed_res['id'] : null ;
        }
        if(!isset($id) and array_key_exists('id',$data)){
            $id = (strlen($data['id']) > 0) ? $data['id'] : null;    
        }
        if(!isset($id) and array_key_exists('info',$data)){
            if(array_key_exists('uuid',$data['info']))
                $id = (strlen($data['info']['uuid'])>0) ? $data['info']['uuid'] : null;    
        }
        if(!isset($id) and array_key_exists('info',$parsed_res)){
            if(array_key_exists('id',$parsed_res['info']))
                $id = (strlen($parsed_res['info']['id'])>0) ? $parsed_res['info']['id'] : null;    
            if(array_key_exists('result',$parsed_res['info'])){
                if(array_key_exists('txid', $parsed_res['info']['result'])){
                    $txids = $parsed_res['info']['result']['txid'];
                    if(count($txids) === 1){
                        $id = array_values($txids)[0];
                    }
                }
                    
            }
        }
        
        //$ticker = self::getTicker($exchangeName,$order->getTickerSymbol());
        
        
        // put info on order
        $order->setExchangeOrderId($id);
        
        $status = null;
        if(array_key_exists('status',$parsed_res)) $status = $parsed_res['status'];
        if(!isset($status)) $status = OrderStateEnum::OPEN_STATE;
        $order->setCodeState($status);
        
        if(array_key_exists('timestamp',$parsed_res)) 
            $date = new DateTime($exchange->YmdHMS($parsed_res['timestamp']));
        elseif($order->getExchangeCreationDateTime() === null)
            $date = new DateTime();
        $order->setExchangeCreationDateTime($date);
        
        $filled = 0;
        if(array_key_exists('filled',$parsed_res)) $filled = $parsed_res['filled'];
        if(!isset($filled)) $filled = 0;
        $order->setFilled($filled);
        
        //$calcFeeRes = self::getTradingFee($exchangeName,$ticker,$order->getCodeSide(),$amount);
        //$amountMinusFees =  $amount - $calcFeeRes;
        if(array_key_exists('amount',$parsed_res)){
            $amount = $parsed_res['amount'];
            if(isset($amount))
                $order->setAmount($amount);
        }
        if(array_key_exists('fee',$parsed_res)){
            if(is_array($parsed_res['fee']))
                $order->setFee($parsed_res['fee']['cost']);
        }
        
        // try to use cost and filled amount to get most accurate price
        $price_actual = null;
        if(array_key_exists('cost',$parsed_res) and 
                array_key_exists('filled',$parsed_res) and 
                array_key_exists('fee',$parsed_res)){
            if((floatval($parsed_res['filled']) > 0) and isset($parsed_res['cost']) and isset($parsed_res['fee']['cost'])){
                if($order->isBuy())
                    //$price_actual = (abs(floatval($parsed_res['cost'])) - floatval($parsed_res['fee']['cost'])) / floatval($parsed_res['filled']);
                    $price_actual = abs(floatval($parsed_res['cost']))  / floatval($parsed_res['filled']);
                else
                    //$price_actual = (abs(floatval($parsed_res['cost'])) + floatval($parsed_res['fee']['cost'])) / floatval($parsed_res['filled']);
                    // for a sell, the 'cost' is before deduction of fee
                    $price_actual = abs(floatval($parsed_res['cost']))  / floatval($parsed_res['filled']);
            }
        }
        if(!isset($price_actual) and array_key_exists('average',$parsed_res)){
            $price_actual = $parsed_res['average'];
        }
        if(isset($price_actual))
            $order->setPriceActual($price_actual);
        
        return $order;
    }
    
    
    public static function getWithdrawalFee(Account $acc,$currency,$amount=1){
        // get exchange object
        $exchange = self::getExchangeForAccount($acc);
        $exchangeName = $acc->getExchangeName();
        if (!isset($exchange)) {
            throw new Exception('No exchange found for account ' . $acc->getName());
        }
        
        // first try the array in this class
        if (array_key_exists(strtolower($exchangeName), self::$witdrawalFees)) {
            if (array_key_exists($currency, self::$witdrawalFees[strtolower($exchangeName)])) {
                $fee = self::$witdrawalFees[strtolower($exchangeName)][$currency];
                if (isset($fee))
                    return $fee;
            }
        }
        
        if (
            $exchangeName == 'bittrex' ||
            $exchangeName == 'poloniex' ||
            $exchangeName == 'kraken' ||
            $exchangeName=='bitbtc2'
        ) {
            if (is_array($exchange->fees['funding']) === false) {
                $exchange->fees['funding'] = array('withdraw'=>array());
            }
            if (array_key_exists('withdraw',$exchange->fees['funding']) === false) {
                $exchange->fees['funding']['withdraw'] = array();
            }
            if (array_key_exists($currency,$exchange->fees['funding']['withdraw']) == false) {
                // fetch them once, and store them for later use
                $curs = $exchange->fetch_currencies();
                foreach ($curs as $cur => $info) {
                    $exchange->fees['funding']['withdraw'][$cur] = $info['fee'];
                }
            }
            if (array_key_exists($currency, $exchange->fees['funding']['withdraw'])) {
                return $exchange->fees['funding']['withdraw'][$currency];
            }
        } else if (
            $exchangeName == 'binance' ||
            $exchangeName == 'hitBTC2' ||
            $exchangeName == 'cex' ||
            $exchangeName == 'bitstamp' ||
            $exchangeName == 'yobit'
        ) {
            $withdrawalFees = $exchange->fees['funding']['withdraw'];
            if (array_key_exists($currency,$withdrawalFees)) {
                //return array('fee'=>$withdrawalFees[$currency]);
                return $withdrawalFees[$currency];
            } else {
                // try to get them from currency
                $cur = self::getCurrency($exchangeName, $currency);
                if (isset($cur)) {
                    if (array_key_exists('fee',$cur))
                        return $cur['fee'];
                }
            }
        } else {
            throw new Exception("Trying to get withdrawal fee on exchange $exchangeName that has no implementation for getting the fee");
        }
        return null;
    }
    
    private static function getLogger(){
        return Propel::getServiceContainer()->getLogger();
    }
    
    
    public static function setPriceConversionsOnBalance(Balance $balance, array $conversionCurrencies){
        // get currncies from balance with total position
        $curs = $balance->getCurrencies(true);
        // get conversions from cryptocompare
        $conversionPrices = CryptoCompareAdapter::getPriceConversions($curs, $conversionCurrencies);
        // adapt balance
        $balance->setConversionPrices($conversionPrices);
        
        return $balance;
    }
    
}


