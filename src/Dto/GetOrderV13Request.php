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

class GetOrderV13Request
{
    /** @var string */
    private string $apiKey;
    /** @var string|null */
    private ?string $reference;
    /** @var string|null */
    private ?string $orderID;
    /** @var string|null */
    private ?string $data;

    /**
     * @param string $apiKey
     * @param string|null $reference
     * @param string|null $orderID
     * @param string|null $data
     *
     * @return void
     */
    public function __construct(
        string $apiKey,
        ?string $reference,
        ?string $orderID = null,
        ?string $data = null
    ) {
        $this->apiKey = $apiKey;
        $this->reference = $reference;
        $this->orderID = $orderID;
        $this->data = $data;
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

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }
}
