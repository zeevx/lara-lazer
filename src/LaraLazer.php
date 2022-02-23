<?php

namespace Zeevx\LaraLazer;

use Illuminate\Support\Facades\Http;

class LaraLazer
{
    /**
     * @var string
     */
    private $pubkey;
    /**
     * @var string
     */
    private $seckey;
    /**
     * @var integer
     */
    private $version;
    /**
     * @var string
     */
    private $url;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->pubkey = config('lara-lazer.LAZER_PUBLIC_KEY');
        $this->seckey = config('lara-lazer.LAZER_SECRET_KEY');
        $this->version = config('lara-lazer.LAZER_VERSION');
        $this->url = "https://api.lazerpay.engineering/api/v{$this->version}";
    }

    /**
     * @param string $endpoint
     * @param string $method
     * @param null $data
     * @return mixed
     */
    private function makeRequest(string $endpoint, string $method, $data = null)
    {
        try {
            $url = "{$this->url}/{$endpoint}";
            $headers = [
                'Content-Type' => 'application/json',
                'x-api-key' => $this->pubkey
            ];
            if ($endpoint == "transfer") {
                $headers['Authorization'] = "Bearer {$this->seckey}";
            }
            return Http::withHeaders($headers)
                ->$method($url, $method == 'POST' ? $data : null)
                ->getBody()->getContents();
        } catch (\Exception $e) {
            return response()->json([
               'status' => 'error',
               'message' => 'An error occurred while trying to connect to LazerPay Finance',
               'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function initiateTransaction(array $data)
    {
        return $this->makeRequest("transaction/initialize", 'POST', $data);
    }

    /**
     * @return mixed
     */
    public function confirmTransaction(string $identifier)
    {
        return $this->makeRequest("transaction/verify/{$identifier}", 'GET');
    }

    /**
     * @return mixed
     */
    public function getAcceptedCoins()
    {
        return $this->makeRequest("coins", 'GET');
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function transfer(array $data)
    {
        return $this->makeRequest("transfer", 'POST', $data);
    }


}
