<?php
namespace Ineersa\Converter\Adapters;

use Ineersa\Converter\Exceptions\BadDataException;
use Ineersa\Converter\Interfaces\AdapterInterface;

class EcbToArrayAdapter implements AdapterInterface
{

    public function parse($data)
    {
        $xml = simplexml_load_string($data);
        $json = json_encode($xml);
        $currencies = json_decode($json,TRUE);
        $mapped = [];

        if (!isset($currencies["Cube"]["Cube"]["Cube"]))
            throw new BadDataException;

        $mapped['EUR'] = 1;
        foreach($currencies["Cube"]["Cube"]["Cube"] as $currency){
            if (isset($currency['@attributes']['currency']))
                $mapped[$currency['@attributes']['currency']] = (float)$currency['@attributes']['rate'];
            else throw new BadDataException;
        }

        return $mapped;
    }
}