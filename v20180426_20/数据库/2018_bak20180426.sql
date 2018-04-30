-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?04 �?26 �?12:03
-- 服务器版本: 5.5.53
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `2018`
--

-- --------------------------------------------------------

--
-- 表的结构 `dept_info`
--

CREATE TABLE IF NOT EXISTS `dept_info` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uid',
  `dept_id` varchar(4) NOT NULL COMMENT '党支部ID',
  `dept_name` varchar(16) NOT NULL COMMENT '党支部名称',
  `dept_leader` varchar(16) DEFAULT NULL COMMENT '党支部书记',
  `dept_phone` varchar(16) DEFAULT NULL COMMENT '党支部联系电话',
  `remark` varchar(64) NOT NULL COMMENT '备注',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='党支部信息表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dept_info`
--

INSERT INTO `dept_info` (`uid`, `dept_id`, `dept_name`, `dept_leader`, `dept_phone`, `remark`) VALUES
(1, '0001', '软件学院第一党支部', '张三', '0791123456', ''),
(2, '0002', '软件学院第二党支部', '李四', '0791123456', ''),
(3, '0003', '理学院第一党支部', '王五', '0791123456', '');

-- --------------------------------------------------------

--
-- 表的结构 `message_board`
--

CREATE TABLE IF NOT EXISTS `message_board` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `message` varchar(1024) NOT NULL COMMENT '留言内容',
  `create_time` varchar(64) NOT NULL COMMENT '留言创建时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='留言板表' AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `message_board`
--

INSERT INTO `message_board` (`uid`, `username`, `message`, `create_time`) VALUES
(27, 'admin', '你们好，我是管理员', '2018-04-24 14:51:42'),
(31, 'admin', '你们好', '2018-04-26 17:46:19'),
(24, 'admin_t', '2012年我还是在读的学生，天天只知道跟宿舍的打dota，熬夜，挥霍青春，直到有一天我去食堂打饭的时候看到很多人围着电视在看比赛（或者是体育新闻？不记得了），只记得林丹夺冠的最后几分钟整个食堂所有人都鸦雀无声和夺冠后那个标志性的军礼。我完全被感染了，现在打球快6年，再没沉迷过网络游戏，有空就打球跑步锻炼身体，2012年后所有林丹用过或者代言的装备都买过，林丹的打法以及体育精神都深深的影响我，从最开始打球想和他一样帅到后来渐渐转变成通过这个体育运动来重新认识自己，由衷的想对林丹说一句，谢谢你', '2018-04-23 20:05:39');

-- --------------------------------------------------------

--
-- 表的结构 `note_board`
--

CREATE TABLE IF NOT EXISTS `note_board` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `note_title` varchar(64) NOT NULL COMMENT '通知标题',
  `note_content` varchar(1024) NOT NULL COMMENT '通知内容',
  `admin_name` varchar(16) NOT NULL COMMENT '发布通知的管理员姓名',
  `create_time` varchar(255) NOT NULL COMMENT '发布时间',
  `send_target` varchar(16) NOT NULL COMMENT '发布对象ID，1：全体老师，2：全体学生，3：全部，other:自定义',
  `note_type` varchar(16) NOT NULL COMMENT '通知类型：1：党费通知，2：党务活动通知，3：党务会议通知等',
  `is_read` int(11) NOT NULL DEFAULT '0' COMMENT '是否已读，0：未读，1：已读',
  `remark` varchar(512) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`),
  FULLTEXT KEY `create_time` (`create_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COMMENT='通知板' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `note_board`
--

