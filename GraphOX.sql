CREATE TABLE IF NOT EXISTS `yii_forum` (
  `forum_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `type` char(1) NOT NULL,
  `parentforum` int(5) NOT NULL DEFAULT '0',
  `last_poster_name` varchar(120) NOT NULL,
  `last_poster_id` int(5) NOT NULL,
  `last_thread` varchar(120) NOT NULL,
  `last_post_id` int(5) NOT NULL,
  `last_post_time` int(11) NOT NULL,
  PRIMARY KEY (`forum_id`),
  UNIQUE KEY `forum_id` (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `yii_forum`
--

INSERT INTO `yii_forum` (`forum_id`, `name`, `description`, `type`, `parentforum`, `last_poster_name`, `last_poster_id`, `last_thread`, `last_post_id`, `last_post_time`) VALUES
(5, 'test', 'test', 'c', 0, '', 0, '', 0, 0),
(6, 'Haha', 'Haha', 'f', 0, '', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `yii_groups`
--

CREATE TABLE IF NOT EXISTS `yii_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `yii_groups`
--

INSERT INTO `yii_groups` (`group_id`, `group_name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(4, 'user'),
(3, 'trusted');

-- --------------------------------------------------------

--
-- Table structure for table `yii_links`
--

CREATE TABLE IF NOT EXISTS `yii_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_label` varchar(20) NOT NULL,
  `link_title` varchar(20) DEFAULT NULL,
  `link_url` varchar(20) NOT NULL,
  UNIQUE KEY `Link ID` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `yii_links`
--

INSERT INTO `yii_links` (`id`, `link_label`, `link_title`, `link_url`) VALUES
(1, 'Home', 'Go home', '/site/index');

-- --------------------------------------------------------

--
-- Table structure for table `yii_post`
--

CREATE TABLE IF NOT EXISTS `yii_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(10) NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_thread` (`thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `yii_thread`
--

CREATE TABLE IF NOT EXISTS `yii_thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastpostcreate_time` int(11) NOT NULL,
  `last_poster_id` int(5) NOT NULL,
  `last_poster_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `forum_id` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_thread_author` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `yii_users`
--

CREATE TABLE IF NOT EXISTS `yii_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_mail` varchar(100) NOT NULL,
  `user_group` int(1) NOT NULL,
  `user_acti` int(1) NOT NULL DEFAULT '1',
  `user_acti_pass` varchar(100) NOT NULL,
  UNIQUE KEY `ID` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `yii_users`
--

INSERT INTO `yii_users` (`id`, `user_name`, `user_pass`, `user_mail`, `user_group`, `user_acti`, `user_acti_pass`) VALUES
(91, 'gear4', '31da03e43a2586ad66a224f0c00f25bf19eadb382294a45533b22c90a63dd57ec8311f98ba40c3e8', 'aaron@graphox.us', 0, 3, '9baa28c743568678697a75dafadfa9ce4e7121ed');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `yii_post`
--
ALTER TABLE `yii_post`
  ADD CONSTRAINT `FK_post_thread` FOREIGN KEY (`thread_id`) REFERENCES `yii_thread` (`id`) ON DELETE CASCADE;


