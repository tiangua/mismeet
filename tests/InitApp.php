<?php

/**
 * 
 * Description : create api
 * Author : louche
 * Date : 2015Äê4ÔÂ27ÈÕ
 */
use Openapi\Lib\Model\ApiCat;
use Openapi\Lib\Model\Api;
use Openapi\Lib\Model\MethodArg;
use Openapi\Lib\Model\ApiParam;
use Openapi\Lib\Model\Acl;
use Openapi\Lib\Model\Openapi\Lib\Model;

class InitApp extends PHPUnit_Framework_TestCase {
	/**
	 * this method use for create api with one string param
	 */
	public function testDoInit() {
		// init app category
		$api_cat_id = 0;
		$apicat = new ApiCat ();
		$apicat->setName ( "MisMeet" );
		
		echo "create api cat";
		if ($apicat->create ()) {
			$api_cat_id = $apicat->getId ();
		} else {
			return;
		}
		
		$api_id = 0;
		// init app (set usage name and class)
		$theapi = new Api ();
		$theapi->setApiCatId ( $api_cat_id );
		$theapi->setName ( "mismeet.operate" );		// 
		$theapi->setVersion ( "1.0" );	//
		$theapi->setDeprecated ( 0 );
		$theapi->setSignatureTtl ( 3600 );
		$theapi->setSaveErrorDetail ( 0 );
		$theapi->setServiceProtocol ( "local" );
		$theapi->setServiceClass ( "MisMeet\\Lib\\Service\\MisMeetService" );	//
		$theapi->setServiceMethod ( "operate" );	//
		$theapi->setSessionOption ( "ignore" );
		
		echo "create api";
		if ($theapi->create ()) {
			$api_id = $theapi->getId();
		} else {
			return;
		}

		$param_id = 0;
		// param for the method
		$apiparam = new ApiParam();
		$apiparam->setApiId($api_id);
		$apiparam->setName("inparam");		//
		$apiparam->setDataType("string");
		$apiparam->setFormElement("Phalcon\\Forms\\Element\\Text");
		$apiparam->setNullable(1);
		$apiparam->setDefaultValue(NULL);
		$apiparam->setSampleValue(NULL);
		
		if ($apiparam->create()){
			$param_id = $apiparam->getId();
		}else{
			return ;
		}
		
		// init method args
		$methodarg = new MethodArg();
		$methodarg->setApiId($api_id);
		$methodarg->setArgIndex(0);
		$methodarg->setIsHashmap(0);
		$methodarg->setArgSrc("api_param");
		$methodarg->setParamId($param_id);
		
		$methodarg->create();
		
		// init acl
		$acl = new Acl();
		$acl->setAppkey(1077586);	// 
		$acl->setApiId($api_id);
		$acl->setIpStart(16843009);
		$acl->setIpEnd(4278124286);
		$acl->setAllow(1);
		
		$acl->create();
	}
}