<?php


namespace Tests\Unit\Services;



use App\Services\HttpService;
use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;


class HttpServiceTest extends TestCase
{
    private $httpClientInterface;

    private $config;

    public function setUp() :void
    {
        $this->httpClientInterface = $this->createMock(Client::class);
        $this->config  = $this->createMock(Config::class);

    }

    public function invokeMethod(&$object, string $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function getResponseDataProvider()
    {

       yield 'successful request' => ['xyz.com', [], 200];
    }

    /**
     * @dataProvider getResponseDataProvider
     */

    public function testGetResponse($url, $query, $expect){


        $expectedResponse = (new Response($expect));
        $this->httpClientInterface
            ->method('get')
            ->willReturn(new Response($expect));

        $service = new HttpService(
            $this->httpClientInterface
        );
        $result = $this->invokeMethod($service, 'getResponse', [ $url, $query, $expect]);

        $this->assertEquals( $expectedResponse->getStatusCode(), $result->getStatusCode());
    }
}
