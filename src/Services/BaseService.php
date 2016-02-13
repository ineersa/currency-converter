<?php
namespace Ineersa\Converter\Services;

use Ineersa\Converter\Exceptions\BadCurrencyException;
use Ineersa\Converter\Exceptions\BadDataException;
use Ineersa\Converter\Interfaces\AdapterInterface;
use Ineersa\Converter\Interfaces\ClientInterface;

abstract class BaseService
{
    private $response;

    /**
     * @var $client ClientInterface
     */
    protected $client;

    /**
     * @var $path string
     */
    protected $path;

    /**
     * @var $adapter AdapterInterface
     */
    protected $adapter;

    protected function makeRequest()
    {
        $data = $this->client->getCachedResponse($this->path);
        if (false === $data){
            $data = $this->client->doRequest($this->path);
            if ($data){
                $this->response = $data;
                $this->parseResponse();
                $this->client->setResponseToCache($this->path,$this->response);
            }
        } else {
            $this->response = $data;
        }
    }

    protected function parseResponse()
    {
        $parsed = $this->adapter->parse($this->response);
        $this->response = $parsed;
    }

    /**
     * @param $currency
     * @return mixed
     * @throws BadCurrencyException
     */
    public function getRate($currency)
    {
        if (!is_null($this->response) && array_key_exists($currency,$this->response)){
            return $this->response[$currency];
        } else throw new BadCurrencyException();
    }

    /**
     * @return array
     * @throws BadDataException
     */
    public function getCurrenciesList()
    {
        if (!is_null($this->response))
            return array_keys($this->response);
        else throw new BadDataException();
    }

}