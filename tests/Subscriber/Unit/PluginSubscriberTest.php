<?php declare(strict_types=1);

namespace ShopwareEnvironmentVariablesTests\Subscriber\Unit;

use PHPUnit\Framework\TestCase;
use ShopwareEnvironmentVariables\ShopwareEnvironmentVariables;

/**
 * @coversDefaultClass \ShopwareEnvironmentVariables\ShopwareEnvironmentVariables
 */
class PluginSubscriberTest extends TestCase
{
    /**
     * @covers ::getSubscribedEvents()
     */
    public function testSubscribedEvents()
    {
        $subscriber = new ShopwareEnvironmentVariables(true);
        self::assertEmpty($subscriber::getSubscribedEvents());
    }
}
