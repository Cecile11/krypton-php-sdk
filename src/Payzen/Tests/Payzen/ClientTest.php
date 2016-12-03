<?php
namespace Payzen\Tests\Payzen;

use PHPUnit\Framework\TestCase;
use Payzen\V3\Store\Type\String;
use Payzen\Client;
use Payzen\Constants;

/**
 * ./vendor/bin/phpunit src/Payzen/Tests/Payzen/ClientTest.php
 */
class ClientTest extends TestCase
{
    /**
     * ./vendor/bin/phpunit --filter testClientValidCall src/Payzen/Tests/Payzen/ClientTest.php
     */
    public function testClientValidCall()
    {
        $store = array("value" => "sdk test string value");
        
        $client = new Client("69876357:testprivatekey_DEMOPRIVATEKEY23G4475zXZQ2UA5x7M");
        $response = $client->post('Charge/SDKTest', $store);

        $this->assertEquals("SUCCESS", $response["status"]);
        $this->assertEquals($store["value"], $response["answer"]["value"]);
    }

    /**
     * ./vendor/bin/phpunit --filter testClientWrongKey src/Payzen/Tests/Payzen/ClientTest.php
     *
     * @expectedException Payzen\Exceptions\PayzenException
     */
    public function testClientWrongKey()
    {
        new Client("wrongkey");
    }

    /**
     * ./vendor/bin/phpunit --filter testInvalidKey src/Payzen/Tests/Payzen/ClientTest.php
     */
    public function testInvalidKey()
    {
        $store = new String();
        $store->value = "sdk test string value";
        
        $client = new Client("69876357:testprivatekey_FAKE");
        $response = $client->post('Charge/SDKTest', $store);
    }

    /**
     * ./vendor/bin/phpunit --filter testClientConfiguration src/Payzen/Tests/Payzen/ClientTest.php
     */
    public function testClientConfiguration()
    {
        $client = new Client("A:B");
        $this->assertEquals(Constants::SDK_VERSION, $client->getVersion());
    }
}