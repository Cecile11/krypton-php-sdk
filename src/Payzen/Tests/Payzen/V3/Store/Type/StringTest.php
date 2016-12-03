<?php
namespace Payzen\Tests\Payzen\V3\Store\Type;

use PHPUnit\Framework\TestCase;
use Payzen\V3\Store\Type\String;

/**
 * ./vendor/bin/phpunit src/Payzen/Tests/Payzen/V3/Store/Type/StringTest.php
 */
class StringTest extends TestCase
{
    /**
     * ./vendor/bin/phpunit --filter testStore src/Payzen/Tests/Payzen/V3/Store/Type/StringTest.php
     */
    public function testStore()
    {
        $store = new String();
        $store->value = "test string";
        $array = $store->asArray();

        $this->assertEquals(1, count($array));
        $this->assertEquals($store->value, $array["value"]);
    }
}