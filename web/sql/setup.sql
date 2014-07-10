CREATE DATABASE IF NOT EXISTS `sym_story` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sym_story`;

CREATE TABLE IF NOT EXISTS `story` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(11) unsigned,
  `line` varchar(140) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`p_id`) REFERENCES `story`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP PROCEDURE IF EXISTS sym_story.CLEAR_STORY;
DELIMITER $$
CREATE PROCEDURE sym_story.CLEAR_STORY ()
BEGIN
  DELETE FROM `sym_story`.`story` WHERE `story`.`id` > 1;
END $$
DELIMITER ;

INSERT INTO `sym_story`.`story` (`id` ,`p_id`,`line`) VALUES (1, NULL, 'Once Upon a Time...');
