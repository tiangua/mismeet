<?php
/**
 * 
 * Description : core service
 * Author : louche
 * Date : 2015Äê4ÔÂ26ÈÕ
 */
namespace MisMeet\Lib\Service;

use OK\PhpEnhance\DomainObject\ServiceResultDO;
use MisMeet\Lib\DomainObject\ServiceReturnData\MisMeetRes;
use MisMeet\Lib\ConfigConstant\MisMeetErrorEnum;
use Passport\Lib\Service\AccountService;
use Passport\Lib\Model\Account;

class MisMeetService {
	public function operate($inparam) {
		// param extract
		if ($obj = json_decode ( $inparam )) {
			$operation = $obj->op;
			
			if ($operation == "reguser"){
				$accountService = new AccountService();
				$account = new Account();
				$account->setUsername("phantom");
				$account->setPassword("123456");
				$account->setEmail("phan1@163.com");
				$accountService ->createAccount($account);
			}
		} else {
			return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOTJSON_ERROR);
		}
		
		// build result
		$resultDO = new ServiceResultDO ( true );		
		$dataDO = new MisMeetRes();
		$dataDO->setRes("operation is " . $operation);
		$resultDO->setData($dataDO);
		return $resultDO;
	}
}