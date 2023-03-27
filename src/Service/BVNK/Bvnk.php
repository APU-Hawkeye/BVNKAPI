<?php
declare(strict_types=1);

namespace APUHawkeye\BVNKAPI\Service\BVNK;

use APUHawkeye\BVNKAPI\Service\ExchangeRateInterface;
use APUHawkeye\BVNKAPI\Service\Model\ExchangeRate;
use GuzzleHttp\Client;

class Bvnk implements ExchangeRateInterface
{
    public const BASE_URI = 'https://api.sandbox.bvnk.com';

    /**
     * @param string $sourceCurrency
     * @return \APUHawkeye\BVNKAPI\Service\Model\ExchangeRate
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exchangeRate(string $sourceCurrency): \APUHawkeye\BVNKAPI\Service\Model\ExchangeRate
    {
        $client = new Client();
        $endpoint = self::BASE_URI . '/api/currency/values/' . $sourceCurrency . '?' . http_build_query([
            'all' => true,
        ]);
        $response = $client->request('GET', $endpoint, [
            'headers' => [
                'Authorization' => '',
                'accept' => 'application/json',
            ]
        ]);
        if ($response->getStatusCode() ===  200) {
            $json = json_decode($response->getBody()->getContents(), true);
            $exchangeRate = new ExchangeRate();
            $exchangeRate->setExchangeRate($json['rate']);
            $exchangeRate->setToCurrency($json['to_currency']);

            return $exchangeRate;
        }
    }
}