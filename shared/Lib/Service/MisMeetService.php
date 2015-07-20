<?php
/**
 * 
 * Description : core service
 * Author : louche
 * Date : 2015年4月26日
 */
namespace MisMeet\Lib\Service;

require_once __DIR__ . '/../../../../../vendor/autoload.php';

use Qiniu\Auth;
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
			
			if ($operation == "get.loginfo"){
				$accountService = new AccountService();
				$userId = $this->getJsonValue($objArray,"user_id");
				if ($userId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				$userName = $this->getJsonValue($objArray,"user_name");
				$resLogin = $accountService->getLoginInfo($userId,$userName);
				if ($resLogin) $resStr = json_encode($resLogin->getData());
			}
			
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
					$resLogin = $accountService->getLoginInfo($resAccount->getData()->getId(),$account->getUsername());
					if ($resLogin) $resStr = json_encode($resLogin->getData());
				}else{
					$resStr = "create user failed!";
				}
			}
			
			if ($operation == "set.password"){
				if (!array_key_exists("user_name",$objArray)) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERNAME_ERROR);
				$userName = $this->getJsonValue($objArray,"user_name");
				if (!array_key_exists("password",$objArray)) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOPASSWORD_ERROR);
				$password = $this->getJsonValue($objArray,"password");
				
				$accountService = new AccountService();
				$account = Account::findUniqueByUsername($userName);
				$updateRes = $accountService->updatePassword($account->getId(), $password);
				if ($updateRes){
					if ($updateRes->getErrorCode()) return new ServiceResultDO(false, $updateRes->getErrorCode());
					$resStr = "update password success!";
				}else{
					$resStr = "update password failed!";
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
						$resStr = json_encode($userProfile); // "create user profile ". $userProfile->getId() ." success!";
					} else {
						$resStr = "create user profile failed!";
					}
				}
				
			}
			
			if ($operation == "get.userinfo"){
				// check userid input
				$userId = $this->getJsonValue($objArray,"user_id");
				$userOpId = $this->getJsonValue($objArray,"operator_id");
				if ($userId > 0){
					$userProfile = UserProfile::findUniqueByUserId($userId);
					if ($userProfile){
						// 增加我喜欢和喜欢我的数量
						$favorCountMe = UserDig::countByUserId($userId,1);
						$favorCountOther = UserDig::countByUserId($userId,2);
						
						$resStr = json_encode($userProfile);
						$theObj = json_decode($resStr);
						$theObj->favor1 = $favorCountMe;
						$theObj->favor2 = $favorCountOther;
						// 增加当前操作者和目标用户的喜欢关系
						if ($userOpId > 0){
							$userDig = UserDig::findByTargetAndUserId($userOpId, $userId);
							if ($userDig){
								$theObj->opfavor = $userDig->getFlag();
							}
						}
						// 增加对年龄的描述
// 						if ($theObj->birth_date) $theObj->agedesc = substr($theObj->birth_date,2,1) . "0%E5%90%8E";
						
						$resStr = json_encode($theObj);
						
					}else return new ServiceResultDO(false, MisMeetErrorEnum::DATA_USERNOTFOUND_ERROR);
				}else{
					return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				}
			}
			
			if ($operation == "set.location"){
				$userId = $this->getJsonValue($objArray,"user_id");
				if ($userId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				$nowLng = $this->getJsonValue($objArray,"now_lng");
				$nowLat = $this->getJsonValue($objArray,"now_lat");
				// get userinfo by userid
				$userProfile = UserProfile::findUniqueByUserId($userId);
				
				$userTarget = UserTarget::findUniqueByUserId($userId);
				if ($userTarget){
					// find do update
					$userTarget->setNowLng($nowLng);
					$userTarget->setNowLat($nowLat);
					$userTarget->setPosTile1($this->getTileName($nowLng, $nowLat, MisMeetConfig::POS_TILE_LEVEL1));
					$userTarget->setPosTile2($this->getTileName($nowLng, $nowLat, MisMeetConfig::POS_TILE_LEVEL2));
					$userTarget->setPosTile3($this->getTileName($nowLng, $nowLat, MisMeetConfig::POS_TILE_LEVEL3));
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
					$userTarget->setNowLng($nowLng);
					$userTarget->setNowLat($nowLat);
					$userTarget->setPosTile1($this->getTileName($nowLng, $nowLat, MisMeetConfig::POS_TILE_LEVEL1));
					$userTarget->setPosTile2($this->getTileName($nowLng, $nowLat, MisMeetConfig::POS_TILE_LEVEL2));
					$userTarget->setPosTile3($this->getTileName($nowLng, $nowLat, MisMeetConfig::POS_TILE_LEVEL3));
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
				if (array_key_exists ( "now_lng", $objArray ) && array_key_exists ( "now_lat", $objArray )){
					$posName = $this->getNameByPos( $objArray ["now_lng"], $objArray ["now_lat"] );
					if (is_array($posName)) $posName = "200米以内";
				}else{
					// 异常返回
				}
				$nowLng = $this->getJsonValue($objArray,"now_lng");
				$nowLat = $this->getJsonValue($objArray,"now_lat");
				$userId = $this->getJsonValue($objArray,"user_id");		// 传入查询userId 需要排除
				$isMale = $this->getJsonValue($objArray,"is_male");
				$pageNo = $this->getJsonValue($objArray,"page_no");
				$pageSize = $this->getJsonValue($objArray,"page_size");
				$tempres = UserTarget::findByPos($nowLng, $nowLat, $userId, $isMale, $pageNo);
				$resArray = array();
				foreach ($tempres as $t_user){
					if ($t_user->dis < 200) $t_user->dislevel = urlencode($posName);
					if ($t_user->dis > 200 && $t_user->dis < 1000) $t_user->dislevel = "1%E5%85%AC%E9%87%8C%E4%BB%A5%E5%86%85";
					if ($t_user->dis > 1000 && $t_user->dis < 10000) $t_user->dislevel = "1%E5%85%AC%E9%87%8C%E5%88%B05%E5%85%AC%E9%87%8C";
					if ($t_user->dis > 10000) $t_user->dislevel = "5%E5%85%AC%E9%87%8C%E4%BB%A5%E4%B8%8A";
					array_push($resArray,$t_user);
				}
				$resStr = json_encode($resArray); //$tempres->toArray());
			}
			
			// 喜欢的相关 dig_type = 2 , 喜欢 flag = 1 , 不喜欢 flag = 2
			if ($operation == "set.favorite"){
				$userId = $this->getJsonValue($objArray,"user_id");
				$targetUserId = $this->getJsonValue($objArray,"target_user_id");
				$flag = $this->getJsonValue($objArray,"flag");
				if ($userId < 1 || $targetUserId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				$userDig = UserDig::findByTargetAndUserId($userId, $targetUserId);
				if ($userDig){
					// find do update
					$userDig->setFlag($flag);
					$userDig->setGmtModified(date("Y-m-d H:i:s",time()));
					if ($userDig->update()){
						$resStr = "update favorite success!";
					}else{
						$resStr = "update favorite failed!";
					}
				}else{
					$userDig = new UserDig();
					$userDig->setUserId($userId); // 操作者
					$userDig->setDigUserid($targetUserId);	// 操作目标
					$userDig->setDigType(2);	// 操作类型 定为喜欢相关
					$userDig->setFlag($flag);
					$userDig->setGmtCreate(date("Y-m-d H:i:s",time()));
					$userDig->setGmtModified(date("Y-m-d H:i:s",time()));
					if ($userDig->create()){
						$resStr = "set favorite success!";
					}else{
						$resStr = "set favorite failed!";
					}
				}
			}
			
			if ($operation == "get.favoritelist"){
				$userId = $this->getJsonValue($objArray,"user_id");
				$favorType = $this->getJsonValue($objArray,"favor_type"); // 2表示喜欢我的
				$pageNo = $this->getJsonValue($objArray,"page_no");
				if ($userId < 1) return new ServiceResultDO(false, MisMeetErrorEnum::PARAM_NOUSERID_ERROR);
				if ($pageNo > 0) $pageNo = $pageNo - 1;
				$tempres = UserDig::findByUserId($userId, $favorType, $pageNo);
				$resArray = array();
				foreach ($tempres as $t_user){
					$favorUser = UserTarget::findUniqueByUserId($t_user->user_id);
					if ($favorUser){
						$t_user->pro_photo = $favorUser->getProPhoto();
						$t_user->user_nick = $favorUser->getUserNick();
						array_push($resArray,$t_user);
					}
				}
				$resStr = json_encode($resArray);
			}
			
			if ($operation == "get.qntoken"){
				$accessKey = 'pJ4Ssxd8d4IOyL-yxgBjIvivlwPEHjqjpZjX6lAa';
				$secretKey = 'dSXfCk2-tE-i2qLzK_tU_bsurMyGmbO3T_dRGwEd';
				$auth = new Auth($accessKey, $secretKey);
				$bucket = 'mismeet-pic';
				$token = $auth->uploadToken ( $bucket );
				$resStr = $token;
			}
		} else {
			return new ServiceResultDO ( false, MisMeetErrorEnum::PARAM_NOTJSON_ERROR);
		}
		
		// build result
		$resultDO = new ServiceResultDO ( true );		
		$dataDO = new MisMeetRes();
		$dataDO->setRes($resStr);
		$resultDO->setData($dataDO);
		return $resultDO;
	}
	
	function getNameByPos($lng , $lat){
		$mgLat = 0;
		$mgLon = 0;
		$this->transform($lat, $lng , $mgLat , $mgLon);
		print_r($lng . "," . $lat . ";" . $mgLon . "," . $mgLat);
		
		$url = 'http://restapi.amap.com/v3/geocode/regeo?output=json&key=89058ab2164059b1bae34ece5ac36f02&location='.$lng.','.$lat;
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$response = curl_exec($ch);
		$result = json_decode($response);
		return $result->regeocode->formatted_address;
	}
	
	static $pi = 3.14159265358979324;
	// a = 6378245.0, 1/f = 298.3
	// b = a * (1 - f)
	// ee = (a^2 - b^2) / a^2;
	static $a = 6378245.0;
	static $ee = 0.00669342162296594323;
	
	//
	// World Geodetic System ==> Mars Geodetic System
	function transform($wgLat, $wgLon , &$mgLat , &$mgLon)
	{
		if ($this->outOfChina($wgLat,$wgLon))
		{
			$mgLat =$wgLat;
			$mgLon =$wgLon;
			return;
		}
		$dLat = $this->transformLat(wgLon - 105.0,$wgLat - 35.0);
		$dLon = $this->transformLon(wgLon - 105.0,$wgLat - 35.0);
		$radLat =$wgLat / 180.0 *$pi;
		$magic = sin($radLat);
		$magic = 1 - $ee *$magic *$magic;
		$sqrtMagic = sqrt($magic);
		$dLat = ($dLat * 180.0) / (($a * (1 - $ee)) / ($magic * $sqrtMagic) *$pi);
		$dLon = ($dLon * 180.0) / ($a / $sqrtMagic * cos($radLat) *$pi);
		$mgLat =$wgLat + $dLat;
		$mgLon =$wgLon + $dLon;
	}
	
	function outOfChina($lat, $lon)
	{
		if ($lon < 72.004 || $lon > 137.8347)
			return true;
		if ($lat < 0.8293 || $lat > 55.8271)
			return true;
		return false;
	}
	
	function transformLat($x, $y)
	{
		$ret = -100.0 + 2.0 * $x + 3.0 * $y + 0.2 * $y * $y + 0.1 * $x * $y + 0.2 * sqrt(abs($x));
		$ret += (20.0 * sin(6.0 * $x *$pi) + 20.0 * sin(2.0 * $x *$pi)) * 2.0 / 3.0;
		$ret += (20.0 * sin($y *$pi) + 40.0 * sin($y / 3.0 *$pi)) * 2.0 / 3.0;
		$ret += (160.0 * sin($y / 12.0 *$pi) + 320 * sin($y *$pi / 30.0)) * 2.0 / 3.0;
		return $ret;
	}
	
	function transformLon($x, $y)
	{
		$ret = 300.0 + $x + 2.0 * $y + 0.1 * $x * $x + 0.1 * $x * $y + 0.1 * sqrt(abs($x));
		$ret += (20.0 * sin(6.0 * $x *$pi) + 20.0 * sin(2.0 * $x *$pi)) * 2.0 / 3.0;
		$ret += (20.0 * sin($x *$pi) + 40.0 * sin($x / 3.0 *$pi)) * 2.0 / 3.0;
		$ret += (150.0 * sin($x / 12.0 *$pi) + 300.0 * sin($x / 30.0 *$pi)) * 2.0 / 3.0;
		return $ret;
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