<?php

use Base\MatrixItem as BaseMatrixItem;

/**
 * Skeleton subclass for representing a row from the 'matrix_item' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class MatrixItem extends BaseMatrixItem
{
    public static function createFromTicker(Ticker $ticker, string $codeOrderSide) : ?MatrixItem{
        $res = new MatrixItem();
        return $res->hydrateFromTicker($ticker,$codeOrderSide);
    }
    
    public function hydrateFromTicker(Ticker $ticker, string $codeOrderSide) : ?MatrixItem{
        if($codeOrderSide === OrderSideEnum::BUY){
            if($ticker->hasPrices() != true)
                throw new Exception('trying to hydrate a matrixitem for ticker '.$ticker->getSymbol(). ' on exchange ' . $ticker->getExchangeName());
            $this->setConversionRate(1/$ticker->getAsk());
            $this->setCurrencyFrom($ticker->getCurrencyQuote());
            $this->setCurrencyTo($ticker->getCurrencyBase());
            $this->setFeeRate($ticker->getFeeRateBuy());
        }
        elseif($codeOrderSide === OrderSideEnum::SELL){
            $this->setConversionRate($ticker->getBid());
            $this->setCurrencyFrom($ticker->getCurrencyBase());
            $this->setCurrencyTo($ticker->getCurrencyQuote());
            $this->setFeeRate($ticker->getFeeRateSell());
        }
        
        $this->setCodeOrderSideEnum($codeOrderSide);
        $this->setTicker($ticker);
        return $this;
    }
}
