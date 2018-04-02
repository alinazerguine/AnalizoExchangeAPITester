<?php
//require_once __DIR__.'/Ticker.php';

class OrderBookLine implements JsonSerializable{
    private $price;
    private $volume;
    //private $volumeCumul;
    //private $amountCumul;
    private $codeSide;
    private $feePct;
    
    public function __construct( $price, $volume, $codeSide,$feePct){
        $this->price = $price;
        $this->setVolume($volume);
        //$this->volumeCumul = $volumeCumul;
        //$this->amountCumul = $amountCumul;
        $this->codeSide = $codeSide;
        $this->feePct = $feePct;
    }
    
    public function getPrice() { return $this->price; }
    public function getPriceFactor(){ 
        return ($this->codeSide==OrderSideEnum::BUY) ? 1/$this->price : $this->price;
    }
    public function getVolume() { return $this->volume; }
    public function getFeePct(){ return $this->feePct; }
    public function getVolumeFactor(){ 
        return ($this->codeSide==OrderSideEnum::BUY) ? 1/$this->volume : $this->volume;
    }
    /*public function getVolumeCumul() { return $this->volumeCumul; }
    public function getAmountCumul() { return $this->amountCumul; }*/
    public function getAmount() { return $this->volume * $this->price; }
    
    /*private function getVolumeBeforeLine() { return $this->volumeCumul - $this->volume; }
    private function getAmountBeforeLine() { return $this->amountCumul - $this->volume*$this->price; }
    private function getPriceBeforeLine(){ 
        if($this->getVolumeBeforeLine() > 0)
            return $this->getAmountBeforeLine() / $this->getVolumeBeforeLine(); 
        else return null;
    }*/
    
    /*public function getAvgWeightedPrice($volume=null) { 
        if(!isset($volume)) 
            return $this->amountCumul / $this->volumeCumul; 
        else{
            return ($this->getAmountBeforeLine() + $this->getAmount()) / ($this->getVolumeBeforeLine() + $volume);
        }
    }*/
    public function getCodeSide() { return $this->codeSide; }
    
    public function setVolume($volume){
        // check if volume is not too small and if so, set to 0
        $volume = ($volume<0.000001) ? 0 : $volume;
        
        $this->volume = $volume;
        //$this->volumeCumul = $this->volumeCumul - $volume;
        //$this->amountCumul = $this->amountCumul - $volume*$this->price;
    }
    
    /* conversion factor does not take into account fees
     * 
     */
    public function getConversionFactor(){
        //return ($this->codeSide===OrderSideEnum::BUY) ? 1/$this->getAvgWeightedPrice($volume) : $this->getAvgWeightedPrice($volume);
        return ($this->codeSide===OrderSideEnum::BUY) ? 1/$this->price : $this->price;
    }
    
    /*
     * this method does take into account fees
     */
    /*public function getFromAmountForToAmount($amount){
        // ETH/BTC BUY @0.05 to 2 ETH => from amount = 2*0.05*(1+fee)
        //return $amount / $this->getConversionFactor() * (1+$this->feePct);
        $amountOnThisLine = $amount - $this->getAmountBeforeLine();
        $amountBeforeLine = $this->getAmountBeforeLine();
        if($this->codeSide===OrderSideEnum::BUY){
            $fromAmountBeforeLine = ($amountBeforeLine >0) ? $this->getAmountBeforeLine() * $this->getPriceBeforeLine() * (1+$this->feePct) : 0;
            $fromAmountOnThisLine = $amountOnThisLine * $this->price * (1+$this->feePct);
        }
        else{
            $fromAmountBeforeLine = ($amountBeforeLine > 0) ? $this->getAmountBeforeLine() / $this->getPriceBeforeLine() * (1+$this->feePct) : 0;
            $fromAmountOnThisLine = $amountOnThisLine / $this->price * (1+$this->feePct);
        }
        return $fromAmountBeforeLine + $fromAmountOnThisLine;
    }*/
    
    public function getFromAmountForToAmount($amount){
        if ($this->codeSide===OrderSideEnum::BUY) 
            return $amount * $this->price * (1+$this->feePct);
        else
            return $amount / $this->price * (1+$this->feePct);
    }
    
