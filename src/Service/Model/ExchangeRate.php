<?php
declare(strict_types=1);

namespace APUHawkeye\BVNKAPI\Service\Model;

class ExchangeRate
{
    protected ?string $_exchangeRate;

    protected ?string $_toCurrency;

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
    public function getToCurrency(): string
    {
        return $this->_toCurrency;
    }

    /**
     * @param string|null $toCurrency
     * @return void
     */
    public function setToCurrency(?string $toCurrency): void
    {
        $this->_toCurrency = $toCurrency;
    }

}