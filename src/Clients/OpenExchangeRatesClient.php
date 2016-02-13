<?php
namespace Ineersa\Converter\Clients;

use Ineersa\Converter\Exceptions\RequestException;
use Ineersa\Converter\Interfaces\CacheInterface;
use Ineersa\Converter\Interfaces\ClientInterface;
use GuzzleHttp\Client;

class OpenExchangeRatesClient implements ClientInterface
{

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var $appId string
     */
    private $appId;

    /**
     * @var $base string
     */
    private $base='USD';

    /**
     * @var $symbols string
     */
    private $symbols='';

    public function __construct(CacheInterface $cache, $appId=null)
    {
        $this->cache = $cache;
        if (!empty($appId))
            $this->setAppId($appId);
    }

    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function getCachedResponse($path)
    {
        return $this->cache->get($path.$this->base.$this->symbols);
    }

    /**
     * @param $path
     * @return mixed
     * @throws RequestException
     */
    public function doRequest($path)
    {
        $httpClient = new Client();
        try{
            $response = $httpClient->get($path,[
                'query'=>[
                    'app_id' => $this->appId,
                    'base' => $this->base,
                    'symbols' => $this->symbols
                ]
            ]);
        } catch (\Exception $e){
            throw new RequestException;
        }
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
        return $this->cache->set($path.$this->base.$this->symbols,$data);
    }

    /**
     * @param $base
     */
    public function setBase($base)
    {
        if (!empty($base) && strlen($base) == 3){
            $this->base = strtoupper($base);
        }
    }

    public function setSymbols($symbols)
    {
        if (!empty($symbols)){
            $array = explode(',',$symbols);
            $list = [];
            foreach($array as $currency){
                if (strlen($currency) == 3){
                    array_push($list,strtoupper($currency));
                }
            }
            $this->symbols = implode(',',$list);
        }
    }
}