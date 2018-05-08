<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables\Source\Helper;

use Shopware\Components\Model\ModelManager;
use Shopware\Models\Shop\Shop;

class ShopProvider
{
    /**
     * @var null|Shop
     */
    private $shop;

    /**
     * @var ModelManager
     */
    private $models;

    /**
     * @param ModelManager $models
     * @param Shop|null $shop
     */
    public function __construct(ModelManager $models, Shop $shop = null)
    {
        $this->models = $models;
        $this->shop = $shop;
    }

    /**
     * @return Shop
     */
    public function getShop(): Shop
    {
        if (!$this->shop) {
            $this->shop = $this->getDefaultShop();
        }

        return $this->shop;
    }

    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->getShop()->getId();
    }

    /**
     * @return \Shopware\Models\Shop\DetachedShop
     */
    public function getDefaultShop()
    {
        return $this->models->getRepository(Shop::class)->getActiveDefault();
    }

    /**
     * @return int
     */
    public function getDefaultShopId()
    {
        return $this->getDefaultShop()->getId();
    }
}
