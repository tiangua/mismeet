<?php
/**
 * 
 * Description : 
 * Author : louche
 * Date : 2015��4��26��
 */

namespace MisMeet\Lib\DomainObject\ServiceReturnData;

use OK\PhpEnhance\DomainObject\ServiceReturnDataDO;

class MisMeetRes extends ServiceReturnDataDO {

    protected $res;

    public function getRes()
    {
        return $this->$res;
    }

    public function setRes($res)
    {
        $this->res = $res;
    }
} 