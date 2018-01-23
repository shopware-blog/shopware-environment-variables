# Use Environment Variables for Plugin Configuration

In multi stage environments it is usual to have different plugin configurations for dev, stage and live system. 

This plugin is a small prof of concept how to overwrite plugin configurations with environment variables. 

# Integration
We use ShopwarePaypal as an example plugin for your prof of concept. We need three steps to activate this. 

# .htaccess 

We should add our environment variables to the .htaccess or vhost configuration file. 

```apacheconfig
SetEnv paypalUsername EnvPayPalUsername
SetEnv paypalPassword EnvPaypalPassword
```

# config.php
After creating our environment variables we should make them available via the dependency injection container. You have 
to add the following lines to your config.php:

```php
<?php return [
    'db' => [...],
    'custom' =>
        [
            'paypalUsername' => getenv('paypalUsername'),
            'paypalPassword' => getenv('paypalPassword'),
        ],
];
```

With this addition our environment variables are available as parameter in the %shopware.custom% array. 

# Plugin
After this two steps we can install the ShopwareEnvironmentVariables plugin and extend our mapping in: https://github.com/teiling88/shopware-environment-variables/blob/master/custom/plugins/ShopwareEnvironmentVariables/Reader.php#L35

# Conclusion

This is a very small prof of concept how to overwrite plugin configurations via environment variables. Nothing more. 
