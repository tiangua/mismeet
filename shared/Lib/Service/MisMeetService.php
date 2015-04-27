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

class MisMeetService {
	public function operate($inparam){
		$resultDO = new ServiceResultDO(true);
// 		$obj = json_decode($inparam);
		$dataDO = new MisMeetRes();
		$dataDO->setRes("operation is " . $inparam);
		$resultDO->setData($dataDO);
		return $resultDO;
	}
}