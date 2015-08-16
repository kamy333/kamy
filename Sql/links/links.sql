DROP TABLE IF EXISTS links;
DROP TABLE IF EXISTS links_category;



CREATE TABLE links_category (
  id int(11) NOT NULL AUTO_INCREMENT ,
  category varchar(50) NOT NULL UNIQUE ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



CREATE TABLE links (
  id int(11) NOT NULL AUTO_INCREMENT ,
  name varchar(50) NOT NULL ,
  web_address text DEFAULT NULL,
  description text DEFAULT NULL,
  category varchar(50) NOT NULL DEFAULT 'Others',
  sub_category_1 varchar(50) NULL ,
  sub_category_2 varchar(50) NULL ,
  privacy TINYINT(1) DEFAULT 0,
  rank INT(11) DEFAULT 0,
  username varchar(50) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


SELECT name,web_address,description,category,sub_category_1,sub_category_2,privacy,`rank` FROM links;