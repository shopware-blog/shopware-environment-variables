# Use Environment Variables to override Plugin Configurations

In multi stage environments it is usual to have different plugin configurations for dev, stage and live systems. 

This plugin is a small proof of concept how to overwrite plugin configurations with environment variables. 

# Integration
We use ShopwarePaypal as an example plugin for your proof of concept. For the activation we need three steps. 

# .htaccess 

We have to add our environment variables to the .htaccess or vhost configuration file. 

```apacheconfig
SetEnv paypalUsername EnvPayPalUsername
SetEnv paypalPassword EnvPaypalPassword
```

# config.php
After creating our environment variables we should make them available via the dependency injection container. 
You have to add the following lines to your config.php:

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

With this addition our environment variables are available as parameter in the %shopware.custom% array. 

# Plugin
In the last step we can install the ShopwareEnvironmentVariables plugin and extend our mapping in: [Reader](https://github.com/teiling88/shopware-environment-variables/blob/master/Reader.php#L35)

# Conclusion

This is a very small proof of concept how to overwrite plugin configurations by environment variables. **Nothing more**. 
