<?php
namespace Ineersa\Converter\Interfaces;

interface CacheInterface{
    /**
     * @param $key
     * @param $data
     * @return mixed
     */
    public function set($key,$data);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);
}