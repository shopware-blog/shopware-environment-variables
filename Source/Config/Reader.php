<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Config;

use Shopware\Components\Plugin\ConfigReader;
use Shopware\Models\Shop\Shop;
use ShopwareEnvironmentVariables\Source\Helper\ShopProvider;

class Reader implements ConfigReader
{
    /**
     * @var ConfigReader
     */
    private $configReader;

    /**
     * @var array
     */
    private $customEnvironmentVariables;

    /**
     * @var ShopProvider
     */
    private $shopProvider;

    /**
     * @param ConfigReader $configReader
     * @param ShopProvider $shopProvider
     * @param array $customEnvironmentVariables
     */
    public function __construct(
        ConfigReader $configReader,
        ShopProvider $shopProvider,
        array $customEnvironmentVariables
    ) {
        $this->configReader = $configReader;
        $this->customEnvironmentVariables = [];
        if (isset($customEnvironmentVariables['plugins'])) {
            $this->customEnvironmentVariables = $customEnvironmentVariables['plugins'];
        }
        $this->shopProvider = $shopProvider;
    }

    /**
     * @param string $pluginName
     * @param Shop|null $shop
     * @return array
     */
    public function getByPluginName($pluginName, Shop $shop = null): array
    {
        $result = $this->configReader->getByPluginName($pluginName, $shop);
        $shopId = $shop !== null ? $shop->getId() : $this->shopProvider->getShopId();

        if (!isset($this->customEnvironmentVariables[$shopId][$pluginName])) {
            return $result;
        }

        return array_merge($result, $this->customEnvironmentVariables[$shopId][$pluginName]);
    }
}
