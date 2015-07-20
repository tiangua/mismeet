/**
Table structure for table `user_profile`
用户扩展信息,记录偏好等个人信息
*/
DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `user_nick` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `pro_sign` varchar(256) DEFAULT NULL COMMENT '个性签名',
  `pro_photo` varchar(1024) DEFAULT NULL COMMENT '个人照片',
  `user_photos` varchar(2048) DEFAULT NULL COMMENT '照片',
  `birth_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生日 20150510',
  `pro_height` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '身高(CM)',
  `pro_weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '体重(KG)',
  `pro_work` varchar(128) DEFAULT NULL COMMENT '职业',
  `pro_hobbies` varchar(256) DEFAULT NULL COMMENT '兴趣爱好',
  `is_male` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否男1是0不是',
  `want_male` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '取向男1是0不是',
  `is_heart` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '是否兴奋状态1是0不是',
  `is_uber` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否Uber会员',
  `uber_desc` varchar(128) DEFAULT NULL COMMENT 'Uber车型',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '标记',
  `memo` varchar(1024) DEFAULT NULL COMMENT '备注',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* 免打扰，还有一个时间段控制 */

/**
Table structure for table `user_target`
目标用户表，基础信息+部分扩展信息+位置更新数据 形成目标
*/
DROP TABLE IF EXISTS `user_target`;

CREATE TABLE `user_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `user_nick` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `pro_photo` varchar(1024) DEFAULT NULL COMMENT '个人照片',
  `is_heart` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否兴奋状态1是0不是',
  `is_male` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否男1是0不是',
  `now_lng` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当前坐标经度',
  `now_lat` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当前坐标纬度',
  `pos_tile_1` varchar(32) NOT NULL DEFAULT 'allworld' COMMENT '1千米网格L15',
  `pos_tile_2` varchar(32) NOT NULL DEFAULT 'allworld' COMMENT '4千米网格L13',
  `pos_tile_3` varchar(32) NOT NULL DEFAULT 'allworld' COMMENT '8千米网格L12',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '标记',
  `memo` varchar(1024) DEFAULT NULL COMMENT '备注',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/**
Table structure for table `user_dig`
用户点赞表，A给B点赞 (也用做收藏)
*/
DROP TABLE IF EXISTS `user_dig`;

CREATE TABLE `user_dig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `dig_userid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞用户ID',
  `dig_type` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞类型数字对应等级',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '标记',
  `memo` varchar(1024) DEFAULT NULL COMMENT '备注',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_target_index` (`user_id`,`dig_userid`),
  KEY `target_index` (`dig_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/**
Table structure for table `platform_event`
平台事件表，活动or热点相关消息
*/
DROP TABLE IF EXISTS `platform_event`;

CREATE TABLE `platform_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(128) DEFAULT NULL COMMENT '事件名称',
  `event_content` varchar(1024) DEFAULT NULL COMMENT '事件内容',
  `event_pic` varchar(1024) DEFAULT NULL COMMENT '事件图片',
  `event_url` varchar(1024) DEFAULT NULL COMMENT '事件URL',
  `event_date` datetime DEFAULT NULL COMMENT '事件时间',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '标记',
  `memo` varchar(1024) DEFAULT NULL COMMENT '备注',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/**
Table structure for table `platform_item`
平台表情表，图标对应的描述
*/
DROP TABLE IF EXISTS `platform_item`;

CREATE TABLE `platform_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(128) DEFAULT NULL COMMENT '表情名称',
  `item_desc` varchar(1024) DEFAULT NULL COMMENT '表情描述',
  `item_pic` varchar(1024) DEFAULT NULL COMMENT '表情图片',
  `item_price` double unsigned NOT NULL DEFAULT '0' COMMENT '表情价值(元)',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '标记',
  `memo` varchar(1024) DEFAULT NULL COMMENT '备注',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;