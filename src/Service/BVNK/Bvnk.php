<?php
declare(strict_types=1);

namespace APUHawkeye\BVNKAPI\Service\BVNK;

use APUHawkeye\BVNKAPI\Service\ExchangeRateInterface;
use APUHawkeye\BVNKAPI\Service\Model\ExchangeRate;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Bvnk implements ExchangeRateInterface
{
    public const BASE_URI = 'https://api.sandbox.bvnk.com';

    /**
     * @param int $length
     * @return string
     */
    protected function generateNonce(int $length = 6): string
    {
        $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $charLength = strlen($chars) - 1;
        $result = '';
        while (strlen($result) < $length) {
            $result .= $chars[rand(0, $charLength)];
        }

        return $result;
    }

    /**
     * @param $string
     * @param $key
     * @return string
     */
    protected function generateSignature($string, $key): string
    {
        return base64_encode(
            hash_hmac('sha256', $string, $key, true)
        );
    }

    /**
     * @return string
     */
    public function generateHeader(): string
    {
        $authId = '';
        $authKey = '';
        $time = time();
        $nonce = $this->generateNonce();

        $hawkHeader = "hawk.1.header"."\n";
        $hawkHeader .= $time;
        $hawkHeader .= "\n";
        $hawkHeader .= $nonce;
        $hawkHeader .= "\n";
        $hawkHeader .= "GET";
        $hawkHeader .= "\n";
        $hawkHeader .= "/api/currency/values";
        $hawkHeader .= "\n";
        $hawkHeader .= "api.sandbox.bvnk.com";
        $hawkHeader .= "\n";
        $hawkHeader .= "443";
        $hawkHeader .= "\n";
        $hawkHeader .= "\n";
        $hawkHeader .= "\n";

        $signature = $this->generateSignature($hawkHeader, $authKey);

        $header = "Hawk id=\"" .$authId."\"".","
            ." ts=\"".$time."\"".","
            ." nonce=\"".$nonce."\"".","
            ." mac=\"".$signature."\"";

        return $header;
    }


    public function exchangeRate(string $sourceCurrency): array
    {
        $client = new Client();
        $header = $this->generateHeader();
        $endpoint = self::BASE_URI . '/api/currency/values/' . $sourceCurrency . '?all=true' ;
        /** @var Response $response */
        $response = $client->request('GET', $endpoint, [
            'headers' => $header
        ]);
        if ($response->getStatusCode() ===  200) {
            /** @var array $responseBody */
            $responseBody = json_decode($response->getBody()->getContents(), true);
            foreach ($responseBody as $body) {
                $exchangeRate = new ExchangeRate();
                $exchangeRate->setBaseCurrency($sourceCurrency);
                $exchangeRate->setCounterCurrency($body['counterCode']);
                $exchangeRate->setExchangeRate($body['rate']);

            }

            return $responseBody;
        }
    }
}