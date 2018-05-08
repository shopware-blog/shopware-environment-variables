<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Config;

class Config extends \Shopware_Components_Config
{
    /**
     * @var array
     */
    private $customConfig;

    /**
     * @var int
     */
    private $defaultShopId;

    /**
     * @param array $config
     * @param int $defaultShopId
     * @throws \Zend_Cache_Exception
     */
    public function __construct(array $config, int $defaultShopId)
    {
        parent::__construct($config);
        $this->customConfig = [];
        if (isset($config['custom']['config'])) {
            $this->customConfig = $config['custom']['config'];
        }
        $this->defaultShopId = $defaultShopId;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function offsetGet($name)
    {
        if (isset($this->customConfig[$this->getShopId()][$name])) {
            return $this->customConfig[$this->getShopId()][$name];
        }

        return parent::offsetGet($name);
    }

    /**
     * @return int
     */
    private function getShopId(): int
    {
        return $this->_shop !== null ? $this->_shop->getId() : $this->defaultShopId;
    }
}
