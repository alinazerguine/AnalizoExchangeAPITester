<?php

class Deposit {
    
    private $txId = null;
    private $codeState;
    private $tsCreation;
    private $currency;
    private $amount;
    private $address;
    private $addressSecondaryPart;
    
    function __construct($txId,$codeState,$currency,$amount,$address, $tsCreation=null, $addressSecondaryPart=null){
        $this->txId = $txId;
        $this->codeState = $codeState;
        $this->tsCreation = $tsCreation;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->address = $address;
        $this->addressSecondaryPart = $addressSecondaryPart;
    }
    
    public function getTxId(){
        return $this->txId;
    }
    
    public function getCodeState(){
        return $this->codeState;
    }
    
    public function getCurrency(){
        return $this->currency;
    }
    
    public function getAmount(){
        return $this->amount;
    }
    
    public function getAddress(){
        return $this->address;
    }
    
    public function getTimestampCreation(){
        return $this->tsCreation;
    }
    
    public function getAddressSecondaryPart(){
        return $this->addressSecondaryPart;
    }
}
