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
		$resStr = "";
		// param extract
		if ($obj = json_decode ( $inparam )) {
			$operation = $obj->action;
			$resStr = "the operation is " . $operation;
			
			if ($operation == "set.createuser"){
				$accountService = new AccountService();
				$account = new Account();
				$account->setUsername($obj->username);
				$account->setPassword($obj->password);
				$account->setEmail($obj->username . "@163.com");
				$account->setDisabled(0);
				$account->setLastLogin("0000-00-00 00:00:00");
				if ($accountService ->createAccount($account)){
					$resStr = "create user success!";
				}else{
					$resStr = "create user failed!";
				}
			}
			
			if ($operation == "set.userinfo"){
				;
			}
		} else {
			return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOTJSON_ERROR);
		}
		
		// build result
		$resultDO = new ServiceResultDO ( true );		
		$dataDO = new MisMeetRes();
		$dataDO->setRes($resStr);
		$resultDO->setData($dataDO);
		return $resultDO;
	}
}