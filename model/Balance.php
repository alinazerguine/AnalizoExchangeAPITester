<?php
require_once __DIR__.'/../vendor/autoload.php';

class BalancePositionConversion{
    public $currency;
    public $position;
    public function __construct($currency, $position){
        $this->position = $position;
        $this->currency = $currency;
    }
}

class BalancePosition{
    private $position = null;
    private $currency = null;
    private $conversionPrices = array();
    
    const TYPE_FREE = 'free';
    const TYPE_USED = 'used';
    const TYPE_TOTAL = 'total';
    
    
    function __construct($currency,$positionData, $conversionPrices = array()){
        $this->position = $positionData;
        $this->currency = $currency;
        $this->setConversionPrices($conversionPrices);
    }
    
    /* conversions should be in the shape of array('BTC'=>0.01377, 'USD'=>129.55) */
    public function setConversionPrices(array $conversionPrices){
        $this->conversionPrices = $conversionPrices;
        $this->calculateConversions();
    }
    
    private function calculateConversions(){
        foreach($this->conversionPrices as $cur=>$convPrice){
            $this->position[$cur]['used'] = $this->position['used'] * $convPrice;
            $this->position[$cur]['total'] = $this->position['total'] * $convPrice;
            $this->position[$cur]['free'] = $this->position['free'] * $convPrice;
        }
    }
    
    public function addPosition(BalancePosition $pos){
        if($pos->getCurrency() !== $this->getCurrency())
            throw new Exception('Trying to add a position of currency '.$pos->getCurrency().' to a position of currency '.$this->getCurrency());
        $this->position['used'] = $this->getPositionUsed() + $pos->getPositionUsed();
        $this->position['total'] = $this->getPositionTotal() + $pos->getPositionTotal();
        $this->position['free'] = $this->getPositionFree() + $pos->getPositionFree();
        $this->calculateConversions();
        return $this;
    }
    
    public function getCurrency(){
        return $this->currency;
    }
    
    public function getPosition($type = null){
        if(!isset($type))
            return $this->position;
        switch($type){
            case self::TYPE_FREE : return $this->getPositionFree(); break;
            case self::TYPE_USED : return $this->getPositionUsed(); break;
            case self::TYPE_TOTAL : return $this->getPositionTotal(); break;
            default : return null;
        }
    }
    
    public function getPositionConverted($currency, $type=null){
        if(!isset($type))
            return $this->position[$currency];
        switch($type){
            case self::TYPE_FREE : return $this->getPositionFree($currency); break;
            case self::TYPE_USED : return $this->getPositionUsed($currency); break;
            case self::TYPE_TOTAL : return $this->getPositionTotal($currency); break;
            default : return null;
        }
    }
    
    public function getPositionUsed($currency=null){
        if(isset($currency))
            return $this->position[$currency]['used'];
        else
            return $this->position['used'];
    }
    
    public function getPositionTotal($currency=null){
        if(isset($currency))
            return $this->position[$currency]['total'];
        else
            return $this->position['total'];
    }
    
    public function getPositionFree($currency=null){
         if(isset($currency))
            return $this->position[$currency]['free'];
        else
            return $this->position['free'];
    }
    
    public function __toString(){
        $res = 'currency : '.$this->getCurrency();
        $res .= ' total : '.$this->getPositionTotal();
        $res .= ', free : '.$this->getPositionFree();
        $res .= ', used : '.$this->getPositionUsed();
        foreach($this->conversionPrices as $currency=>$conversion){
            $convPos = $this->position[$currency];
            $str = 'currency : '.$currency;
            $str .= ' total : '.$convPos['total'];
            $str .= ', free : '.$convPos['free'];
            $str .= ', used : '.$convPos['used'];
            $res .= ' ['.$str.'] ';
        }
        return $res;
    }
    
    public function toArray(){
        $res = array();
        $res['total'] = $this->getPositionTotal();
        $res['free'] = $this->getPositionFree();
        $res['used'] = $this->getPositionUsed();
        $res['currency'] = $this->getCurrency();
        return $res;
    }
}


class Balance implements JsonSerializable{
    //private $balance;
    private $account;
    private $timestamp;
    private $positions = array();
    
