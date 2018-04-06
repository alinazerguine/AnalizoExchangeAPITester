<?php

require_once __DIR__.'/../controller/ExchangeAdapter.php';
require_once __DIR__.'/../controller/CacheHandler.php';

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../model/generated-conf/config.php';

/*
 * Configure assertion tests
 */
// Active assert and make it quiet
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 0);
// Create a handler function
function my_assert_handler($file, $line, $code, $desc = null)
{
    echo "Assertion failed on line $line at $file: $code";
    if ($desc) {
        echo ": $desc";
    }
    echo "<br/>";
}
// Set up the callback
assert_options(ASSERT_CALLBACK, 'my_assert_handler');



$exchangeName = 'yobit';


CacheHandler::clearCache();

/*
 * Test getMarkets
 */
$markets = ExchangeAdapter::getMarkets($exchangeName);
assert(isset($markets),"getMarkets for $exchangeName returns result null");
assert(is_array($markets),"getMarkets for $exchangeName does not return an array");
assert(count($markets),"getMarkets for $exchangeName returns an empty array");


/*
 * Test getTickers
 */
$tickers = ExchangeAdapter::getTickerCollection($exchangeName);
assert(isset($tickers),"getTickers for $exchangeName returns result null");
assert($tickers->count() > 0,"getTickers for $exchangeName returns an empty array, might be that none of the returned tickers are active.");
foreach($tickers as $ticker){
    $symbol = $ticker->getSymbol();
    $feeRateBuy = $ticker->getFeeRate(OrderSideEnum::BUY);
    assert(isset($feeRateBuy),"getTickers for $exchangeName does not return a fee rate for buy side for ticker $symbol");
    $feeRateSell = $ticker->getFeeRate(OrderSideEnum::SELL);
    assert(isset($feeRateSell),"getTickers for $exchangeName does not return a fee rate for sell side for ticker $symbol");
    assert($ticker->hasPrices(),"getTickers for $exchangeName does not return prices for ticker $symbol");
    assert($ticker->getCurrencyBase() !== null,"getTickers for $exchangeName does not return a base currency for ticker $symbol");
    assert($ticker->getCurrencyQuote() !== null,"getTickers for $exchangeName does not return a quote currency for ticker $symbol");
    assert($ticker->getVolume() !== null,"getTickers for $exchangeName does not return a volume for ticker $symbol");
}

/*
 * Test getCurrencies
 */
$currencies = ExchangeAdapter::getCurrencies($exchangeName);
assert(isset($currencies),"getCurrencies for $exchangeName returns result null");
assert(count($currencies) > 0,"getCurrencies for $exchangeName returns an empty array");
$properties = array('active','id','code','precision','fee');
foreach($currencies as $currency){
    foreach($properties as $property){
        assert(array_key_exists($property, $currency), "getCurrencies for $exchangeName does not have property '$property'");
    }
}

/*
 * Test getOrderBooks
 */
$ticker = $tickers->getFirst();
$orderBook = ExchangeAdapter::getOrderBook($exchangeName, $ticker->getSymbol());
assert(isset($orderBook),"getOrderBook for $exchangeName returns result null");

/*
 * Test withdrawal fees
 */
$account = new Account();
$account->setExchangeName($exchangeName);
$account->setName('dummy'.$exchangeName);
$currency = array_values($currencies)[0]['code'];
$fee = ExchangeAdapter::getWithdrawalFee($account,$currency);
assert(isset($fee),"getWithdrawalFee for $exchangeName for currency $currency returns result null");