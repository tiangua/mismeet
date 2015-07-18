<?php
/**
 *
 * Description : user dig
 * Author : louche
 * Date : 2015年5月28日
 */

namespace MisMeet\Lib\Model;

use MisMeet\Lib\Constant\ServiceName;
use OK\PhalconEnhance\DomainObject\ModelQueryByUKDO;
use OK\PhalconEnhance\DomainObject\ModelQueryDO;
use OK\PhalconEnhance\MvcBase\ModelBase;

class UserDig extends ModelBase
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var integer
     */
    protected $dig_userid;

    /**
     *
     * @var integer
     */
    protected $dig_type;

    /**
     *
     * @var integer
     */
    protected $flag;

    /**
     *
     * @var string
     */
    protected $memo;

    /**
     *
     * @var string
     */
    protected $gmt_create;

    /**
     *
     * @var string
     */
    protected $gmt_modified;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field dig_userid
     *
     * @param integer $dig_userid
     * @return $this
     */
    public function setDigUserid($dig_userid)
    {
        $this->dig_userid = $dig_userid;

        return $this;
    }

    /**
     * Method to set the value of field dig_type
     *
     * @param integer $dig_type
     * @return $this
     */
    public function setDigType($dig_type)
    {
        $this->dig_type = $dig_type;

        return $this;
    }

    /**
     * Method to set the value of field flag
     *
     * @param integer $flag
     * @return $this
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Method to set the value of field memo
     *
     * @param string $memo
     * @return $this
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Method to set the value of field gmt_create
     *
     * @param string $gmt_create
     * @return $this
     */
    public function setGmtCreate($gmt_create)
    {
        $this->gmt_create = $gmt_create;

        return $this;
    }

    /**
     * Method to set the value of field gmt_modified
     *
     * @param string $gmt_modified
     * @return $this
     */
    public function setGmtModified($gmt_modified)
    {
        $this->gmt_modified = $gmt_modified;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field dig_userid
     *
     * @return integer
     */
    public function getDigUserid()
    {
        return $this->dig_userid;
    }

    /**
     * Returns the value of field dig_type
     *
     * @return integer
     */
    public function getDigType()
    {
        return $this->dig_type;
    }

    /**
     * Returns the value of field flag
     *
     * @return integer
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Returns the value of field memo
     *
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Returns the value of field gmt_create
     *
     * @return string
     */
    public function getGmtCreate()
    {
        return $this->gmt_create;
    }

    /**
     * Returns the value of field gmt_modified
     *
     * @return string
     */
    public function getGmtModified()
    {
        return $this->gmt_modified;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'user_id' => 'user_id', 
            'dig_userid' => 'dig_userid', 
            'dig_type' => 'dig_type', 
            'flag' => 'flag', 
            'memo' => 'memo', 
            'gmt_create' => 'gmt_create', 
            'gmt_modified' => 'gmt_modified'
        );
    }
    
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
    	parent::initialize();
    	$this->setConnectionService(ServiceName::DB_MISMEET);
    }
    
    static public function findByUserId($user_id , $favor_type , $page_no) {
    	$limit = 15; // 默认15条
    	$do = new ModelQueryDO();
    	if ($favor_type == 2) {
    		// 根据类型设置返回喜欢我的
    		$do->setColumns ( "user_id,gmt_modified" );
    		$do->setConditions ( "dig_userid = " . $user_id );
    	}else{
    		// 默认都返回我喜欢的人
    		$do->setColumns ( "dig_userid as user_id,gmt_modified" );
    		$do->setConditions ( "user_id = " . $user_id );
    	}
    	$do->setOffset ( $page_no * $limit );
    	$do->setLimit ( $limit );
    	return parent::findUseDO($do);
    }
    
    static public function findByTargetAndUserId($user_id , $target_id){
    	$do = new ModelQueryByUKDO();
    	$do->setBind(["user_id" => $user_id]);
    	$do->setBind(["dig_userid" => $target_id]);
    	$do->setBind(["flag=1"]);
    	
    	return parent::findUniqueByUK($do);
    }
    
    static public function countByUserId($user_id , $favor_type){
    	$do = new ModelQueryDO();
    	if ($favor_type == 2) {
    		// 根据类型设置返回喜欢我的
    		$do->setConditions("flag = 1 and dig_userid = " . $user_id);	// 需要增加条件flag=1，过滤是喜欢
    	}else{
    		$do->setConditions ( "flag = 1 and user_id = " . $user_id );
    	}
    	return parent::countUseDO($do);
    }

}
