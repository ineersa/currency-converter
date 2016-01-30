<?php
namespace Ineersa\Converter\Clients;

use Ineersa\Converter\Exceptions\RequestException;
use Ineersa\Converter\Interfaces\CacheInterface;
use Ineersa\Converter\Interfaces\ClientInterface;
use GuzzleHttp\Client;

class EcbClient implements ClientInterface
{

    /**
     * @var CacheInterface
     */
    protected $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function getCachedResponse($path)
    {
        return $this->cache->get($path);
    }

    /**
     * @param $path
     * @return mixed
     * @throws RequestException
     */
    public function doRequest($path)
    {
        $httpClient = new Client();
        $response = $httpClient->get($path);
        if ($response->getStatusCode() != 200) {
            throw new RequestException;
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param $path
     * @param $data
     * @return mixed
     */
    public function setResponseToCache($path,$data)
    {
        return $this->cache->set($path,$data);
    }
}