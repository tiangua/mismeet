<?php
/**
 * 
 * Description : error msg
 * Author : louche
 * Date : 2015Äê4ÔÂ28ÈÕ
 */
namespace MisMeet\Lib\ConfigConstant;

use OK\PhpEnhance\DataStructure\Enum;

class MisMeetErrorEnum extends Enum {
	// param error
	const PARAM_NOTJSON_ERROR = 20100;
	const PARAM_NOUSERID_ERROR = 20101;
	const PARAM_NOUSERNAME_ERROR = 20102;
	const PARAM_NOPASSWORD_ERROR = 20103;
	
	// data error
	const DATA_USERNOTFOUND_ERROR = 20200;
}