<?php

require_once "../vendor/autoload.php";

$exchangeRate = new \APUHawkeye\BVNKAPI\Service\BVNK\Bvnk();

try {
    $rate = $exchangeRate->exchangeRate('BTC');
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
}

echo '<pre>';

print_r($rate);