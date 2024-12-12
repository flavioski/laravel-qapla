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

namespace W3design\Qapla;

use W3design\Qapla\Api\QaplaApiFactory;
use W3design\Qapla\Api\QaplaApiInterface;

class Qapla
{
    private QaplaApiInterface $api;

    /**
     * Qapla' constructor.
     */
    public function __construct(?QaplaApiInterface $api = null)
    {
        if ($api === null) {
            $factory = new QaplaApiFactory();
            $api = $factory->createFromConfig();
        }

        $this->api = $api;
    }

    public function getPrivateApiKey(): string
    {
        return $this->api->getPrivateApiKey();
    }

    public function setPrivateApiKey(string $privateApiKey): Qapla
    {
        $this->api->setPrivateApiKey($privateApiKey);

        return $this;
    }

    public function getPublicApiKey(): string
    {
        return $this->api->getPublicApiKey();
    }

    public function setPublicApiKey(string $publicApiKey): Qapla
    {
        $this->api->setPublicApiKey($publicApiKey);

        return $this;
    }

    public function getChannel(string $data = null): array
    {
        return $this->api->getChannel($data);
    }

    public function getOrders(): array
    {
        return $this->api->getOrders();
    }
}
