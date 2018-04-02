<?php

use Base\Ticker as BaseTicker;

/**
 * Skeleton subclass for representing a row from the 'ticker' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Ticker extends BaseTicker implements serializable
{
    public static function createFromExchangeData(array $exchangeData,$exchangeName) : ?Ticker{
        $res = new Ticker();
        return $res->hydrateFromExchange($exchangeData,$exchangeName);
    }
    
    public function hydrateFromExchange(array $exchangeData, $exchangeName) : ?Ticker{
        $this->setBid($exchangeData['bid']);
        $this->setAsk($exchangeData['ask']);
        $this->setVolume($exchangeData['baseVolume']);
        $this->setHigh($exchangeData['high']);
        $this->setLast($exchangeData['last']);
        $this->setLow($exchangeData['low']);
        if(array_key_exists('isActive',$exchangeData)) 
            $this->setIsActive($exchangeData['isActive']);
        else $this->setIsActive($this->hasPrices ());
        
        $symbol = $exchangeData['symbol'];
        $symbolParts = explode('/',$symbol);
        $this->setSymbol($symbol);
        if(count($symbolParts) === 2){
            $this->setCurrencyBase($symbolParts[0]);
            $this->setCurrencyQuote($symbolParts[1]);
        }
        $this->setExchangeName($exchangeName);
        $this->setFeeRateBuy(0);
        $this->setFeeRateSell(0);
        
        if($this->getIsActive() != false){
            $this->addMatrixItem(MatrixItem::createFromTicker($this, OrderSideEnum::BUY));
            $this->addMatrixItem(MatrixItem::createFromTicker($this, OrderSideEnum::SELL));
        }
        
        return $this;
    }

    
    public function hasBid(){
        $price = $this->getBid();
        return (isset($price) and ($price != 0));
    }
    
    public function hasAsk(){
         $price = $this->getAsk();
        return (isset($price) and ($price != 0));
    }
    
    public function getMidPrice(){
        return ($this->getBid() + $this->getAsk())/2;
    }
    
    public function getPriceForOrderSide($codeOrderSide){
        // ETH/BTC : for a BUY, the price is the ask
        if($codeOrderSide == OrderSideEnum::BUY){
            if(!$this->hasAsk()) return null;
            return $this->getAsk();
        }
        elseif($codeOrderSide == OrderSideEnum::SELL){
            if(!$this->hasBid()) return null;
            return $this->getBid();
        }
        else
            return null;
    }
    
    public function hasPrices(){
        return $this->hasBid() and $this->hasAsk();
    }
    
    public function getFeeRate($codeSide){
        switch($codeSide){
            case OrderSideEnum::BUY : return $this->getFeeRateBuy();
            case OrderSideEnum::SELL: return $this->getFeeRateSell();
            default:
                throw new Exception('Trying to get fee rate from Ticker with unexpected side ' . $codeSide);
        }
    }
    
    public function getCodeOrderSideForSymbolFrom($symbolFrom){
        return ($this->getCurrencyBase()===$symbolFrom) ? 'SELL' : 'BUY';
    }
    
    public function getConversionFactor($codeOrderSide){
        if($this->hasPrices() === false)
            throw new Exception('Trying to get converionfactor on ticker '.$this->getSymbol(). ' on exchange '.$this->getExchangeName().' without prices');
        return $codeOrderSide === 'BUY' ? 1/$this->getAsk() : $this->getBid();
    }
            
    /*public function __toString(){
       $cntMis = isset($this->collMatrixItems) ? $this->collMatrixItems->count() : 0;
       return parent::__toString()."nbr of matrix items = ".$cntMis.PHP_EOL;
    }*/
    
   
    /*public function __sleep()
    {
        //as opposed to the BaseTicker class, we don't want to clear the MatrixItems, as we want to serialize them as well
        //$this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }*/
    
    public function serialize (  ){
        return $this->toJson(true);
    }
    public function unserialize($data) {
        return $this->fromJson($data);
    }
    
    public function fromJson($json){
        parent::fromJson($json);
        $arr = json_decode($json,true);
        if(array_key_exists('MatrixItems',$arr)){
            foreach($arr['MatrixItems'] as $arrItem){
                $item = new MatrixItem();
                $item->fromJson(json_encode($arrItem));
                $this->addMatrixItem($item);
            }
        }
    }
            
}
