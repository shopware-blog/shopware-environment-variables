<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;

class ShopwareEnvironmentVariables extends Plugin
{
    public function install(InstallContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_FRONTEND);
    }
}
