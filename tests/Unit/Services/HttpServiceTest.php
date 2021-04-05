<?php

declare(strict_types=1);

namespace Tests\Unit\Services;


use App\Services\HttpService;
use Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use ReflectionClass;
use Tests\TestCase;


class HttpServiceTest extends TestCase
{
    private $httpClientInterface;

    private $config;

    public function setUp(): void
    {
        $this->httpClientInterface = $this->createMock(Client::class);
        $this->config = $this->createMock(Config::class);
    }

    public function getResponseDataProvider(): Generator
    {
        yield 'successful request' => ['xyz.com', [], 200];
    }

    /**
     * @dataProvider getResponseDataProvider
     */

    public function testGetResponse($url, $query, $expect): void
    {
        $expectedResponse = (new Response($expect));
        $this->httpClientInterface
            ->method('get')
            ->willReturn(new Response($expect));

        $service = new HttpService(
            $this->httpClientInterface
        );
        $result = $this->invokeMethod($service, 'getResponse', [$url, $query, $expect]);

        $this->assertEquals($expectedResponse->getStatusCode(), $result->getStatusCode());
    }

    public function invokeMethod(&$object, string $methodName, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
