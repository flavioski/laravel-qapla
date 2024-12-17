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

use W3design\Qapla\Api\OrderApiV12Interface;
use W3design\Qapla\Api\OrderApiV13Interface;
use W3design\Qapla\Api\QaplaApiFactory;
use W3design\Qapla\Dto\GetOrderV12Request;
use W3design\Qapla\Dto\GetOrderV13Request;

class Qapla
{
    /** @var mixed|Api\QaplaApiInterface|null */
    /** @psalm-suppress MissingPropertyType */
    private $api;

    /**
     * Qapla' constructor.
     * @param mixed|null $api
     * @psalm-suppress PossiblyNullArgument
     */
    public function __construct($api = null)
    {
        if ($api === null) {
            $factory = new QaplaApiFactory();
            $api = $factory->createFromConfig();
        }

        $this->api = $api;
    }

    /**
     * @return string
     * @psalm-suppress PossiblyNullArgument
     */
    public function getPrivateApiKey(): string
    {
        return $this->api->getPrivateApiKey();
    }

    /**
     * @param string $privateApiKey
     * @return $this
     * @psalm-suppress PossiblyNullArgument
     */
    public function setPrivateApiKey(string $privateApiKey): Qapla
    {
        $this->api->setPrivateApiKey($privateApiKey);

        return $this;
    }

    /**
     * @return string
     * @psalm-suppress PossiblyNullArgument
     */
    public function getPublicApiKey(): string
    {
        return $this->api->getPublicApiKey();
    }

    /**
     * @param string $publicApiKey
     * @return $this
     * @psalm-suppress PossiblyNullArgument
     */
    public function setPublicApiKey(string $publicApiKey): Qapla
    {
        $this->api->setPublicApiKey($publicApiKey);

        return $this;
    }

    public function getChannel(string $data = null): array
    {
        return $this->api->getChannel($data);
    }

    public function getOrder(object $request): array
    {
        if ($this->api instanceof OrderApiV12Interface && $request instanceof GetOrderV12Request) {
            return $this->api->getOrderV12($request);
        }

        if ($this->api instanceof OrderApiV13Interface && $request instanceof GetOrderV13Request) {
            return $this->api->getOrderV13($request);
        }

        throw new \RuntimeException('L\'API corrente o il tipo di request non sono supportati.');
    }
}
