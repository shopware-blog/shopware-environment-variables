<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Config;

use Doctrine\DBAL\Connection;
use Shopware\Components\DependencyInjection\Bridge\Config as ShopwareConfigFactory;
use Shopware\Components\ShopwareReleaseStruct;
use ShopwareEnvironmentVariables\Source\Helper\ShopProvider;

class Factory extends ShopwareConfigFactory
{
    /**
     * @var array
     */
    private $customConfig;

    /**
     * @var ShopProvider
     */
    private $shopProvider;

    /**
     * @param ShopProvider $shopProvider
     * @param array|null $customConfig
     */
    public function __construct(ShopProvider $shopProvider, array $customConfig = null)
    {
        $this->customConfig = $customConfig;
        $this->shopProvider = $shopProvider;
    }

    public function factory(
        \Zend_Cache_Core $cache,
        Connection $db = null,
        $config = [],
        ShopwareReleaseStruct $release
    ) {
        if (!$db) {
            return null;
        }

        if (!isset($config['cache'])) {
            $config['cache'] = $cache;
        }

        $config['db'] = $db;

        if ($release) {
            $config['release'] = $release;
        }

        if ($this->customConfig) {
            $config['custom'] = $this->customConfig;
        }

        return new Config($config, $this->shopProvider->getDefaultShopId());
    }
}
