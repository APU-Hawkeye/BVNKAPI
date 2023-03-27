<?php

require_once "../vendor/autoload.php";

$bvnk = new \APUHawkeye\BVNKAPI\Service\BVNK\Bvnk();

try {
    $rate = $bvnk->exchangeRate('BTC', 'INR', 1);
    $amount = $bvnk->covertAmount('GBP', 'BTC', 1500);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
}
