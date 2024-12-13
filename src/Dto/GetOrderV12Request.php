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

namespace W3design\Qapla\Dto;

class GetOrderV12Request
{
    /** @var string */
    private string $apiKey;
    /** @var string|null */
    private ?string $reference;
    /** @var string|null */
    private ?string $orderID;

    /**
     * @param string $apiKey
     * @param string|null $reference
     * @param string|null $orderID
     *
     * @return void
     */
    public function __constructor(
        string $apiKey,
        ?string $reference = null,
        ?string $orderID = null
    ) {
        $this->apiKey = $apiKey;
        $this->reference = $reference;
        $this->orderID = $orderID;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getOrderID(): ?string
    {
        return $this->orderID;
    }
}
