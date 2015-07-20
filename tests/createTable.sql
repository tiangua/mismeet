/**
Table structure for table `user_profile`
�û���չ��Ϣ,��¼ƫ�õȸ�����Ϣ
*/
DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `user_nick` varchar(50) DEFAULT NULL COMMENT '�û��ǳ�',
  `pro_sign` varchar(256) DEFAULT NULL COMMENT '����ǩ��',
  `pro_photo` varchar(1024) DEFAULT NULL COMMENT '������Ƭ',
  `user_photos` varchar(2048) DEFAULT NULL COMMENT '��Ƭ',
  `birth_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '���� 20150510',
  `pro_height` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '���(CM)',
  `pro_weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����(KG)',
  `pro_work` varchar(128) DEFAULT NULL COMMENT 'ְҵ',
  `pro_hobbies` varchar(256) DEFAULT NULL COMMENT '��Ȥ����',
  `is_male` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ���1��0����',
  `want_male` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ȡ����1��0����',
  `is_heart` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '�Ƿ��˷�״̬1��0����',
  `is_uber` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ�Uber��Ա',
  `uber_desc` varchar(128) DEFAULT NULL COMMENT 'Uber����',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '���',
  `memo` varchar(1024) DEFAULT NULL COMMENT '��ע',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '����ʱ��',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '�޸�ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* ����ţ�����һ��ʱ��ο��� */

/**
Table structure for table `user_target`
Ŀ���û���������Ϣ+������չ��Ϣ+λ�ø������� �γ�Ŀ��
*/
DROP TABLE IF EXISTS `user_target`;

CREATE TABLE `user_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `user_nick` varchar(50) DEFAULT NULL COMMENT '�û��ǳ�',
  `pro_photo` varchar(1024) DEFAULT NULL COMMENT '������Ƭ',
  `is_heart` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ��˷�״̬1��0����',
  `is_male` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ���1��0����',
  `now_lng` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '��ǰ���꾭��',
  `now_lat` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '��ǰ����γ��',
  `pos_tile_1` varchar(32) NOT NULL DEFAULT 'allworld' COMMENT '1ǧ������L15',
  `pos_tile_2` varchar(32) NOT NULL DEFAULT 'allworld' COMMENT '4ǧ������L13',
  `pos_tile_3` varchar(32) NOT NULL DEFAULT 'allworld' COMMENT '8ǧ������L12',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '���',
  `memo` varchar(1024) DEFAULT NULL COMMENT '��ע',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '����ʱ��',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '�޸�ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/**
Table structure for table `user_dig`
�û����ޱ�A��B���� (Ҳ�����ղ�)
*/
DROP TABLE IF EXISTS `user_dig`;

CREATE TABLE `user_dig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�û�ID',
  `dig_userid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�����û�ID',
  `dig_type` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�����������ֶ�Ӧ�ȼ�',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '���',
  `memo` varchar(1024) DEFAULT NULL COMMENT '��ע',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '����ʱ��',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '�޸�ʱ��',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_target_index` (`user_id`,`dig_userid`),
  KEY `target_index` (`dig_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/**
Table structure for table `platform_event`
ƽ̨�¼����or�ȵ������Ϣ
*/
DROP TABLE IF EXISTS `platform_event`;

CREATE TABLE `platform_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(128) DEFAULT NULL COMMENT '�¼�����',
  `event_content` varchar(1024) DEFAULT NULL COMMENT '�¼�����',
  `event_pic` varchar(1024) DEFAULT NULL COMMENT '�¼�ͼƬ',
  `event_url` varchar(1024) DEFAULT NULL COMMENT '�¼�URL',
  `event_date` datetime DEFAULT NULL COMMENT '�¼�ʱ��',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '���',
  `memo` varchar(1024) DEFAULT NULL COMMENT '��ע',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '����ʱ��',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '�޸�ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/**
Table structure for table `platform_item`
ƽ̨�����ͼ���Ӧ������
*/
DROP TABLE IF EXISTS `platform_item`;

CREATE TABLE `platform_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(128) DEFAULT NULL COMMENT '��������',
  `item_desc` varchar(1024) DEFAULT NULL COMMENT '��������',
  `item_pic` varchar(1024) DEFAULT NULL COMMENT '����ͼƬ',
  `item_price` double unsigned NOT NULL DEFAULT '0' COMMENT '�����ֵ(Ԫ)',
  `flag` int(10) unsigned DEFAULT '0' COMMENT '���',
  `memo` varchar(1024) DEFAULT NULL COMMENT '��ע',
  `gmt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '����ʱ��',
  `gmt_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '�޸�ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;