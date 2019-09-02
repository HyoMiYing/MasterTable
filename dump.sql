DROP TABLE `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `post_number` varchar(10) default NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `users` (`id`,`name`,`post_number`) VALUES (1,"Ivan","728415"),(2,"Nathan","267218"),(3,"Scott","94-152"),(4,"Murphy","51742-955"),(5,"Ulysses","5871"),(6,"Chadwick","42938"),(7,"Bruno","58997-893"),(8,"Kevin","81966"),(9,"Zahir","96051"),(10,"Hector","16236"),(11,"Kieran","71360"),(12,"Tyler","16324"),(13,"Philip","K3V 8K7"),(14,"Russell","46280"),(15,"Cairo","70405"),(16,"Zachary","01877"),(17,"Aristotle","31901"),(18,"Kermit","2581"),(19,"Sylvester","73249"),(20,"Jackson","95197-529"),(21,"Quinlan","2400"),(22,"Christopher","793694"),(23,"Cody","762518"),(24,"Wyatt","257134"),(25,"Cooper","52741"),(26,"Jared","8492"),(27,"Owen","267618"),(28,"Kermit","909033"),(29,"Matthew","11912"),(30,"Axel","8725"),(31,"Devin","95329"),(32,"Barrett","8144"),(33,"Neil","8422"),(34,"Murphy","1199 VD"),(35,"Ulric","93663"),(36,"Aquila","21904"),(37,"Isaiah","41917"),(38,"Odysseus","Y8C 0J8"),(39,"Beau","365525"),(40,"Acton","74213"),(41,"Abraham","7603"),(42,"Dean","32427-324"),(43,"Abbot","9150"),(44,"Allistair","1997"),(45,"Cameron","73-570"),(46,"Kane","61498-460"),(47,"Moses","X9V 4H4"),(48,"Talon","720136"),(49,"Scott","464169"),(50,"Lester","H7R 2S2"),(51,"Hayes","75572"),(52,"Steel","60168"),(53,"Damian","52137"),(54,"Alec","60718"),(55,"Xenos","10515"),(56,"Stephen","41613-909"),(57,"Branden","1608"),(58,"Lucas","229168"),(59,"Dolan","484464"),(60,"Jack","24067"),(61,"Harlan","635772"),(62,"Bert","42761"),(63,"Malik","17371"),(64,"Conan","84567"),(65,"Conan","880352"),(66,"Craig","V8P 9N7"),(67,"Hayes","P7T 5L2"),(68,"Marsden","8719"),(69,"Gage","49471"),(70,"Rashad","GU22 2NS"),(71,"Devin","61807"),(72,"Fitzgerald","48705"),(73,"Porter","03-343"),(74,"Mufutau","52622"),(75,"Lane","A4C 4T9"),(76,"Griffin","94904"),(77,"Cullen","3401"),(78,"Lewis","98-930"),(79,"Amery","E9J 3C6"),(80,"Caldwell","03343"),(81,"Kato","7468"),(82,"Travis","81909"),(83,"Callum","86190"),(84,"Coby","81474-760"),(85,"Armand","24183"),(86,"Fuller","Y0M 6V9"),(87,"Oleg","2341"),(88,"Erich","30653"),(89,"Sebastian","40119"),(90,"Kermit","Y3S 8A4"),(91,"Kyle","B1R 1R4"),(92,"Theodore","935379"),(93,"Callum","A3K 3P8"),(94,"Hoyt","00119"),(95,"Jameson","2429 RN"),(96,"Jarrod","6276"),(97,"Jeremy","37353"),(98,"Jordan","K3T 3MM"),(99,"Dylan","837496"),(100,"Eaton","137064");

CREATE TABLE `authentication` (
  `id`mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `password_hash` varchar(300) default NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;