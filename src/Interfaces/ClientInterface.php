<?php
namespace Ineersa\Converter\Interfaces;

/**
 * Interface ServiceInterface
 * @package Ineersa\Converter\Interfaces
 */
interface ClientInterface {
    /**
     * @param $path string
     * @return mixed
     */
    public function getCachedResponse($path);

    /**
     * @param $path
     * @return mixed
     */
    public function doRequest($path);

    /**
     * @param $path
     * @param $data
     * @return mixed
     */
    public function setResponseToCache($path,$data);
}