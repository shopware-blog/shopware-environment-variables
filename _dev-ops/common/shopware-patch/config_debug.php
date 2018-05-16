<?php declare(strict_types=1);

$defaultConfig = ['db' => ['dbname' => '']];
if (file_exists(__DIR__ . '/config.php')) {
    $defaultConfig = require __DIR__ . '/config.php';
}

$csrfProtection = true;
$sessionLocking = true;

$eMailDir = __DIR__ . '/../build/mails';

if (!is_dir($eMailDir) && !mkdir($eMailDir)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', $eMailDir));
}

if (getenv('SHOPWARE_ENV') === 'test') {
    $defaultConfig['db']['dbname'] .= '-test';
    $csrfProtection = false;
    $sessionLocking = false;
}

return [
    'db' => $defaultConfig['db'],

    'errorHandler' => [
        'throwOnRecoverableError' => true,
    ],

    'session' => [
        'locking' => $sessionLocking,
    ],

    'front' => [
        'noErrorHandler' => true,
        'throwExceptions' => true,
        'disableOutputBuffering' => true,
        'showException' => true,
    ],

    'model' => [
        'cacheProvider' => 'array',
    ],

    'phpsettings' => [
        'error_reporting' => E_ALL,
        'display_errors' => 1,
    ],
    'csrfprotection' => [
        'frontend' => $csrfProtection,
        'backend' => $csrfProtection,
    ],
    'mail' => [
        'type' => 'file',
        'path' => $eMailDir,
    ],
    'custom' =>
        [
            'plugins' =>
                [
                    1 => [
                        'AdvancedMenu' => [
                            'show' => true,
                            'paypalPassword' => '1' . getenv('paypalPassword'),
                        ],
                    ],
                    2 => [
                        'AdvancedMenu' => [
                            'show' => false,
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
