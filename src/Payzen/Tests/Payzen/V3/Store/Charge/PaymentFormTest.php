<?php
namespace Payzen\Tests\Payzen\V3\Store\Charge;

use PHPUnit\Framework\TestCase;
use Payzen\V3\Store\Charge\PaymentForm;

/**
 * ./vendor/bin/phpunit src/Payzen/Tests/Payzen/V3/Store/Charge/PaymentFormTest.php
 */
class PaymentFormTest extends TestCase
{
    /**
     * ./vendor/bin/phpunit --filter testStore src/Payzen/Tests/Payzen/V3/Store/Charge/PaymentFormTest.php
     */
    public function testStore()
    {
        $store = new PaymentForm();
        $store->formToken = "01:151fcca68e414d88ab102da1aa8976f3:161201172813:000003de45555201:18:01";
        $array = $store->asArray();

        $this->assertEquals(1, count($array));
        $this->assertEquals($store->formToken, $array["formToken"]);
    }
}