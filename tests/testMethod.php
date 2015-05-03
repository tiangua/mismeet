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

class TestService extends PHPUnit_Framework_TestCase {
	public function testActionWithoutImpl() {
		HttpClient::$autoJsonDecode = false;
		$callback = StringUtil::getRandomWordCharacters(rand(6, 12));
		$response = ApiClient::jsonp(
				$callback,
				["mismeet.operate", "1.0"],
				["inparam" => "{\"action\":\"set.unknow\",\"username\":\"test_user_1\",\"password\":\"123456\"}"]
		);
		$response = substr($response, strlen($callback) + 1, strlen($response) - strlen($callback) -2);
		$result = json_decode($response);
		HttpClient::$autoJsonDecode = true;
	}
	
    public function testCreateUser() {
        HttpClient::$autoJsonDecode = false;
        $callback = StringUtil::getRandomWordCharacters(rand(6, 12));
        $response = ApiClient::jsonp(
            $callback,
            ["mismeet.operate", "1.0"],
            ["inparam" => "{\"action\":\"set.createuser\",\"username\":\"test_user_1\",\"password\":\"123456\"}"]
        );
        $response = substr($response, strlen($callback) + 1, strlen($response) - strlen($callback) -2);
        $result = json_decode($response);
        HttpClient::$autoJsonDecode = true;
    }
    
    public function testCreateUserProfile() {
    	HttpClient::$autoJsonDecode = false;
    	$callback = StringUtil::getRandomWordCharacters(rand(6, 12));
    	$response = ApiClient::jsonp(
    			$callback,
    			["mismeet.operate", "1.0"],
    			["inparam" => "{\"action\":\"set.userinfo\",\"user_id\":\"1\",\"pro_sign\":\"hello world\",\"pro_photo\":\"test1\"}"]
    	);
    	$response = substr($response, strlen($callback) + 1, strlen($response) - strlen($callback) -2);
    	$result = json_decode($response);
    	HttpClient::$autoJsonDecode = true;
    }
}
