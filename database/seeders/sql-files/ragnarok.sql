DROP TABLE IF EXISTS `arena_pvp`;
CREATE TABLE `arena_pvp` (
`char_id` int(11) unsigned NOT NULL,
`char_name` varchar(24) NOT NULL,
`matou` int(10) unsigned NOT NULL,
`morreu` int(10) unsigned NOT NULL,
`total` int(10) NOT NULL,
PRIMARY KEY (`char_id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `arena_pvp_logs`;
CREATE TABLE  `arena_pvp_logs` (
`assassino` VARCHAR( 32 ) NOT NULL ,
`alvo` VARCHAR( 32 ) NOT NULL ,
`data` VARCHAR( 32 ) NOT NULL ,
`ID` INT( 11 ) NOT NULL AUTO_INCREMENT ,
PRIMARY KEY (  `ID` )
) ENGINE=MYISAM;

DROP TABLE IF EXISTS `ranking_woe`;
CREATE TABLE `ranking_woe` (
`guild_id` int(11) unsigned NOT NULL,
`guild_name` varchar(24) NOT NULL,
`matou` int(10) unsigned NOT NULL,
`morreu` int(10) unsigned NOT NULL,
`total` int(10) NOT NULL,
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
`tickets` varchar(24) NOT NULL DEFAULT 'Aberto',
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

DROP TABLE IF EXISTS `item_db`;
CREATE TABLE `item_db` (
`id` int(11) UNSIGNED NOT NULL DEFAULT '0',
`name_english` varchar(50) NOT NULL DEFAULT '',
`name_japanese` varchar(50) NOT NULL DEFAULT '',
`type` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
`subtype` tinyint(2) UNSIGNED DEFAULT NULL,
`price_buy` mediumint(10) DEFAULT NULL,
`price_sell` mediumint(10) DEFAULT NULL,
`weight` smallint(5) UNSIGNED DEFAULT NULL,
`atk` smallint(5) UNSIGNED DEFAULT NULL,
`matk` smallint(5) UNSIGNED DEFAULT NULL,
`defence` smallint(5) UNSIGNED DEFAULT NULL,
`range` tinyint(2) UNSIGNED DEFAULT NULL,
`slots` tinyint(2) UNSIGNED DEFAULT NULL,
`equip_jobs` bigint(20) UNSIGNED DEFAULT NULL,
`equip_upper` tinyint(8) UNSIGNED DEFAULT NULL,
`equip_genders` tinyint(2) UNSIGNED DEFAULT NULL,
`equip_locations` mediumint(8) UNSIGNED DEFAULT NULL,
`weapon_level` tinyint(2) UNSIGNED DEFAULT NULL,
`equip_level_min` smallint(5) UNSIGNED DEFAULT NULL,
`equip_level_max` smallint(5) UNSIGNED DEFAULT NULL,
`refineable` tinyint(1) UNSIGNED DEFAULT NULL,
`disable_options` tinyint(1) UNSIGNED DEFAULT NULL,
`view_sprite` smallint(3) UNSIGNED DEFAULT NULL,
`bindonequip` tinyint(1) UNSIGNED DEFAULT NULL,
`forceserial` tinyint(1) UNSIGNED DEFAULT NULL,
`buyingstore` tinyint(1) UNSIGNED DEFAULT NULL,
`delay` mediumint(9) UNSIGNED DEFAULT NULL,
`trade_flag` smallint(4) UNSIGNED DEFAULT NULL,
`trade_group` smallint(3) UNSIGNED DEFAULT NULL,
`nouse_flag` smallint(4) UNSIGNED DEFAULT NULL,
`nouse_group` smallint(4) UNSIGNED DEFAULT NULL,
`stack_amount` mediumint(6) UNSIGNED DEFAULT NULL,
`stack_flag` tinyint(2) UNSIGNED DEFAULT NULL,
`sprite` mediumint(6) UNSIGNED DEFAULT NULL,
`script` text,
`equip_script` text,
`unequip_script` text,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `mob_db`;
CREATE TABLE `mob_db` (
`ID` MEDIUMINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Sprite` TEXT NOT NULL,
`kName` TEXT NOT NULL,
`iName` TEXT NOT NULL,
`LV` TINYINT(6) UNSIGNED NOT NULL DEFAULT '0',
`HP` INT(9) UNSIGNED NOT NULL DEFAULT '0',
`SP` MEDIUMINT(9) UNSIGNED NOT NULL DEFAULT '0',
`EXP` MEDIUMINT(9) UNSIGNED NOT NULL DEFAULT '0',
`JEXP` MEDIUMINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Range1` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0',
`ATK1` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`ATK2` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`DEF` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`MDEF` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`STR` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`AGI` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`VIT` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`INT` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`DEX` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`LUK` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`Range2` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0',
`Range3` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0',
`Scale` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0',
`Race` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0',
`Element` TINYINT(4) UNSIGNED NOT NULL DEFAULT '0',
`Mode` INT(11) UNSIGNED NOT NULL DEFAULT '0',
`Speed` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`aDelay` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`aMotion` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`dMotion` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
`MEXP` MEDIUMINT(9) UNSIGNED NOT NULL DEFAULT '0',
`MVP1id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`MVP1per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`MVP2id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`MVP2per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`MVP3id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`MVP3per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop1id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop1per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop2id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop2per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop3id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop3per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop4id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop4per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop5id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop5per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop6id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop6per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop7id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop7per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop8id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop8per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop9id` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`Drop9per` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`DropCardid` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
`DropCardper` SMALLINT(9) UNSIGNED NOT NULL DEFAULT '0',
PRIMARY KEY (`ID`)
) ENGINE=MyISAM;


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
