

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



INSERT INTO ikamych.pages (id, subject_id, menu_name, position, visible, content) VALUES (1, 1, 'My Mission', 1, 1, 'My mission, bring the best out of myself. To learn and acquire knowledge.');
INSERT INTO ikamych.pages (id, subject_id, menu_name, position, visible, content) VALUES (2, 1, 'My History', 2, 1, 'I''m Kamran Nafisspour and i''m born in 1964 (already 50 yo!) Tehran Iran. I grew up in Paris but also lived during my childhood or for my studies few years  in Crans-Montana Switzerland in Tehran Iran, Jerusalem Israel , Baltimore US and settled now in Geneva Switzerland.

I''m an US Certified Public Accountant and worked in Private Banking in finance at Standard Chartered , Merrill Lynch and Julius Baer in Switzerland. I started as an accounting clerk to a position as director and managed all areas from legal, management and regulatory reporting. I also was the  project manager for the department and as an example implemented Basel II and III or any new regulatory or group level requirement.

During my career I used extensively the Microsoft Office tools in particular Microsoft Excel and Access using also the programming language VBA that I learned by myself It helped me build some powerful things that benefiting everyone and speed the work and increase efficiency.

Now I took the challenge to learn about the fascinating web world. I subscribed to Lynda.com a tutorial website which offers technologies videos. 
So started few months ago to learn several languages HTML, CSS, Javascript and Jquery, PHP, mySQL,  XML, Jason, learning some new IDE DreamwWeaver, Sublimetext managing a website.

This website was created by me with the help of a Lynda.com course which I expanded. This a modest CMS (Content Management System) using essentially PHP and mySQL but also other technologies. It contains a public website and admin access which is secured and password protected and depending on the rights some password protected are also restricted to certain area. 

My aim is to create a fully featured CMS that can be used by small companies to manage their website to the public and the business data too through the web using MySQL databases, analyzing , retrieving data ... A full and complete application.
');
INSERT INTO ikamych.pages (id, subject_id, menu_name, position, visible, content) VALUES (7, 1, 'Contact me', 3, 1, 'Please contact me at nafisspour@bluewin.ch and let me know how I can help you.');
