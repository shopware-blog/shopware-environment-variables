<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables;

use Shopware\Components\Plugin\ConfigReader;
use Shopware\Models\Shop\Shop;

class Reader implements ConfigReader
{
    /**
     * @var ConfigReader
     */
    private $configReader;

    /**
     * @var array
     */
    private $customConfig;

    public function __construct(ConfigReader $configReader, array $customConfig)
    {
        $this->configReader = $configReader;
        $this->customConfig = $customConfig;
    }

    /**
     * @param string $pluginName
     * @param Shop|null $shop
     * @return array
     */
    public function getByPluginName($pluginName, Shop $shop = null): array
    {
        $result = $this->configReader->getByPluginName($pluginName, $shop);

        if (isset($result['paypalUsername'])) {
            $result['paypalUsername'] = $this->customConfig['paypalUsername'];
        }

        if (isset($result['paypalPassword'])) {
            $result['paypalPassword'] = $this->customConfig['paypalPassword'];
        }

        return $result;
    }
}
