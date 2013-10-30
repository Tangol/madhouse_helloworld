CREATE TABLE IF NOT EXISTS /*TABLE_PREFIX*/t_mdh_helloworld_message (
	`pk_i_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`s_content` VARCHAR(30) NOT NULL,
	PRIMARY KEY(`pk_i_id`)
) ENGINE = InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';

INSERT INTO /*TABLE_PREFIX*/t_mdh_helloworld_message(s_content) VALUES('first message');
INSERT INTO /*TABLE_PREFIX*/t_mdh_helloworld_message(s_content) VALUES('second message');