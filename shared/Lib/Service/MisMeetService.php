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
use MisMeet\Lib\Model\UserProfile;
use MisMeet\Lib\Model\MisMeet\Lib\Model;

class MisMeetService {
	public function operate($inparam) {
		$resStr = "";
		// param extract
		if ($obj = json_decode ( $inparam )) {
			$objArray = get_object_vars($obj);
			$operation = $this->getJsonValue($objArray, "action");
			$resStr = "the operation is " . $operation;
			
			if ($operation == "set.createuser"){
				$accountService = new AccountService();
				$account = new Account();
				$account->setUsername($this->getJsonValue($objArray,"username"));
				$account->setPassword($this->getJsonValue($objArray,"password"));
				$account->setEmail($this->getJsonValue($objArray,"username") . "@163.com");
				$account->setDisabled(0);
				$account->setLastLogin("0000-00-00 00:00:00");
				if ($accountService ->createAccount($account)){
					$resStr = "create user success!";
				}else{
					$resStr = "create user failed!";
				}
			}
			
			if ($operation == "set.userinfo"){
				$userProfile = new UserProfile();
				$userProfile->setUserId($this->getJsonValue($objArray,"user_id"));
				$userProfile->setProSign($this->getJsonValue($objArray,"pro_sign"));
				$userProfile->setProPhoto($this->getJsonValue($objArray,"pro_photo"));
				$userProfile->setBirthDate($this->getJsonValue($objArray,"birth_date"));
				$userProfile->setProHeight($this->getJsonValue($objArray,"pro_height"));
				$userProfile->setProWeight($this->getJsonValue($objArray,"pro_weight"));
				$userProfile->setIsMale($this->getJsonValue($objArray,"is_male"));
				$userProfile->setWantMale($this->getJsonValue($objArray,"want_male"));
				$userProfile->setIsHeart($this->getJsonValue($objArray,"is_heart"));
				$userProfile->setGmtCreate(date("Y-m-d H:i:s",time()));
				$userProfile->setGmtModified(date("Y-m-d H:i:s",time()));
				if ($userProfile->create()){
					$resStr = "create user profile ". $userProfile->getId() ." success!";
				}else{
					$resStr = "create user profile failed!";
				}
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
	
	private function getJsonValue($obj_array , $obj_key){
		if (array_key_exists($obj_key,$obj_array)){
			return $obj_array[$obj_key];
		}else{
			return 0;
		}
	}
}