    /*
     * this method does take into account fees
     */
    /*public function getToAmountForFromAmount($amount){
        // ETH/BTC BUY @0.05 from 2 BTC => to amount = 2/0.05*(1-fee)
        //return $amount * $this->getConversionFactor() * (1-$this->feePct);
        $amountOnThisLine = $amount - $this->getAmountBeforeLine();
        $amountBeforeLine = $this->getAmountBeforeLine();
        if($this->codeSide===OrderSideEnum::BUY){
            $toAmountBeforeLine = ($amountBeforeLine>0) ? $this->getAmountBeforeLine() / $this->getPriceBeforeLine() * (1-$this->feePct) : 0;
            $toAmountOnThisLine = $amountOnThisLine / $this->price * (1-$this->feePct);
        }
        else{
            $toAmountBeforeLine = ($amountBeforeLine>0) ?  $this->getAmountBeforeLine() / $this->getPriceBeforeLine() * (1-$this->feePct) : 0;
            $toAmountOnThisLine = $amountOnThisLine / $this->price * (1-$this->feePct);
        }
        return $toAmountBeforeLine + $toAmountOnThisLine;
    }*/
    
    public function getToAmountForFromAmount($amount){
        if ($this->codeSide===OrderSideEnum::BUY) 
            return $amount / $this->price * (1-$this->feePct);
        else
            return $amount * $this->price * (1-$this->feePct);
    }
    
    /*
     * 
     */
    public function getVolumeForFromAmount($amount){
        // ETH/BTC BUY @0.05 from 2 BTC => volume = 2*(1-fee)/0.05 = 40*(1-fee)
        if ($this->codeSide===OrderSideEnum::BUY) {
            //return $amount * (1-$this->feePct) / $this->getAvgWeightedPrice($amount); 
            return $this->getToAmountForFromAmount($amount);
        }
        // ETH/BTC SELL @0.05 from 2 ETH => volume = 2
        return $amount;
    }
    
    
    /*
     * returns the amount in the from currency that would be required for trading
     * the entire volume
     */
    public function getMaxFromAmount(){
        //return ($this->codeSide===OrderSideEnum::BUY) ? $this->volumeCumul * $this->getAvgWeightedPrice() * (1+$this->feePct) : $this->volumeCumul;
        return ($this->codeSide===OrderSideEnum::BUY) ? $this->volume * $this->price * (1+$this->feePct) : $this->volume;
    }
    
    /*
     * returns the amount in the to currency that would be the result of trading
     * the entire volume
     */
    public function getMaxToAmount(){
        //return ($this->codeSide===OrderSideEnum::BUY) ? $this->volumeCumul : $this->volumeCumul * $this->getAvgWeightedPrice() * (1- $this->feePct);
        return ($this->codeSide===OrderSideEnum::BUY) ? $this->volume : $this->volume * $this->price * (1- $this->feePct);
    }
    
    public function __toString(){
        // price, volume, side, fee
        return $this->codeSide . '      ||      '. $this->volume . '      ||      '.$this->price . '      ||      '. $this->feePct;
    }
    
    public function jsonSerialize() {
        $res = array();
        $res['volume'] = $this->volume ;
        $res['price'] = $this->price ;
        //$res['feePct'] = $this->feePct ;
        return $res;
    }
}

class OrderBook implements JsonSerializable{
    //private $ticker;
    private $orderBookLines = array();
    private $feePct;
    
    public function __construct(/*Ticker $ticker,*/ $orderBookLines = array(), $feePct = null){
        //$this->ticker = $ticker;
        $this->orderBookLines = $orderBookLines;
        $this->feePct = $feePct;
    }
    
    public function getFeePct(){
        if(!isset($this->feePct)){
            $firstLine = $this->getFirstLine(OrderSideEnum::BUY);
            if(!isset($firstLine)) $firstLine = $this->getFirstLine(OrderSideEnum::SELL);
            if(isset($firstLine)) return $firstLine->getFeePct ();
        }
        return $this->feePct;
    }
    
    public function pushLine(OrderBookLine $line, $codeSide){
        $this->orderBookLines[$codeSide][] = $line;
    }
    
    public function getTotalVolume($codeSide){
        $res = 0;
        foreach($this->orderBookLines[$codeSide] as $line){
            $res += $line->getVolume();
        }
        return $res;
    }
    
    public function getTotalAmount($codeSide){
        $res = 0;
        foreach($this->orderBookLines[$codeSide] as $line){
            $res += $line->getAmount();
        }
        return $res;
    }
    
    /*
     * Givent a volume, gets the avg price for execution
     */
    public function getAvgWeightedPriceForVolume($codeSide, $volume){
        if($this->getTotalVolume($codeSide) < $volume) throw new Exception('Trying to calculate the avg price for a volume that is larger that the book size');
        $volumeCumul = 0;
        $amountCumul = 0;
        foreach($this->orderBookLines[$codeSide] as $line){
            $volumeCumul += $line->volume;
            $amountCumul += $line->volume*$line->price;
            if($volumeCumul >= $volume){
                // last line to process
                $lineVolumeSurplus = $volumeCumul - $volume;
                return ($amountCumul - ($lineVolumeSurplus*$line->getPrice())) / $volume;
            }
        }
        return null;
    }
    
