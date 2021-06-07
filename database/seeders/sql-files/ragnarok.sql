DROP TABLE IF EXISTS `ranking_pvp`;
CREATE TABLE `ranking_pvp` (
`char_id` int(11) unsigned NOT NULL,
`char_name` varchar(24) NOT NULL,
`killed` int(10) unsigned NOT NULL,
`died` int(10) unsigned NOT NULL,
`point` int(10) NOT NULL,
PRIMARY KEY (`char_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `ranking_pvp_logs`;
CREATE TABLE  `ranking_pvp_logs` (
`assassin` VARCHAR( 32 ) NOT NULL ,
`target` VARCHAR( 32 ) NOT NULL ,
`date` VARCHAR( 32 ) NOT NULL ,
`ID` INT( 11 ) NOT NULL AUTO_INCREMENT ,
PRIMARY KEY (  `ID` )
) ENGINE=MYISAM;

DROP TABLE IF EXISTS `ranking_woe`;
CREATE TABLE `ranking_woe` (
`guild_id` int(11) unsigned NOT NULL,
`guild_name` varchar(24) NOT NULL,
`killed` int(10) unsigned NOT NULL,
`died` int(10) unsigned NOT NULL,
`point` int(10) NOT NULL,
PRIMARY KEY (`guild_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
`id` int(11) NOT NULL,
`title` varchar(24) NOT NULL,
`login` varchar(24) NOT NULL,
`email` varchar(100) NOT NULL default '',
`category` varchar(24) NOT NULL,
`body` text NOT NULL,
`status` varchar(24) NOT NULL DEFAULT 'Aberto',
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tickets_replys`;
CREATE TABLE `tickets_replys` (
`id` int(11) NOT NULL,
`ticket_id` int(11) NOT NULL,
`login` varchar(24) NOT NULL,
`body` text NOT NULL,
`created_at` datetime NOT NULL,
`updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tickets_category`;
CREATE TABLE `tickets_category` (
`id` int(11) NOT NULL,
`name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tickets_category` (`id`, `name`) VALUES
(1, 'Doações'),
(2, 'Suporte'),
(3, 'Bug'),
(4, 'Denúncia');


DROP TABLE IF EXISTS `painel_configs`;
CREATE TABLE `painel_configs` (
`id` int(11) NOT NULL,
`name` varchar(24) NOT NULL,
`content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `painel_configs` (`id`, `name`, `content`) VALUES
(1, 'title', 'RS CODE - Painel'),
(2, 'title_mini', 'RS'),
(3, 'email', 'rsantos@rscode.com.br'),
(4, 'discord', 'https://discord.gg/'),
(5, 'facebook', 'https://www.facebook.com/'),
(7, 'color', 'purple'),
(8, 'colorbg', 'black'),
(9, 'levelvip', '5'),
(10, 'leveladm', '99'),
(11, 'levelgm', '50'),
(12, 'levelcm', '20');

ALTER TABLE `tickets` ADD PRIMARY KEY (`id`);
ALTER TABLE `tickets_category` ADD PRIMARY KEY (`id`);
ALTER TABLE `tickets_replys` ADD PRIMARY KEY (`id`);
ALTER TABLE `tickets` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tickets_replys` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tickets_category` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `painel_configs` ADD PRIMARY KEY (`id`);
ALTER TABLE `painel_configs`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
ALTER TABLE `login` ADD `remember_token` varchar(100) DEFAULT NULL AFTER `user_pass`;
ALTER TABLE `login` ADD `photo` VARCHAR(200) NOT NULL DEFAULT 'default.png' AFTER `remember_token`;
ALTER TABLE `login` ADD `cash` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `char` ADD `eventos` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `char` ADD `mvps` INT( 11 ) NOT NULL DEFAULT '0';
