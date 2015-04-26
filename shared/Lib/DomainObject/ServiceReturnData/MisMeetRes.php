<?php
/**
 * 
 * Description : 
 * Author : louche
 * Date : 2015Äê4ÔÂ26ÈÕ
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