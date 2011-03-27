CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(255) NOT NULL unique,
  `newsletter` int(1) unsigned NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;