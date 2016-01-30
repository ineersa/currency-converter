# currency-converter
Simple API for currency converting.

Currently using ECB currency rates service.
[http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml](http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml)

### Instalation:
```composer require ineersa/converter```

### Features:
* results caching
* easy to extend
* fast?

### Examples of usage:

Basic usage:
```php
use Ineersa\Converter\Converter;
use Ineersa\Converter\Services\EcbService;

$converter = new Converter(new EcbService());
echo $converter->convert('USD','RUB',100);
```

Get available currencies list:
```php
$service = new EcbService();
$service->getCurrenciesList();
```

Get single currency rate for euro:
```php
$service = new EcbService();
echo $service->getRate('USD');
```

You can control what client, adapter or cache you want to use via service. For example:
```php
$cache = new MemcacheCache();
$service = new EcbService($cache);
echo $service->getRate('USD');
```

By default Memcached, Guzzle used. To use your own, implement appropriate interfaces.
In future more services will be added.

[Demo](http://currency.ineersa.me)
