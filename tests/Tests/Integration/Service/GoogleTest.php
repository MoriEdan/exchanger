<?php

/*
 * This file is part of Exchanger.
 *
 * (c) Florian Voutzinos <florian@voutzinos.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exchanger\Tests\Intergration\Service;

use Exchanger\ExchangeRateQueryBuilder;
use Exchanger\Service\Google;
use PHPUnit\Framework\TestCase;
use Http\Adapter\Guzzle6\Client as GuzzleClient;
use Exchanger\Exchanger;
use PHPUnit\Framework\Assert;

class GoogleTest extends TestCase
{
    /**
     * @test
     */
    public function it_fetches_a_rate()
    {
        $client = new GuzzleClient();
        $service = new Google($client);
        $exchanger = new Exchanger($service);

        $query = (new ExchangeRateQueryBuilder('EUR/COP'))
            ->build();

        $rate = $exchanger->getExchangeRate($query);

        Assert::assertNotNull($rate->getValue());
        Assert::assertInstanceOf('\DateTimeInterface', $rate->getDate());
    }
}
