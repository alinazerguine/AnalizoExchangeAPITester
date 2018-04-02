<?php

use Base\Account as BaseAccount;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * Skeleton subclass for representing a row from the 'account' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Account extends BaseAccount
{
    public function getExchangeKeysArray(){
        if ($this->getExchangeName() == 'bitstamp'){
            return array ('apiKey' => $this->getApiKey(), 'secret' => $this->getApiSecret(), 'uid' => $this->getUid());
        } 
        if ($this->getExchangeName() == 'cex'){
            return array ('apiKey' => $this->getApiKey(), 'secret' => $this->getApiSecret(), 'uid' => $this->getUid());
        }
        if ($this->getExchangeName() == 'gdax'){
            return array ('apiKey' => $this->getApiKey(), 'secret' => $this->getApiSecret(), 'password' => $this->getUid());
        }
        return array ('apiKey' => $this->getApiKey(), 'secret' => $this->getApiSecret());
    }
    
    public function isPublic(){
        $keys =  $this->getExchangeKeysArray();
        return !isset($keys['apiKey']) and !isset($keys['secret']);
    }
    
    public function getName(){
        $name = parent::getName();
        if(!isset($name) and $this->isPublic() and (strlen($this->getExchangeName())>0)){
            return $this->getExchangeName().' public';
        }
        else {
            return $name;
        }
    }
    
     public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false){
        $result = parent::toArray($keyType,$includeLazyLoadColumns,$alreadyDumpedObjects,$includeForeignObjects);
        if(is_array($result)){
            if(array_key_exists($this->getApiKeyKeyName(),$result)) unset($result[$this->getApiKeyKeyName()]);
            if(array_key_exists($this->getApiSecretKeyName(),$result)) unset($result[$this->getApiSecretKeyName()]);
            if(array_key_exists($this->getUid(),$result)) unset($result[$this->getUid()]);
        }
        
        return $result;
    }
    
    private function getApiKeyKeyName($keyType=null){
        $key = '';
        switch ($keyType) {
            case TableMap::TYPE_CAMELNAME:
                $key = 'apiKey';
                break;
            case TableMap::TYPE_FIELDNAME:
                $key = 'api_key';
                break;
            default:
                $key = 'ApiKey';
        }
        return $key;
    }
    
    private function getApiSecretKeyName($keyType=null){
        $key = '';
        switch ($keyType) {
            case TableMap::TYPE_CAMELNAME:
                $key = 'apiSecret';
                break;
            case TableMap::TYPE_FIELDNAME:
                $key = 'api_secret';
                break;
            default:
                $key = 'ApiSecret';
        }
        return $key;
    }
    
    public function getAccountAddressesDepositForCurrency($currency){
        $res = new ObjectCollection();
        $addrs = $this->getAccountAddresses();
        foreach($addrs as $addr){
            if(($addr->getCurrency() == $currency) and ($addr->getCodeType() == FundingTypeEnum::DEPOSIT)){
                $res->append($addr);
            }
        }
        return $res;
    }
    
    public function getAccountAddressesWithdrawalForCurrency($currency){
        $res = new ObjectCollection();
        $addrs = $this->getAccountAddresses();
        foreach($addrs as $addr){
            if(($addr->getCurrency() == $currency) and ($addr->getCodeType() == FundingTypeEnum::WITHDRAWAL)){
                $res->append($addr);
            }
        }
        return $res;
    }
}