    /*
     * Given an amount (in the other currency, so for ETH/BTC e.g. in BTC), get the avg price of execution
     */
    public function getAvgWeightedPriceForAmount($codeSide, $amount){
        if($this->getTotalAmount($codeSide) < $amount) throw new Exception('Trying to calculate the avg price for an amount that is larger that the book size');
        $volumeCumul = 0;
        $amountCumul = 0;
        foreach($this->orderBookLines[$codeSide] as $line){
            $volumeCumul += $line->volume;
            $amountCumul += $line->volume*$line->price;
            if($amountCumul >= $amount){
                // last line to process
                $lineAmountSurplus = $amountCumul - $amount;
                return $amount / ($volumeCumul - ($lineAmountSurplus/$line->getPrice()));
            }
        }
        return null;
    }
    
    
    /*
     * Returns the conversion factor to convert the amount of the source currency 
     * into the amount of the destination currency you would get for the trade amount
     * Mind that this does not take into account any fees;
     */
    public function getConversionFactorForVolume($codeSide, $volume){
        $avgPrice = $this->getAvgWeightedPriceForVolume($codeSide, $volume);
        return ($codeSide === OrderSideEnum::BUY) ? 1/$avgPrice : $avgPrice;
    }
    
    public function getFirstLine($codeSide) : ?OrderBookLine{
        if(array_key_exists($codeSide,$this->orderBookLines) === false) return null;
        if(count($this->orderBookLines[$codeSide]) == 0) return null;
        $minKey = array_keys($this->orderBookLines[$codeSide])[0];
        return $this->orderBookLines[$codeSide][$minKey];
    }
    
    public function removeFirstLine($codeSide){
        array_shift($this->orderBookLines[$codeSide]);
    }
    
    /*
     * pops volume off the stack of orderlines (i.e. removes that volume)
     * Returns the unpopped volume (0 if all has been popped, > 0 if the books are smaller than the volume)
     */
    public function popVolume($codeSide, $volume){
        $volumeStillToPop = $volume;
        while(($volumeStillToPop > 0) and ($this->isEmpty($codeSide)===false)){
            $line = $this->getFirstLine($codeSide);
            if($line->getVolume() <= $volumeStillToPop){
                $volumeStillToPop = $volumeStillToPop - $line->getVolume();
                $this->removeFirstLine($codeSide);
            }
            else{
                $line->setVolume($line->getVolume()-$volumeStillToPop);
                if($line->getVolume() == 0) { // possible if the remaining volume is too small
                    $this->removeFirstLine($codeSide);
                }
                else{
                    $this->orderBookLines[$codeSide][0] = $line;
                }
                $volumeStillToPop = 0;
            }
        }
        return $volumeStillToPop;
    }
    
    public function isEmpty($codeSide){
        return count($this->orderBookLines[$codeSide]) === 0;
    }
    
    private function hydrateSide($dataFromExchange, $codeSide,$feeRate){
        foreach ($dataFromExchange as $line){
            $volume = $line[1];
            $price = $line[0];
            
            if ($volume<0.000001) {
                // don't add very small volumes, as they will cause issues in calculations
                continue;
            }
            $bookLine = new OrderBookLine(
                    $price,//$price, 
                    $volume,//$volume,
                    //$cumul,//$volumeCumul, 
                    //$somprod,//$amountCumul, 
                    $codeSide, // $codeSide
                    $feeRate
            );
            $this->orderBookLines[$codeSide][] = $bookLine;
        }
    }
    
    public function hydrate($dataFromExchange, $feeRateBuy, $feeRateSell){
        $this->hydrateSide($dataFromExchange['asks'], OrderSideEnum::BUY,$feeRateBuy);
        $this->hydrateSide($dataFromExchange['bids'], OrderSideEnum::SELL,$feeRateSell);
        
        return $this;
    }
    
    public function __toString(){
        $res = "BUY:\n";
        $res .=  "side      ||      volume      ||      price      ||      fee\n";
        foreach($this->orderBookLines[OrderSideEnum::BUY] as $line) {
            $res .= $line . "\n";
        }
        $res .= "\nSELL:\n";
        $res .=  "side      ||      volume      ||      price      ||      fee\n";
        foreach($this->orderBookLines[OrderSideEnum::SELL] as $line) {
            $res .= $line . "\n";
        }
        return $res;
    }
    
    public function jsonSerialize() {
        $res = array();
        $res['feePct'] = $this->getFeePct();
        $res['bid'] = array();
        foreach($this->orderBookLines[OrderSideEnum::BUY] as $line) {
            $res['bid'][] = $line->jsonSerialize();
        }
        $res['ask'] = array();
        foreach($this->orderBookLines[OrderSideEnum::SELL] as $line) {
            $res['ask'][] = $line->jsonSerialize();
        }
        return $res;
    }
}

