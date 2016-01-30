<?php
namespace Ineersa\Converter;

use Ineersa\Converter\Interfaces\ServiceInterface;

/**
 * Class Converter
 * @package Ineersa\Converter
 */
class Converter
{
    /**
     * @var ServiceInterface
     */
    protected $service;

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param $from
     * @param $to
     * @param int $amount
     * @return mixed
     */
    public function convert($from,$to,$amount=1)
    {
        return $this->service->convert($from,$to,$amount);
    }

}