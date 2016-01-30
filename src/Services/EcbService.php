<?php
namespace Ineersa\Converter\Services;

use Ineersa\Converter\Adapters\EcbToArrayAdapter;
use Ineersa\Converter\Cache\MemcacheCache;
use Ineersa\Converter\Clients\EcbClient;
use Ineersa\Converter\Interfaces\AdapterInterface;
use Ineersa\Converter\Interfaces\CacheInterface;
use Ineersa\Converter\Interfaces\ClientInterface;
use Ineersa\Converter\Interfaces\ServiceInterface;

class EcbService extends BaseService implements ServiceInterface
{

    public function __construct(CacheInterface $cache=null,ClientInterface $client=null,AdapterInterface $adapter=null)
    {
        if (is_null($cache)){
            $cache = new MemcacheCache();
        }
        if (is_null($client)){
            $client = new EcbClient($cache);
        }
        if (is_null($adapter)){
            $adapter = new EcbToArrayAdapter();
        }
        $this->client = $client;
        $this->adapter = $adapter;
        $this->path = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
        parent::makeRequest();
    }

    /**
     * @param $from
     * @param $to
     * @param $amount
     * @return float
     * @throws \Ineersa\Converter\Exceptions\BadCurrencyException
     */
    public function convert($from, $to, $amount)
    {
        $rateFrom = $this->getRate($from);
        $rateTo = $this->getRate($to);

        return ($amount / $rateFrom)*$rateTo;
    }
}
