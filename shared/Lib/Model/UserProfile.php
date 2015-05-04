<?php
/**
 * 
 * Description : user profile 
 * Author : louche
 * Date : 2015Äê5ÔÂ3ÈÕ
 */

namespace MisMeet\Lib\Model;

use MisMeet\Lib\Constant\ServiceName;
use OK\PhalconEnhance\DomainObject\ModelQueryByUKDO;
use OK\PhalconEnhance\DomainObject\ModelQueryDO;
use OK\PhalconEnhance\MvcBase\ModelBase;

class UserProfile extends ModelBase
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
    protected $pro_sign;

    /**
     *
     * @var string
     */
    protected $pro_photo;

    /**
     *
     * @var integer
     */
    protected $birth_date;

    /**
     *
     * @var integer
     */
    protected $pro_height;

    /**
     *
     * @var integer
     */
    protected $pro_weight;

    /**
     *
     * @var string
     */
    protected $pro_work;

    /**
     *
     * @var string
     */
    protected $pro_hobbies;

    /**
     *
     * @var integer
     */
    protected $is_male;

    /**
     *
     * @var integer
     */
    protected $want_male;

    /**
     *
     * @var integer
     */
    protected $is_heart;

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
     * Method to set the value of field pro_sign
     *
     * @param string $pro_sign
     * @return $this
     */
    public function setProSign($pro_sign)
    {
        $this->pro_sign = $pro_sign;

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
     * Method to set the value of field birth_date
     *
     * @param integer $birth_date
     * @return $this
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    /**
     * Method to set the value of field pro_height
     *
     * @param integer $pro_height
     * @return $this
     */
    public function setProHeight($pro_height)
    {
        $this->pro_height = $pro_height;

        return $this;
    }

    /**
     * Method to set the value of field pro_weight
     *
     * @param integer $pro_weight
     * @return $this
     */
    public function setProWeight($pro_weight)
    {
        $this->pro_weight = $pro_weight;

        return $this;
    }

    /**
     * Method to set the value of field pro_work
     *
     * @param string $pro_work
     * @return $this
     */
    public function setProWork($pro_work)
    {
        $this->pro_work = $pro_work;

        return $this;
    }

    /**
     * Method to set the value of field pro_hobbies
     *
     * @param string $pro_hobbies
     * @return $this
     */
    public function setProHobbies($pro_hobbies)
    {
        $this->pro_hobbies = $pro_hobbies;

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
     * Method to set the value of field want_male
     *
     * @param integer $want_male
     * @return $this
     */
    public function setWantMale($want_male)
    {
        $this->want_male = $want_male;

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
     * Returns the value of field pro_sign
     *
     * @return string
     */
    public function getProSign()
    {
        return $this->pro_sign;
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
     * Returns the value of field birth_date
     *
     * @return integer
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Returns the value of field pro_height
     *
     * @return integer
     */
    public function getProHeight()
    {
        return $this->pro_height;
    }

    /**
     * Returns the value of field pro_weight
     *
     * @return integer
     */
    public function getProWeight()
    {
        return $this->pro_weight;
    }

    /**
     * Returns the value of field pro_work
     *
     * @return string
     */
    public function getProWork()
    {
        return $this->pro_work;
    }

    /**
     * Returns the value of field pro_hobbies
     *
     * @return string
     */
    public function getProHobbies()
    {
        return $this->pro_hobbies;
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
     * Returns the value of field want_male
     *
     * @return integer
     */
    public function getWantMale()
    {
        return $this->want_male;
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

    public function getSource()
    {
        return 'user_profile';
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'user_id' => 'user_id', 
            'pro_sign' => 'pro_sign', 
            'pro_photo' => 'pro_photo', 
            'birth_date' => 'birth_date', 
            'pro_height' => 'pro_height', 
            'pro_weight' => 'pro_weight', 
            'pro_work' => 'pro_work', 
            'pro_hobbies' => 'pro_hobbies', 
            'is_male' => 'is_male', 
            'want_male' => 'want_male', 
            'is_heart' => 'is_heart', 
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
}
