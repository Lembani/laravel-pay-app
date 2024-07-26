<?php
namespace Lembani\MoneyUnify;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MoneyUnifyClient
{
    protected $client;
    protected $baseUrl;
    protected $muid;

    public function __construct()
    {
        $this->baseUrl = config('moneyunify.base_url');
        $this->muid = config('moneyunify.muid');
    
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }
    
    public function requestPayment($phoneNumber, $amount)
    {
        try {
            $formParams = [
                'muid' => $this->muid,
                'phone_number' => $phoneNumber,
                'amount' => $amount,
            ];
            $response = $this->client->post('/request_payment', [
                'form_params' => $formParams,
            ]);
            $responseBody = $response->getBody()->getContents();
            return json_decode($responseBody, true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                throw new \Exception($errorResponse['message'], $e->getResponse()->getStatusCode());
            }
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    
    public function verifyTransaction($reference)
    {
        try {
            $response = $this->client->post('/verify_transaction', [
                'form_params' => [
                    'muid' => $this->muid,
                    'reference' => $reference,
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                throw new \Exception($errorResponse['message'], $e->getResponse()->getStatusCode());
            }
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
