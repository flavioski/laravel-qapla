<?php
/**
 * Laravel Qapla
 * Copyright since 2024 Flavio Pellizzer and Contributors
 * <Silvano Fabbro> Property
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to flappio.pelliccia@gmail.com so we can send you a copy immediately.
 *
 * @author    Flavio Pellizzer <flappio.pelliccia@gmail.com>
 * @copyright Since 2024 Flavio Pellizzer
 * @license   https://opensource.org/licenses/MIT
 */
declare(strict_types=1);

namespace Unit;

use PHPUnit\Framework\TestCase;
use W3design\Qapla\Api\QaplaApiInterface;
use W3design\Qapla\Qapla;

class QaplaTest extends TestCase
{
    public function testGetPrivateApiKey()
    {
        $mockApi = $this->createMock(QaplaAPiInterface::class);
        $mockApi->expects($this->once())
            ->method('getPrivateApiKey')
            ->willReturn('private-key');

        $qapla = new Qapla($mockApi);
        $privateApiKey = $qapla->getPrivateApiKey();

        $this->assertIsString($privateApiKey);
        $this->assertEquals('private-key', $privateApiKey);
    }

    public function testSetPrivateApiKey()
    {
        $mockApi = $this->createMock(QaplaAPiInterface::class);
        $mockApi->expects($this->once())
            ->method('setPrivateApiKey')
            ->with('new-private-key');

        $qapla = new Qapla($mockApi);
        $qapla->setPrivateApiKey('new-private-key');
    }

    public function testGetPublicApiKey()
    {
        $mockApi = $this->createMock(QaplaAPiInterface::class);
        $mockApi->expects($this->once())
            ->method('getPublicApiKey')
            ->willReturn('public-key');

        $qapla = new Qapla($mockApi);
        $publicApiKey = $qapla->getPublicApiKey();

        $this->assertIsString($publicApiKey);
        $this->assertEquals('public-key', $publicApiKey);
    }

    public function testSetPublicApiKey()
    {
        $mockApi = $this->createMock(QaplaAPiInterface::class);
        $mockApi->expects($this->once())
            ->method('setPublicApiKey')
            ->with('new-public-key');

        $qapla = new Qapla($mockApi);
        $qapla->setPublicApiKey('new-public-key');
    }

    public function testGetOrdersReturnsArray()
    {
        $mockApi = $this->createMock(QaplaAPiInterface::class);
        $mockApi->expects($this->once())
            ->method('getOrders')
            ->willReturn([['id' => 1], ['id' => 2]]);

        $qapla = new Qapla($mockApi);
        $orders = $qapla->getOrders();

        $this->assertIsArray($orders);
        $this->assertCount(2, $orders);
    }
}
