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

### [openexchangerates](https://openexchangerates.org) was added in version 1.0.1
To get appp_id token visit [openexchangerates](https://openexchangerates.org) and sign up.
Free plan exists (1000 requests per month), which is fairly enough for simple usage.

###Examples of usage:

Basic usage:
```php
    $service = new OpenExchangeRatesService();
    $service->getClient()->setAppId('YOUR_APP_ID_TOKEN');
    $converter = new Converter($service);
    echo $converter->convert('USD','RUB',1);
```

Specific features for paid plans:
```php
    $service = new OpenExchangeRatesService();
    $service->getClient()->setAppId('YOUR_APP_ID_TOKEN');
    $service->getClient()->setBase('EUR');//You can control your base currency
    $service->getClient()->setSymbols('EUR,USD,RUB');//You can control what currencies you need in response
    $converter = new Converter($service);
    echo $converter->convert('USD','RUB',1);
```

By default Memcached, Guzzle used. To use your own, implement appropriate interfaces.

[Demo](http://currency.ineersa.me)
