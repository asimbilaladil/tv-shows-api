<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Psr\Http\Message\ResponseInterface;

class HttpService
{

    public function getData(string $method, array $query): array
    {
        $apiUrl     = Config::get('tvmaze.api_url');
        $url        = sprintf('%s%s',$apiUrl, $method);
        $response   = $this->getResponse($url, $query);
        $result     = [
            'data'      => [],
            'status'    => false
        ];

        if($response->getStatusCode() === 200){
            $result = [
                "data"      => json_decode($response->getBody(), true),
                "status"    => true
            ];
        }

        return $result;
    }

    private function getResponse(string $url, array $query = []): ResponseInterface
    {
        $client = new Client();
        return $client->get($url,  ['query' => $query] );
    }
}
