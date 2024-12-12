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

namespace Feature\Api;

use Illuminate\Support\Facades\Config;
use ReflectionClass;
use W3design\Qapla\Api\QaplaApiV12;
use W3design\Qapla\Api\QaplaApiV13;
use W3design\Qapla\Tests\TestCase;
use W3design\Qapla\Qapla;

class QaplaApiFactoryTest extends TestCase
{
    public function testFactoryCreatesV12()
    {
        Config::set('qapla.api_version', 12);
        Config::set('qapla.private_api_key', 'private-key');
        Config::set('qapla.public_api_key', 'public-key');

        $qapla = new Qapla();

        $ref = new ReflectionClass($qapla);
        $prop = $ref->getProperty('api');
        $prop->setAccessible(true);
        $apiInstance = $prop->getValue($qapla);

        $this->assertInstanceOf(QaplaApiV12::class, $apiInstance);
    }

    public function testFactoryCreatesV13()
    {
        Config::set('qapla.api_version', 13);
        Config::set('qapla.private_api_key', 'private-key');
        Config::set('qapla.public_api_key', 'public-key');

        // I want pass nothing, the factory should read the config
        $qapla = new Qapla();

        // Now I want test the instance of the API created so must be QaplaApiV13 type's
        $ref = new ReflectionClass($qapla);
        $prop = $ref->getProperty('api');
        $prop->setAccessible(true);
        $apiInstance = $prop->getValue($qapla);

        $this->assertInstanceOf(QaplaApiV13::class, $apiInstance);
    }
}
