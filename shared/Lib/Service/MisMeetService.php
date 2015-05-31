<?php
/**
 * 
 * Description : core service
 * Author : louche
 * Date : 2015年4月26日
 */
namespace MisMeet\Lib\Service;

use OK\PhpEnhance\DomainObject\ServiceResultDO;
use MisMeet\Lib\DomainObject\ServiceReturnData\MisMeetRes;
use MisMeet\Lib\ConfigConstant\MisMeetErrorEnum;
use MisMeet\Lib\ConfigConstant\MisMeetConfig;
use Passport\Lib\Service\AccountService;
use Passport\Lib\Model\Account;
use MisMeet\Lib\Model\UserProfile;
use MisMeet\Lib\Model\UserTarget;
use MisMeet\Lib\Model\UserDig;

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
				$resAccount = $accountService ->createAccount($account);
				if ($resAccount){
					if ($resAccount->getErrorCode()) return new ServiceResultDO(false, $resAccount->getErrorCode());
					$resStr = json_encode($resAccount->getData());// "create user success!";
				}else{
					$resStr = "create user failed!";
				}
			}
			
			if ($operation == "set.userinfo"){
				$userId = $this->getJsonValue($objArray,"user_id");
				if ($userId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				
				$userProfile = UserProfile::findUniqueByUserId($userId);
				if ($userProfile){
					// find do update
					if (array_key_exists("pro_sign",$objArray)) $userProfile->setProSign($objArray["pro_sign"]);
					if (array_key_exists("pro_photo",$objArray)) $userProfile->setProPhoto($objArray["pro_photo"]);
					if (array_key_exists("user_nick",$objArray)) $userProfile->setUserNick($objArray["user_nick"]);
					if (array_key_exists("user_photos",$objArray)) $userProfile->setUserPhotos($objArray["user_photos"]);
					if (array_key_exists("birth_date",$objArray)) $userProfile->setBirthDate($objArray["birth_date"]);
					if (array_key_exists("pro_height",$objArray)) $userProfile->setProHeight($objArray["pro_height"]);
					if (array_key_exists("pro_weight",$objArray)) $userProfile->setProWeight($objArray["pro_weight"]);
					if (array_key_exists("pro_work",$objArray)) $userProfile->setProWork($objArray["pro_work"]);
					if (array_key_exists("pro_hobbies",$objArray)) $userProfile->setProHobbies($objArray["pro_hobbies"]);
					if (array_key_exists("is_male",$objArray)) $userProfile->setIsMale($objArray["is_male"]);
					if (array_key_exists("want_male",$objArray)) $userProfile->setWantMale($objArray["want_male"]);
					if (array_key_exists("is_heart",$objArray)) $userProfile->setIsHeart($objArray["is_heart"]);
					if (array_key_exists("flag",$objArray)) $userProfile->setFlag($objArray["flag"]);
					if (array_key_exists("memo",$objArray)) $userProfile->setProHobbies($objArray["memo"]);
					$userProfile->setGmtModified(date("Y-m-d H:i:s",time()));
					if ($userProfile->update()){
						$resStr = json_encode($userProfile); //"update user profile ". $userProfile->getId() ." success!";
					}else{
						$resStr = "update user profile failed!";
					}
				}else{
					// not find do create
					$userProfile = new UserProfile();
					$userProfile->setUserId($userId);
					$userProfile->setProSign($this->getJsonValue($objArray,"pro_sign"));
					$userProfile->setProPhoto($this->getJsonValue($objArray,"pro_photo"));
					$userProfile->setUserNick($this->getJsonValue($objArray,"user_nick"));
					$userProfile->setUserPhotos($this->getJsonValue($objArray,"user_photos"));
					$userProfile->setBirthDate($this->getJsonValue($objArray,"birth_date"));
					$userProfile->setProHeight($this->getJsonValue($objArray,"pro_height"));
					$userProfile->setProWeight($this->getJsonValue($objArray,"pro_weight"));
					if (array_key_exists("pro_work",$objArray)) $userProfile->setProWork($objArray["pro_work"]);
					if (array_key_exists("pro_hobbies",$objArray)) $userProfile->setProHobbies($objArray["pro_hobbies"]);
					$userProfile->setIsMale($this->getJsonValue($objArray,"is_male"));
					$userProfile->setWantMale($this->getJsonValue($objArray,"want_male"));
					$userProfile->setIsHeart($this->getJsonValue($objArray,"is_heart"));
					if (array_key_exists("flag",$objArray)) $userProfile->setFlag($objArray["flag"]);
					if (array_key_exists("memo",$objArray)) $userProfile->setProHobbies($objArray["memo"]);
					$userProfile->setGmtCreate(date("Y-m-d H:i:s",time()));
					$userProfile->setGmtModified(date("Y-m-d H:i:s",time()));
					if ($userProfile->create()){
						$resStr = json_encode($userProfile); //"create user profile ". $userProfile->getId() ." success!";
					}else{
						$resStr = "create user profile failed!";
					}
				}
				
			}
			
			if ($operation == "get.userinfo"){
				// check userid input
				$userId = $this->getJsonValue($objArray,"user_id");
				if ($userId > 0){
					$userProfile = UserProfile::findUniqueByUserId($userId);
					if ($userProfile){
// 						$userProfileArray = get_object_vars($userProfile);
						// 增加我喜欢和喜欢我的数量
						$resStr = json_encode($userProfile);
					}else return new ServiceResultDO(false, MisMeetErrorEnum::DATA_USERNOTFOUND_ERROR);
				}else{
					return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				}
			}
			
			if ($operation == "set.location"){
				$userId = $this->getJsonValue($objArray,"user_id");
				if ($userId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				$now_lng = $this->getJsonValue($objArray,"now_lng");
				$now_lat = $this->getJsonValue($objArray,"now_lat");
				// get userinfo by userid
				$userProfile = UserProfile::findUniqueByUserId($userId);
				
				$userTarget = UserTarget::findUniqueByUserId($userId);
				if ($userTarget){
					// find do update
					$userTarget->setNowLng($now_lng);
					$userTarget->setNowLat($now_lat);
					$userTarget->setPosTile1($this->getTileName($now_lng, $now_lat, MisMeetConfig::POS_TILE_LEVEL1));
					$userTarget->setPosTile2($this->getTileName($now_lng, $now_lat, MisMeetConfig::POS_TILE_LEVEL2));
					$userTarget->setPosTile3($this->getTileName($now_lng, $now_lat, MisMeetConfig::POS_TILE_LEVEL3));
					$userTarget->setIsHeart($userProfile->getIsHeart());
					$userTarget->setIsMale($userProfile->getIsMale());
					$userTarget->setUserNick($userProfile->getUserNick());
					$userTarget->setProPhoto($userProfile->getProPhoto());
					if (array_key_exists("flag",$objArray)) $userProfile->setFlag($objArray["flag"]);
					if (array_key_exists("memo",$objArray)) $userProfile->setProHobbies($objArray["memo"]);
					$userTarget->setGmtModified(date("Y-m-d H:i:s",time()));
					if ($userTarget->update()){
						$resStr = "update user target ". $userTarget->getId() ." success!";
					}else{
						$resStr = "update user target failed!";
					}
				}else{
					// not find do create
					$userTarget = new UserTarget();
					$userTarget->setUserId($userId);
					$userTarget->setNowLng($now_lng);
					$userTarget->setNowLat($now_lat);
					$userTarget->setPosTile1($this->getTileName($now_lng, $now_lat, MisMeetConfig::POS_TILE_LEVEL1));
					$userTarget->setPosTile2($this->getTileName($now_lng, $now_lat, MisMeetConfig::POS_TILE_LEVEL2));
					$userTarget->setPosTile3($this->getTileName($now_lng, $now_lat, MisMeetConfig::POS_TILE_LEVEL3));
					$userTarget->setIsHeart($userProfile->getIsHeart());
					$userTarget->setIsMale($userProfile->getIsMale());
					$userTarget->setUserNick($userProfile->getUserNick());
					$userTarget->setProPhoto($userProfile->getProPhoto());
					if (array_key_exists("flag",$objArray)) $userProfile->setFlag($objArray["flag"]);
					if (array_key_exists("memo",$objArray)) $userProfile->setProHobbies($objArray["memo"]);
					$userTarget->setGmtCreate(date("Y-m-d H:i:s",time()));
					$userTarget->setGmtModified(date("Y-m-d H:i:s",time()));
					if ($userTarget->create()){
						$resStr = "create user target ". $userTarget->getId() ." success!";
					}else{
						$resStr = "create user target failed!";
					}
				}
			}
			
			if ($operation == "get.userlist"){
				$now_lng = $this->getJsonValue($objArray,"now_lng");
				$now_lat = $this->getJsonValue($objArray,"now_lat");
				$user_id = $this->getJsonValue($objArray,"user_id");		// 传入查询userId 需要排除
				$is_male = $this->getJsonValue($objArray,"is_male");
				$page_no = $this->getJsonValue($objArray,"page_no");
				$page_size = $this->getJsonValue($objArray,"page_size");
				$tempres = UserTarget::findByPos($now_lng, $now_lat, $user_id, $is_male, $page_no);
				$resStr = json_encode($tempres->toArray());
			}
			
			// 喜欢的相关 dig_type = 2 , 喜欢 flag = 1 , 不喜欢 flag = 2
			if ($operation == "set.favorite"){
				$userId = $this->getJsonValue($objArray,"user_id");
				$targetUserId = $this->getJsonValue($objArray,"target_user_id");
				$flag = $this->getJsonValue($objArray,"flag");
				if ($userId < 1 || $targetUserId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				$userDig = new UserDig();
				$userDig->setUserId($userId); // 操作者
				$userDig->setDigUserid($targetUserId);	// 操作目标
				$userDig->setDigType(2);	// 操作类型 定为喜欢相关
				$userDig->setFlag($flag);
				if ($targetUserId->create()){
					$resStr = "set favorite success!";
				}else{
					$resStr = "set favorite failed!";
				}
			}
			
			if ($operation == "get.favoritelist"){
			
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
	
	/**
	 * 根据关联数组，取得对应Key的值
	 * @param $obj_array
	 * @param $obj_key
	 * @return paramvalue
	 */
	private function getJsonValue($obj_array , $obj_key){
		if (array_key_exists($obj_key,$obj_array)){
			if ($obj_key=="now_lng" || $obj_key=="now_lat"){
				if ($obj_array[$obj_key] < 10000)
					return floor($obj_array[$obj_key]*100000);
			}
			return $obj_array[$obj_key];
		}else{
			return 0;
		}
	}
	
	/**
	 * 根据经纬度获得指定级别网格名称
	 * @param $lon 经度
	 * @param $lat 纬度
	 * @param $zoom 当前级别
	 * @return tilename
	 */
	private function getTileName($lon, $lat, $zoom)
	{
		$f_lon = $lon / 100000.0;
		$f_lat = $lat / 100000.0;
		$xtile = floor((($f_lon + 180) / 360) * pow(2, $zoom));
		$ytile = floor((1 - log(tan(deg2rad($f_lat)) + 1 / cos(deg2rad($f_lat))) / pi()) /2 * pow(2, $zoom));
		return $xtile.'_'.$ytile.'_'.$zoom;
	}
}