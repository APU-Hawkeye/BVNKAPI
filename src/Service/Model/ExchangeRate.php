<?php
declare(strict_types=1);

namespace APUHawkeye\BVNKAPI\Service\Model;

class ExchangeRate
{
    protected ?string $_exchangeRate;

    protected ?string $_baseCurrency;

    protected ?string $_counterCurrency;

    /**
     * @return string
     */
    public function getExchangeRate(): string
    {
        return $this->_exchangeRate;
    }

    /**
     * @param string|null $exchangeRate
     * @return void
     */
    public function setExchangeRate(?string $exchangeRate): void
    {
        $this->_exchangeRate = $exchangeRate;
    }

    /**
     * @return string
     */
    public function getBaseCurrency(): string
    {
        return $this->_baseCurrency;
    }

    /**
     * @param string|null $baseCurrency
     * @return void
     */
    public function setBaseCurrency(?string $baseCurrency): void
    {
        $this->_baseCurrency = $baseCurrency;
    }

    /**
     * @return string
     */
    public function getCounterCurrency(): string
    {
        return $this->_counterCurrency;
    }

    /**
     * @param string|null $counterCurrency
     * @return void
     */
    public function setCounterCurrency(?string $counterCurrency): void
    {
        $this->_counterCurrency = $counterCurrency;
    }

}