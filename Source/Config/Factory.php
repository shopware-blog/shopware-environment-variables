<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Config;

use Shopware\Bundle\StoreFrontBundle\Service\Core\ContextService;
use Shopware\Components\DependencyInjection\Bridge\Config as ShopwareConfigFactory;

class Factory extends ShopwareConfigFactory
{
    /**
     * @var array
     */
    private $customConfig;

    public function __construct(array $customConfig = null)
    {
        $this->customConfig = $customConfig;
    }

    /**
     * the default value for $release is important to support shopware 5.3
     *
     * @param \Zend_Cache_Core $cache
     * @param \Enlight_Components_Db_Adapter_Pdo_Mysql|null $db
     * @param array $config
     * @param \Shopware\Components\ShopwareReleaseStruct|null $release
     * @return null|\Shopware_Components_Config
     */
    public function factory(
        \Zend_Cache_Core $cache,
        \Enlight_Components_Db_Adapter_Pdo_Mysql $db = null,
        $config = [],
        \Shopware\Components\ShopwareReleaseStruct $release = null
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

        return new Config($config);
    }
}
