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

class QaplaApiFactory
{
    public function createFromConfig(): QaplaApiInterface
    {
        $version = config('qapla.api_version', 12);
        $privateKey = config('qapla.private_api_key');

        switch ($version) {
            case 13:
                return new QaplaApiV13($privateKey);
            case 12:
            default:
                return new QaplaApiV12($privateKey);
        }
    }
}
