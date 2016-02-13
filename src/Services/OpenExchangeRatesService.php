<?php
namespace Ineersa\Converter\Services;

use Ineersa\Converter\Adapters\OpenExchangeRatesToArrayAdapter;
use Ineersa\Converter\Cache\MemcacheCache;
use Ineersa\Converter\Clients\OpenExchangeRatesClient;
use Ineersa\Converter\Interfaces\AdapterInterface;
use Ineersa\Converter\Interfaces\CacheInterface;
use Ineersa\Converter\Interfaces\ClientInterface;
use Ineersa\Converter\Interfaces\ServiceInterface;

class OpenExchangeRatesService extends BaseService implements ServiceInterface
{

    public function __construct(
        CacheInterface $cache=null,
        ClientInterface $client=null,
        AdapterInterface $adapter=null
    )
    {
        if (is_null($cache)){
            $cache = new MemcacheCache();
        }
        if (is_null($client)){
            $client = new OpenExchangeRatesClient($cache);
        }
        if (is_null($adapter)){
            $adapter = new OpenExchangeRatesToArrayAdapter();
        }
        $this->client = $client;
        $this->adapter = $adapter;
        $this->path = 'https://openexchangerates.org/api/latest.json';
    }

    public function convert($from, $to, $amount)
    {
        parent::makeRequest();

        $rateFrom = $this->getRate($from);
        $rateTo = $this->getRate($to);

        return ($amount / $rateFrom)*$rateTo;
    }

    public function getClient()
    {
        return $this->client;
    }
}