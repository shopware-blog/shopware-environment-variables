<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariables;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;

class ShopwareEnvironmentVariables extends Plugin
{
    public static function getSubscribedEvents()
    {
        return ['Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPage'];
    }

    public function onPage(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Detail $subject */
        $subject = $args->getSubject();
        ini_set('xdebug.var_display_max_depth', '5');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        echo'<pre>';
        var_dump(Shopware()->Config()->get('mailer_mailer'));
        echo'</pre>';
        echo'<pre>';
        var_dump(Shopware()->Container()
            ->get('shopware.plugin.config_reader')->getByPluginName('SwagPaymentPaypal', Shopware()->Shop())['paypalUsername']);
        echo'</pre>';
    }

    public function install(InstallContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_FRONTEND);
    }


}
