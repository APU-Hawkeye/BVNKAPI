<?php
declare(strict_types=1);

namespace APUHawkeye\BVNKAPI\Service;

use APUHawkeye\BVNKAPI\Service\Model\ExchangeRate;

interface ExchangeRateInterface
{
    public function exchangeRate(string $sourceCurrency): ?ExchangeRate;
}