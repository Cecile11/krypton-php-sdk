<?php
namespace Payzen\Tests\Payzen\V3\Store\Charge\Action;

use PHPUnit\Framework\TestCase;
use Payzen\V3\Store\Charge\Action\CreatePayment;

/**
 * ./vendor/bin/phpunit src/Payzen/Tests/Payzen/V3/Store/Charge/Action/CreatePaymentTest.php
 */
class CreatePaymentTest extends TestCase
{
    /**
     * ./vendor/bin/phpunit --filter testStore src/Payzen/Tests/Payzen/V3/Store/Charge/Action/CreatePaymentTest.php
     */
    public function testStore()
    {
        $store = new CreatePayment();
        $store->currency = "EUR";
        $store->amount = 990;
        $array = $store->asArray();

        $this->assertEquals(2, count($array));
        $this->assertEquals($store->currency, $array["currency"]);
        $this->assertEquals($store->amount, $array["amount"]);
    }
}