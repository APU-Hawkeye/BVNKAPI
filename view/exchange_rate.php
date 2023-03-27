<?php

require_once "../vendor/autoload.php";

$bvnk = new \APUHawkeye\BVNKAPI\Service\BVNK\Bvnk();

try {
    $rate = $bvnk->exchangeRate('BTC');
    $amount = $bvnk->covertAmount('GBP', 'BTC', 1500);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    echo 'ERROR: ' . $e->getMessage();
    return;
}
