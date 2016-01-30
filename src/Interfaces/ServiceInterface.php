<?php
namespace Ineersa\Converter\Interfaces;

/**
 * Interface ServiceInterface
 * @package Ineersa\Converter\Interfaces
 */
interface ServiceInterface {
    public function convert($from,$to,$amount);
}