INSERT INTO `note_board` (`uid`, `note_title`, `note_content`, `admin_name`, `create_time`, `send_target`, `note_type`, `is_read`, `remark`) VALUES
(1, '123', '123', 'admin', '2018-04-24 18:12:54', 'allTeacher', '0001', 0, ''),
(2, '1234', '1234', 'admin', '2018-04-24 18:36:32', '16', '0001', 0, ''),
(3, '123', '123', 'admin', '2018-04-24 18:37:52', '16', '0001', 0, ''),
(4, '123', '123', 'admin', '2018-04-24 18:38:39', '16', '0001', 0, ''),
(5, '123', '123123213', 'admin', '2018-04-24 18:39:49', '16', '0001', 0, ''),
(6, '123432', '`43214132', 'admin', '2018-04-24 18:40:53', '16', '0001', 0, ''),
(7, '一个认真的通知！', '一个认真的通知！', 'admin', '2018-04-24 18:46:32', '3', '0001', 0, ''),
(8, '一个认真的通知！', '一个认真的通知！', 'admin', '2018-04-24 18:46:32', '16', '0001', 0, ''),
(9, '软件学院的兄弟们！！', '软件学院的兄弟们！！', 'admin', '2018-04-24 18:54:40', '1', '0001', 1, ''),
(10, '软件学院的兄弟们！！', '软件学院的兄弟们！！', 'admin', '2018-04-24 18:54:40', '16', '0001', 0, ''),
(11, '软件学院的兄弟们！！', '软件学院的兄弟们！！', 'admin', '2018-04-24 18:54:40', '27', '0001', 1, ''),
(12, '哈罗~', '哈罗~', 'admin', '2018-04-24 18:57:49', '2', '0001', 0, ''),
(13, '哈罗~', '哈罗~', 'admin', '2018-04-24 18:57:49', '27', '0001', 1, ''),
(14, '哈罗~', '哈罗~', 'admin', '2018-04-24 18:57:55', '2', '0001', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `note_info`
--

CREATE TABLE IF NOT EXISTS `note_info` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `note_type_id` varchar(4) CHARACTER SET utf8 NOT NULL COMMENT '通知类型ID',
  `note_name` varchar(24) CHARACTER SET utf8 NOT NULL COMMENT '通知类型名称',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`,`note_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COMMENT='通知定义表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `note_info`
--

INSERT INTO `note_info` (`uid`, `note_type_id`, `note_name`) VALUES
(5, '0001', '党费通知'),
(6, '0002', '党务活动'),
(7, '0003', '党务会议'),
(8, '0000', '其他');

-- --------------------------------------------------------

--
-- 表的结构 `user_fee_info`
--

CREATE TABLE IF NOT EXISTS `user_fee_info` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'uid',
  `user_id` varchar(16) NOT NULL COMMENT '用户ID',
  `user_name` varchar(255) DEFAULT '' COMMENT '用户姓名',
  `fee_count` varchar(255) DEFAULT '0' COMMENT '需要交纳的费用，默认：0',
  `send_time` varchar(64) NOT NULL COMMENT '催欠发送时间',
  `period_begin` varchar(64) NOT NULL COMMENT '党费周期起始时间',
  `period_end` varchar(64) NOT NULL COMMENT '党费周期终止时间',
  `purchase_time` varchar(255) DEFAULT '',
  `purchase_status` varchar(255) DEFAULT NULL COMMENT '缴纳状态：1：已通知，2：用户已缴纳，3：管理员已确认',
  `status_chg_time` varchar(64) NOT NULL COMMENT '缴纳状态改变时间',
  `remark` varchar(255) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user_fee_info`
--

INSERT INTO `user_fee_info` (`uid`, `user_id`, `user_name`, `fee_count`, `send_time`, `period_begin`, `period_end`, `purchase_time`, `purchase_status`, `status_chg_time`, `remark`) VALUES
(2, '1', 'admin', '0', '12', '2018-04-26', '2018-04-26', '2018-4-26', '2', '2018-4-26', '请及时缴纳党费，谢谢！'),
(3, '2', 'admin_t', '0', '16', '2018-04-13', '2018-04-26', '2018-04-26 19:57:19', '2', '2018-04-26 19:57:19', '啊啊'),
(4, '2', 'admin_t', '0', '12', '2018-04-26', '2018-04-26', '2018-4-26', '2', '2018-4-26', '请及时缴纳党费，谢谢！'),
(5, '2', 'admin_t', '0', '12', '2018-04-26', '2018-04-26', '2018-4-26', '3', '2018-4-26', '请及时缴纳党费，谢谢！');

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `role_type` int(11) NOT NULL DEFAULT '1' COMMENT '身份，0:管理员，1：老师，2：学生',
  `email` varchar(64) NOT NULL COMMENT '电子邮箱',
  `dept_id` varchar(4) NOT NULL COMMENT '所属党支部',
  `status` varchar(11) NOT NULL DEFAULT '1' COMMENT '用户状态，1:正常，0：异常',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '生成时间',
  `info_chg_time` varchar(64) NOT NULL DEFAULT '0' COMMENT '状态变更时间，默认：0',
  `login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '登录IP',
  `login_time` varchar(64) NOT NULL DEFAULT '' COMMENT '最近一次登录时间',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`id`, `username`, `password`, `role_type`, `email`, `dept_id`, `status`, `create_time`, `info_chg_time`, `login_ip`, `login_time`) VALUES
(1, 'admin', 'fcea920f7412b5da7be0cf42b8c93759', 0, '0', '0001', '1', '0000-00-00 00:00:00', '2018-04-19 10:23:18', '::1', '2018-04-26 19:59:40'),
(2, 'admin_t', 'e10adc3949ba59abbe56e057f20f883e', 1, '675696416@qq.com', '0002', '1', '2018-04-18 05:00:57', '0', '::1', '2018-04-26 19:56:51'),
(3, 'admin_s', 'e10adc3949ba59abbe56e057f20f883e', 2, '0', '0003', '1', '2018-04-18 05:00:57', '0', '::1', '2018-04-24 15:46:29'),
(16, '薛臣豪', '08b2946a1ba802bca15f36f5606c654d', 2, '675696416@qq.com', '0001', '1', '2018-04-18 07:49:53', '1524037793', '::1', '2018-04-18 16:04:56'),
(27, 'teacher1', 'e10adc3949ba59abbe56e057f20f883e', 1, '339756090@qq.com', '0001', '1', '2018-04-24 10:31:23', '2018-04-24 18:31:23', '::1', '2018-04-25 16:00:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