    const TYPE_TRADING = 'TRADING'; 
    const TYPE_ACCOUNT = 'ACCOUNT';
    const TYPE_TOTAL = 'TOTAL';
    
    function __construct(Account $account, $balanceData, $timestamp = null){
        //$this->balance = $balanceData;
        $this->account = $account;
        $this->timestamp = isset($timestamp) ? $timestamp : date_timestamp_get(date_create());
        
        $ignoreArray = array('used','total','info','free');
        foreach($balanceData as $cur=>$pos){
            if(in_array($cur,$ignoreArray) === false){
                $balPos = new BalancePosition($cur,$pos);
                $this->setPosition($balPos);
            }
        }
    }
    
    /* conversionPrices should be in format array('NEO'=>array('BTC'=>0.01377,'USD'=>129.55), 'XLM'=> array(...),...) */
    public function setConversionPrices(array $conversionPrices){
        foreach($conversionPrices as $currency=>$conversionPrices){
            $pos = $this->getPosition($currency);
            if(isset($pos)){
                $pos->setConversionPrices($conversionPrices);
                $this->setPosition($pos);
            }
        }
    }
    
    public function getCurrencies($onlyWithTotalPosition=false){
        $res = array();
        foreach($this->getPositions() as $cur=>$pos){
            if(($pos->getPositionTotal() != 0) or !$onlyWithTotalPosition)
                $res[] = $cur;
        }
        return $res;
    }
    
    public function addBalance(Balance $newBalance){
            foreach($newBalance->getPositions() as $newPos){
                $cur = $newPos->getCurrency();
                $curPos = $this->getPosition($cur);
                if(isset($curPos)){
                    $sumPos = $curPos->addPosition($newPos);
                    $this->setPosition($sumPos);
                }
                else{
                    $this->setPosition($newPos);
                }
            }
            return $this;
        }
    
    
    public function setPosition(BalancePosition $pos){
        $cur = $pos->getCurrency();
        $this->positions[$cur] = $pos;
        
        
        /*$this->balance[$pos->getCurrency()] = $pos->toArray();
        $this->balance['used'][$cur] = $pos->getPositionUsed();
        $this->balance['free'][$cur] = $pos->getPositionFree();
        $this->balance['total'][$cur] = $pos->getPositionTotal();*/
    }
    
    public function hasFreeBalance($currency){
        $pos = $this->getPosition($currency);
        if(isset($pos))
            return $pos->getPositionFree() > 0;
        else
            return false;
    }
    
    public function getPosition($currency) : ?BalancePosition{
        if(array_key_exists($currency,$this->positions)){
            return $this->positions[$currency];
        }
        return null;
    }
    
    public function getPositions($onlyFree = false) : array{
        $res = array();
        /*$ignoreArray = array('used','total','info','free');
        foreach($this->balance as $cur=>$pos){
            if(in_array($cur,$ignoreArray) === false){
                $balpos = new BalancePosition($cur,$pos);
                if(!$onlyFree or ($balpos->getPositionFree() > 0))
                    $res[$cur] = $balpos;
            }
        }*/
        if($onlyFree){
            foreach($this->positions as $cur=>$position){
                $free = $position->getPositionFree();
                if(isset($free)){
                    if($free != 0) $res[$cur] = $position;
                }
            }
        }
        else $res = $this->positions;
        
        return $res;
    }
    
    private function getUpdateDateTime(){
        $dt = new DateTime();
        $dt->setTimestamp($this->balance['info']['updateTime']);
        return $dt;
    }
    
    public function __toString(){
        $res = '';
        foreach($this->getPositions() as $cur=>$pos){
            if($pos->getPositionTotal() != 0)
                $res .= $pos . '<br/>';
        }
        return $res;
    }
    
    public function jsonSerialize() {
        $res = array();
        $res['account'] = $this->account->toArray();
        $res['positions'] = array();
        foreach($this->getPositions() as $cur=>$pos){
            $res['positions'][$cur] = $pos->toArray();
        }
        foreach($this->getPositions(true) as $cur=>$pos){
            $res['positions_free'][$cur] = $pos->toArray();
        }
        return $res;
    }
}


