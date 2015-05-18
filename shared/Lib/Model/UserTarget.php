<?php
/**
 * 
 * Description : target user
 * Author : louche
 * Date : 2015Äê5ÔÂ5ÈÕ
 */

namespace MisMeet\Lib\Model;

use MisMeet\Lib\Constant\ServiceName;
use OK\PhalconEnhance\DomainObject\ModelQueryByUKDO;
use OK\PhalconEnhance\DomainObject\ModelQueryDO;
use OK\PhalconEnhance\MvcBase\ModelBase;

class UserTarget extends ModelBase
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
     * @var string
     */
    protected $user_nick;

    /**
     *
     * @var string
     */
    protected $pro_photo;

    /**
     *
     * @var integer
     */
    protected $is_heart;

    /**
     *
     * @var integer
     */
    protected $is_male;

    /**
     *
     * @var integer
     */
    protected $now_lng;

    /**
     *
     * @var integer
     */
    protected $now_lat;

    /**
     *
     * @var string
     */
    protected $pos_tile_1;

    /**
     *
     * @var string
     */
    protected $pos_tile_2;

    /**
     *
     * @var string
     */
    protected $pos_tile_3;

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
     * Method to set the value of field user_nick
     *
     * @param string $user_nick
     * @return $this
     */
    public function setUserNick($user_nick)
    {
        $this->user_nick = $user_nick;

        return $this;
    }

    /**
     * Method to set the value of field pro_photo
     *
     * @param string $pro_photo
     * @return $this
     */
    public function setProPhoto($pro_photo)
    {
        $this->pro_photo = $pro_photo;

        return $this;
    }

    /**
     * Method to set the value of field is_heart
     *
     * @param integer $is_heart
     * @return $this
     */
    public function setIsHeart($is_heart)
    {
        $this->is_heart = $is_heart;

        return $this;
    }

    /**
     * Method to set the value of field is_male
     *
     * @param integer $is_male
     * @return $this
     */
    public function setIsMale($is_male)
    {
        $this->is_male = $is_male;

        return $this;
    }

    /**
     * Method to set the value of field now_lng
     *
     * @param integer $now_lng
     * @return $this
     */
    public function setNowLng($now_lng)
    {
        $this->now_lng = $now_lng;

        return $this;
    }

    /**
     * Method to set the value of field now_lat
     *
     * @param integer $now_lat
     * @return $this
     */
    public function setNowLat($now_lat)
    {
        $this->now_lat = $now_lat;

        return $this;
    }

    /**
     * Method to set the value of field pos_tile_1
     *
     * @param string $pos_tile_1
     * @return $this
     */
    public function setPosTile1($pos_tile_1)
    {
        $this->pos_tile_1 = $pos_tile_1;

        return $this;
    }

    /**
     * Method to set the value of field pos_tile_2
     *
     * @param string $pos_tile_2
     * @return $this
     */
    public function setPosTile2($pos_tile_2)
    {
        $this->pos_tile_2 = $pos_tile_2;

        return $this;
    }

    /**
     * Method to set the value of field pos_tile_3
     *
     * @param string $pos_tile_3
     * @return $this
     */
    public function setPosTile3($pos_tile_3)
    {
        $this->pos_tile_3 = $pos_tile_3;

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
     * Returns the value of field user_nick
     *
     * @return string
     */
    public function getUserNick()
    {
        return $this->user_nick;
    }

    /**
     * Returns the value of field pro_photo
     *
     * @return string
     */
    public function getProPhoto()
    {
        return $this->pro_photo;
    }

    /**
     * Returns the value of field is_heart
     *
     * @return integer
     */
    public function getIsHeart()
    {
        return $this->is_heart;
    }

    /**
     * Returns the value of field is_male
     *
     * @return integer
     */
    public function getIsMale()
    {
        return $this->is_male;
    }

    /**
     * Returns the value of field now_lng
     *
     * @return integer
     */
    public function getNowLng()
    {
        return $this->now_lng;
    }

    /**
     * Returns the value of field now_lat
     *
     * @return integer
     */
    public function getNowLat()
    {
        return $this->now_lat;
    }

    /**
     * Returns the value of field pos_tile_1
     *
     * @return string
     */
    public function getPosTile1()
    {
        return $this->pos_tile_1;
    }

    /**
     * Returns the value of field pos_tile_2
     *
     * @return string
     */
    public function getPosTile2()
    {
        return $this->pos_tile_2;
    }

    /**
     * Returns the value of field pos_tile_3
     *
     * @return string
     */
    public function getPosTile3()
    {
        return $this->pos_tile_3;
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
            'user_nick' => 'user_nick', 
            'pro_photo' => 'pro_photo', 
            'is_heart' => 'is_heart', 
            'is_male' => 'is_male', 
            'now_lng' => 'now_lng', 
            'now_lat' => 'now_lat', 
            'pos_tile_1' => 'pos_tile_1', 
            'pos_tile_2' => 'pos_tile_2', 
            'pos_tile_3' => 'pos_tile_3', 
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
    
    static public function findUniqueByUserId($user_id) {
    	$do = new ModelQueryByUKDO();
    	$do->setBind(["user_id" => $user_id]);
    	return parent::findUniqueByUK($do);
    }
    
    static public function findByPos($now_lng , $now_lat , $user_id , $is_male , $page_no) {
    	$limit = 20;
    	$do = new ModelQueryDO();
    	$do->setColumns ( "user_id, user_nick, pro_photo, is_heart, ABS(cast(now_lng as signed)-cast(" . $now_lng . " as signed))+ABS(cast(now_lat as signed)-cast(" . $now_lat . " as signed)) AS dis" );
    	$do->setConditions ( "now_lng > 0 AND now_lat > 0 AND is_male = " . $is_male . " AND user_id != " . $user_id );
		$do->setOffset ( $page_no * $limit );
		$do->setLimit ( $limit );
		$do->setOrderBy ( "dis" );
    	return parent::findUseDO($do);
    }
}
