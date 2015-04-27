<?php
/**
 * 
 * Description : test one method
 * Author : louche
 * Date : 2015Äê4ÔÂ28ÈÕ
 */

include __DIR__ . "/test_helper.inc.php";

use OK\Util\StringUtil;
use TestHelper\ApiClient;
use TestHelper\HttpClient;

class HelloTest extends PHPUnit_Framework_TestCase {
    public function testHelloPhantom() {
        HttpClient::$autoJsonDecode = false;
        $callback = StringUtil::getRandomWordCharacters(rand(6, 12));
        $response = ApiClient::jsonp(
            $callback,
            ["mismeet.operate", "1.0"],
            ["inparam" => "{\"username\":\"test_normal_user\",\"password\":\"123456\"}"]
        );
        $response = substr($response, strlen($callback) + 1, strlen($response) - strlen($callback) -2);
        $result = json_decode($response);
        HttpClient::$autoJsonDecode = true;
    }
}
