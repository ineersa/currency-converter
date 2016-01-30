<?php
namespace Ineersa\Converter\Interfaces;
/**
 * Made for data parsing
 * Interface AdapterInterface
 * @package Ineersa\Converter\Interfaces
 */
interface AdapterInterface{
    /**
     * Returning array should look like
     * [
     * 'USD'=>1.09
     * ...
     * ]
     * @param $data mixed
     * @return array
     * @throw BadDataException
     */
    public function parse($data);
}