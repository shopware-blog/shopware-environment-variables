[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/shopware-blog/shopware-environment-variables/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/shopware-blog/shopware-environment-variables/?branch=master)

# Use Environment Variables to override Plugin Configurations

In multi stage environments it is usual to have different basic and plugin configurations for dev, stage and live systems. 

This plugin can override basic and plugin configurations with environment variables or constants. 

# Integration
We use ShopwarePaypal as an example plugin. Below you can see an example config.php which overrides some plugin settings and basic configuration. 

```php
<?php return [
   'db' => [...],
   'custom' =>
           [
               'plugins' =>
                   [
                       1 => [
                           'SwagPaymentPaypal' => [
                               'paypalUsername' => '1' . getenv('paypalUsername'),
                               'paypalPassword' => '1' . getenv('paypalPassword'),
                           ],
                       ],
                       2 => [
                           'SwagPaymentPaypal' => [
                               'paypalUsername' => '2' . getenv('paypalUsername'),
                               'paypalPassword' => '2' . getenv('paypalPassword'),
                           ],
                       ],
                   ],
               'config' => [
                   1 => [
                       'mailer_mailer' => 'test123',
                   ],
                   2 => [
                       'mailer_mailer' => '321test',
                   ],
               ],
           ],
];
```
