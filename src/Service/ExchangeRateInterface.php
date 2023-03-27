<?php
declare(strict_types=1);

namespace APUHawkeye\BVNKAPI\Service;

interface ExchangeRateInterface
{
    public function exchangeRate(string $sourceCurrency): array;
}