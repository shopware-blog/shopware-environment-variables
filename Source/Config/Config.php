<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Config;

class Config extends \Shopware_Components_Config
{
    /**
     * @var array
     */
    private $customConfig;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->customConfig = $config['custom']['config'];
    }

    public function offsetGet($name)
    {
        if (isset($this->customConfig[$this->getShopId()][$name])) {
            return $this->customConfig[$this->getShopId()][$name];
        }

        return parent::offsetGet($name);
    }

    private function getShopId(): int
    {
        return 1;
    }
}
