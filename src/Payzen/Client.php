<?php
namespace Payzen;

use Payzen\Exceptions\PayzenException;
use Payzen\Constants;

class Client
{
    private $_login = null;
    private $_password = null;
    private $_private_key = null;
    private $_endpoint = Constants::END_POINT;
    private $_connectionTimeout = 45;
    private $_timeout = 45;
    private $_proxy = null;
    private $_proxyPort = null;

    function __construct($private_key) {
        $auth = explode(':', $private_key);

        if (count($auth) != 2) {
            throw new PayzenException("invalid private key: " . $private_key);
        }

        $this->_private_key = $private_key;
        $this->_login = $auth[0];
        $this->_password = $auth[1];
    }

    public function getVersion() {
        return Constants::SDK_VERSION;
    }

    public function post($target, $array, $closure=None)
    {
        $curl = curl_init($this->_endpoint . $target);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Krypton PHP SDK ' + Constants::SDK_VERSION);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_private_key);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($array));
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , $this->_connectionTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->_timeout);

        if($this->_proxy && $this->_proxyPort) {
          curl_setopt($curl, CURLOPT_PROXY, $this->_proxy);
          curl_setopt($curl, CURLOPT_PROXYPORT, $this->_proxyPort);
        }

        $raw_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $allowedCode = array(200, 401);

        if ( !in_array($status, $allowedCode) ) {
            throw new PayzenException("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        curl_close($curl);
        $response = json_decode($raw_response , true);

        if (is_null($response)) {
            throw new PayzenException("invalid answer: " . $raw_response);
        }

        return $response;
    }
}