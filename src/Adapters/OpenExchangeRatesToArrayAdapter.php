<?php
namespace Ineersa\Converter\Adapters;

use Ineersa\Converter\Exceptions\BadDataException;
use Ineersa\Converter\Interfaces\AdapterInterface;

class OpenExchangeRatesToArrayAdapter implements AdapterInterface
{
    public function parse($data)
    {
        try{
            $decoded = json_decode($data,true);
        } catch (\Exception $e){
            throw new BadDataException;
        }
        if (empty($decoded) || !array_key_exists('rates',$decoded))
            throw new BadDataException;
        var_dump($decoded);die();
        $base = $decoded['base'];
        $decoded['rates'][$base] = 1;

        return $decoded['rates'];
    }
}