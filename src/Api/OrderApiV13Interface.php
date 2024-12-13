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

namespace W3design\Qapla\Api;

use W3design\Qapla\Dto\GetOrderV13Request;

interface OrderApiV13Interface
{
    /**
     * @param GetOrderV13Request $request
     * @return array
     */
    public function getOrderV13(GetOrderV13Request $request): array;
}
