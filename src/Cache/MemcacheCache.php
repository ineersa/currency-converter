<?php
namespace Ineersa\Converter\Cache;

use Ineersa\Converter\Interfaces\CacheInterface;

class MemcacheCache implements CacheInterface
{

    /**
     * Cache expiration time, 2 hours default
     * @var int
     */
    public $expire = 7200;

    public $host = 'localhost';

    public $port = 11211;

    /**
     * @var \Memcached
     */
    private $memcache;

    public function __construct()
    {
        $this->setupMemcache();
    }

    private function setupMemcache()
    {
        if (is_null($this->memcache) && class_exists('Memcached', false)){
            $this->memcache = new \Memcached();
            $this->memcache->addServer($this->host, $this->port);
        }
    }

    /**
     * @param $key
     * @param $data
     * @return bool
     */
    public function set($key, $data)
    {
        if(!is_null($this->memcache))
            $this->memcache->set($key, $data, $this->expire);
        return false;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if(!is_null($this->memcache))
            return $this->memcache->get($key);
        return false;
    }
}