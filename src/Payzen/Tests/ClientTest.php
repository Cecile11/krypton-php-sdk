<?php
namespace Payzen\Tests;

use PHPUnit_Framework_TestCase;
use Payzen\Client;
use Payzen\Constants;

/**
 * ./vendor/bin/phpunit src/Payzen/Tests/ClientTest.php
 */
class ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * ./vendor/bin/phpunit --filter testClientValidCall src/Payzen/Tests/ClientTest.php
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
     * ./vendor/bin/phpunit --filter testClientWrongKey src/Payzen/Tests/ClientTest.php
     *
     * @expectedException Payzen\Exceptions\PayzenException
     */
    public function testClientWrongKey()
    {
        new Client("wrongkey");
    }

    /**
     * ./vendor/bin/phpunit --filter testInvalidKey src/Payzen/Tests/ClientTest.php
     */
    public function testInvalidKey()
    {
        $store = array("value" => "sdk test string value");
        
        $client = new Client("69876357:testprivatekey_FAKE");
        $response = $client->post('Charge/SDKTest', $store);

        $this->assertEquals("ERROR", $response["status"]);
        $this->assertEquals("INT_005", $response["answer"]["errorCode"]);
    }

    /**
     * ./vendor/bin/phpunit --filter testClientConfiguration src/Payzen/Tests/ClientTest.php
     */
    public function testClientConfiguration()
    {
        $client = new Client("A:B");
        $this->assertEquals(Constants::SDK_VERSION, $client->getVersion());
    }

    /**
     * ./vendor/bin/phpunit --filter testFakeProxy src/Payzen/Tests/ClientTest.php
     *
     * @expectedException Payzen\Exceptions\PayzenException
     */
    public function testFakeProxy()
    {
        $client = new Client("69876357:testprivatekey_DEMOPRIVATEKEY23G4475zXZQ2UA5x7M");
        $client->setTimeOuts(1,1);
        $client->setProxy('fake.host', 1234);

        $store = array("value" => "sdk test string value");
        $response = $client->post('Charge/SDKTest', $store);
    }

    /**
     * ./vendor/bin/phpunit --filter testInvalidAnswer src/Payzen/Tests/ClientTest.php
     */
    public function testInvalidAnswer()
    {
        $client = new Client("69876357:testprivatekey_DEMOPRIVATEKEY23G4475zXZQ2UA5x7M");

        $store = "FAKE";
        $response = $client->post('Charge/SDKTest', $store);

        $this->assertEquals("ERROR", $response["status"]);
        $this->assertEquals("INT_002", $response["answer"]["errorCode"]);
    }
}