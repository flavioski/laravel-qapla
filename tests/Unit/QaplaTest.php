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
use W3design\Qapla\Api\OrderApiV12Interface;
use W3design\Qapla\Api\OrderApiV13Interface;
use W3design\Qapla\Api\QaplaApiInterface;
use W3design\Qapla\Dto\GetOrderV12Request;
use W3design\Qapla\Dto\GetOrderV13Request;
use W3design\Qapla\Qapla;

class QaplaTest extends TestCase
{
    public function testGetPrivateApiKey()
    {
        $mockApi = $this->createMock(QaplaApiInterface::class);
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
        $mockApi = $this->createMock(QaplaApiInterface::class);
        $mockApi->expects($this->once())
            ->method('setPrivateApiKey')
            ->with('new-private-key');

        $qapla = new Qapla($mockApi);
        $qapla->setPrivateApiKey('new-private-key');
    }

    public function testGetPublicApiKey()
    {
        $mockApi = $this->createMock(QaplaApiInterface::class);
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
        $mockApi = $this->createMock(QaplaApiInterface::class);
        $mockApi->expects($this->once())
            ->method('setPublicApiKey')
            ->with('new-public-key');

        $qapla = new Qapla($mockApi);
        $qapla->setPublicApiKey('new-public-key');
    }

    public function testGetChannelReturnArray()
    {
        $mockApi = $this->createMock(QaplaApiInterface::class);
        $mockApi->expects($this->once())
            ->method('getChannel')
            ->willReturn(['id' => 1]);

        $qapla = new Qapla($mockApi);
        $channel = $qapla->getChannel();

        $this->assertIsArray($channel);
    }

    public function testGetChannelWithDataParameterReturnArray()
    {
        $mockApi = $this->createMock(QaplaApiInterface::class);
        $mockApi->expects($this->once())
            ->method('getChannel')
            ->with('data')
            ->willReturn(['id' => 1]);

        $qapla = new Qapla($mockApi);
        $channel = $qapla->getChannel('data');

        $this->assertIsArray($channel);
    }

    public function testGetOrderWithV12InterfaceAndV12Request()
    {
        $mockApiV12 = $this->createMock(OrderApiV12Interface::class);
        $mockApiV12->expects($this->once())
            ->method('getOrderV12')
            ->willReturn([['order_id' => 1]])
        ;

        $qapla = new Qapla($mockApiV12);

        $request = new GetOrderV12Request(
            'test-api-key',
            'REF123',
        );

        $orders = $qapla->getOrder($request);

        $this->assertIsArray($orders);
        $this->assertEquals([['order_id' => 1]], $orders);
    }

    public function testGetOrderWithV13InterfaceAndV13Request()
    {
        $mockApiV13 = $this->createMock(OrderApiV13Interface::class);
        $mockApiV13->expects($this->once())
            ->method('getOrderV13')
            ->willReturn([['order_id' => 2]])
        ;

        $qapla = new Qapla($mockApiV13);

        $request = new GetOrderV13Request(
            'test-api-key',
            'REF456',
            null,
            'all'
        );

        $orders = $qapla->getOrder($request);

        $this->assertIsArray($orders);
        $this->assertEquals([['order_id' => 2]], $orders);
    }

    public function testGetOrderWithMismatchedRequestAndInterfaceThrowsException()
    {
        // Supponiamo di avere un'istanza V12 ma passiamo un DTO V13
        $mockApiV12 = $this->createMock(OrderApiV12Interface::class);
        $qapla = new Qapla($mockApiV12);

        $request = new GetOrderV13Request('test-api-key', 'REF123');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('L\'API corrente o il tipo di request non sono supportati.');

        $qapla->getOrder($request);
    }
}
