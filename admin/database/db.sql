--
-- This is a cleaned and corrected version of the database schema.
-- The following changes were made:
-- 1. Corrected the 'options' table to remove the invalid DEFAULT value on the 'option_value' column.
-- 2. Increased the length of the 'user_address' column in the 'users' table to prevent data truncation.
-- 3. Removed the invalid zero-date default from the 'posts' table and replaced it with a valid timestamp.
-- 4. Corrected the 'posts' INSERT statements that were inserting a zero-date.
-- 5. Translated all Vietnamese text in INSERT statements to English.
--

DROP TABLE IF EXISTS cart_user;

CREATE TABLE `cart_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `number` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`user_id`),
  KEY `fk_id_product` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cart_user VALUES("25","2","8","6");
INSERT INTO cart_user VALUES("8","3","7","3");
INSERT INTO cart_user VALUES("10","3","4","2");
INSERT INTO cart_user VALUES("23","3","28","1");


DROP TABLE IF EXISTS categories;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supply_id` int(11) DEFAULT NULL,
  `category_position` int(4) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_supply_id` (`supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=557 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categories VALUES("1","Eating & Drinking","1","1","an-uong");
INSERT INTO categories VALUES("2","Beauty","1","2","lam-dep");
INSERT INTO categories VALUES("3","Cosmetics","1","3","my-pham");


DROP TABLE IF EXISTS comments;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'author-comment.png',
  `editTime` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT 0,
  `post_id` int(11) DEFAULT 0,
  `page_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_id_product` (`product_id`),
  KEY `fk_id_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO comments VALUES("1",0,"0","The milk tea is very delicious, my friend","2020-03-27 00:00:00","Tan","tan12357@gmail.com","0","author-comment.png",NULL,"4",0,0);
INSERT INTO comments VALUES("4",0,"0","The milk tea is very delicious, this is my favorite tea flavor. I hope next time there will still be a lot of jelly in the cup. Thank you, owner!!","2020-03-27 02:18:17","Trung AV","trungtin@gmail.com","0","author-comment.png","2020-04-10 15:55:11","2",0,0);
INSERT INTO comments VALUES("7",0,"2","régrest","2020-04-01 13:12:20","Tan Hong IT","phuongtan12357nguyen@gmail.com ?> ","2","avatar-user1011-tanhongit.jpg",NULL,"2",0,0);
INSERT INTO comments VALUES("8",0,"2","régrest","2020-04-01 13:15:09","Tan Hong IT","phuongtan12357nguyen@gmail.com","3","avatar-user1011-tanhongit.jpg",NULL,"2",0,0);
INSERT INTO comments VALUES("9",0,"2","Thank you very much, shop","2020-04-10 19:27:57","Tan Hong ","phuongtan12357nguyen@gmail.com","2","avatar-user1011-tanhongit.jpg",NULL,"22",0,0);


DROP TABLE IF EXISTS contacts;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_Logo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_Contact` varchar(550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_Facebook` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_Twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zalo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_footer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO contacts VALUES("1","logo-chikoiquan-tan-hong-it.png","Tan Hong IT","410, Hung Vuong Street, Gia Ray Town, Xuan Loc, Dong Nai","Vietnam","0339908569","0941838069","test@gmail.com","javascript:void(0);","https://www.facebook.com/tanhongit","https://twitter.com/tanhongit","http://www.linkedin.com/in/tanhongit","0363220339","page/1-about","Website selling food and drinks as well as some convenient cosmetics. Built by Tan Hong IT","favicon-chikoiquan-tan-hong-it.png");


DROP TABLE IF EXISTS feedbacks;

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` int(20) DEFAULT NULL,
  `subject` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createTime` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `editTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_product_id` (`product_id`),
  KEY `fk_order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO feedbacks VALUES("1","Tan Hong ","phuongtan12357nguyen@gmail.com","363220339","abc","2020-04-05 16:58:23","2","0","2","1",NULL);
INSERT INTO feedbacks VALUES("2","Tan Hong ","phuongtan12357nguyen@gmail.com","363220339","abc de","2020-04-05 16:59:35","2","0","2","0",NULL);
INSERT INTO feedbacks VALUES("3","Tan Hong ","phuongtan12357nguyen@gmail.com","363220339","abc de","2020-04-05 17:01:52","2","0","2","1",NULL);
INSERT INTO feedbacks VALUES("4","Nguyen Tan","test@gmail.com","1663220339","srdxtfcghjooi","2020-04-05 17:06:46","1","0","28","1","2020-04-09 16:48:56");
INSERT INTO feedbacks VALUES("5","Nguyen Tan","test@gmail.com","1663220339","Hehe love you","2020-04-05 17:07:36","1","0","0","1",NULL);
INSERT INTO feedbacks VALUES("6","Alibaba","alibaba@gmail.com","1234567890","aladin","2020-04-05 17:12:32","0","0","0","1","2020-04-10 23:26:58");
INSERT INTO feedbacks VALUES("7","aladin","aladin@gmail","363220339","reywsrewyre","2020-04-05 17:13:23","0","0","8","0","2020-04-10 23:26:49");
INSERT INTO feedbacks VALUES("8","y54wy54wy","ewt43wt54w@gmail.com","432542543","regresg","2020-04-05 17:23:09","0","4","0","0",NULL);
INSERT INTO feedbacks VALUES("9","Tan Hong ","phuongtan12357nguyen@gmail.com","12345678","I don't want to buy this order anymore, what can you do to me","2020-04-06 14:48:32","2","3","0","1","2020-04-11 19:08:07");
INSERT INTO feedbacks VALUES("11","url","","339908569","ydyr","2020-04-09 00:00:00","0","0","0","1",NULL);
INSERT INTO feedbacks VALUES("12","Tan Hong ","phuongtan12357nguyen@gmail.com","363220339","drtrdurdytuyt","2020-04-11 05:45:38","2","0","0","0",NULL);
INSERT INTO feedbacks VALUES("13","Tan Hong IT","phuongtan12357@gmail.com","363220339","dyrdturdtrdytdrtr ","2020-04-11 05:46:01","0","0","0","0",NULL);


DROP TABLE IF EXISTS introduce;

CREATE TABLE `introduce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_footer` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS media;

CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO media VALUES("9","Tan Hong IT Logo","logo-tan-hong-it.jpg","2020-03-24 21:18:30");
INSERT INTO media VALUES("8","Basic PHP programming course (Original)","lap-trinh-php-can-ban.png","2020-03-24 21:14:02");
INSERT INTO media VALUES("10","logo old youtube","logo-old-youtube.png","2020-03-24 23:19:14");
INSERT INTO media VALUES("11","coronavirus season","mua-corona-virut.jpg","2020-03-29 08:38:01");
INSERT INTO media VALUES("13","the father of the computer","cha-de-cua-may-vi-tinh.jpg","2020-04-02 01:48:11");
INSERT INTO media VALUES("14","chikoi quan logo","logo-chikoi-quan.png","2020-04-04 20:53:10");
INSERT INTO media VALUES("15","chi koi quan favicon","favicon-chi-koi-quan.png","2020-04-04 20:53:41");
INSERT INTO media VALUES("16","exclude ip access time","loai-tru-thoi-gian-truy-cap-ip.jpg","2020-04-11 17:33:42");


DROP TABLE IF EXISTS menu_footers;

CREATE TABLE `menu_footers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO menu_footers VALUES("1","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("2","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("3","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("4","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("5","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("6","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("7","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("8","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("9","Not available","javascript:void(0);","","0");
INSERT INTO menu_footers VALUES("10","Featured Products","type/1-san-pham-hot","Featured Products","0");
INSERT INTO menu_footers VALUES("11","New Products","type/2-san-pham-moi","New Products","0");
INSERT INTO menu_footers VALUES("12","On Sale","type/3-san-pham-dang-giam-gia","Products on sale","0");
INSERT INTO menu_footers VALUES("18","Text Link","javascript:void(0);","","1");
INSERT INTO menu_footers VALUES("19","Social","javascript:void(0);","Social media links","1");
INSERT INTO menu_footers VALUES("20","Blog","javascript:void(0);","","1");
INSERT INTO menu_footers VALUES("21","Product types","javascript:void(0);","","1");


-- CORRECTION: Removed the `DEFAULT ''` from the `longtext` column as it's not allowed.
DROP TABLE IF EXISTS options;

CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS order_detail;

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_id` (`order_id`),
  KEY `fk_id_product` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO order_detail VALUES("1","1","4","1","15000");
INSERT INTO order_detail VALUES("2","1","12","10","15000");
INSERT INTO order_detail VALUES("3","2","14","1","10000");
INSERT INTO order_detail VALUES("4","3","4","1","15000");
INSERT INTO order_detail VALUES("5","3","12","1","15000");
INSERT INTO order_detail VALUES("6","4","6","1","15000");
INSERT INTO order_detail VALUES("7","4","2","4","15000");
INSERT INTO order_detail VALUES("8","4","4","2","15000");
INSERT INTO order_detail VALUES("9","5","14","1","100");
INSERT INTO order_detail VALUES("10","6","28","1","10000");
INSERT INTO order_detail VALUES("11","8","4","1","15000");
INSERT INTO order_detail VALUES("12","8","28","5","10000");
INSERT INTO order_detail VALUES("13","7","5","6","15000");
INSERT INTO order_detail VALUES("14","9","8","1","10000");
INSERT INTO order_detail VALUES("15","10","28","8","10000");
INSERT INTO order_detail VALUES("16","10","4","5","15000");
INSERT INTO order_detail VALUES("17","10","2","11","15000");
INSERT INTO order_detail VALUES("18","10","1","64","10000");
INSERT INTO order_detail VALUES("19","10","8","9","10000");
INSERT INTO order_detail VALUES("20","11","28","1","10000");
INSERT INTO order_detail VALUES("21","11","4","11","15000");
INSERT INTO order_detail VALUES("22","11","5","9","15000");
INSERT INTO order_detail VALUES("23","11","9","2","15000");


DROP TABLE IF EXISTS orders;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_total` double NOT NULL,
  `createtime` datetime NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `editTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO orders VALUES("1","Nguyen Phuong Tan","Dong Nai","khu 2, thi tran gia ray, xuan loc, dong nai, vn","0363220339","165000","2020-03-21 10:19:59","","0","0",NULL);
INSERT INTO orders VALUES("10","Tan Hong IT","Dong Nai","xuan loc, dong nai, vietnam","0363220339","1050000","2020-04-17 10:38:09","he no at","0","0",NULL);
INSERT INTO orders VALUES("4","Nguyen Phuong Tan","Dong Nai","khu 2, thi tran gia ray, xuan loc, dong nai, vn","0363220339","105000","2020-03-25 13:29:57","","3","2","2020-04-10 22:07:25");
INSERT INTO orders VALUES("5","drt","-","xuan loc, dong nai, vietnam","0363220339","80","2020-03-25 16:21:38","","0","1",NULL);
INSERT INTO orders VALUES("6","Nguyen Phuong Tan","Dong Nai","khu 2, thi tran gia ray, xuan loc, dong nai, vn","0363220339","10000","2020-03-29 20:24:33","fgh","0","1",NULL);
INSERT INTO orders VALUES("7","Nguyen Phuong Tan","Dong Nai","khu 2, thi tran gia ray, xuan loc, dong nai, vn","0363220339","10000","2020-03-29 20:25:46","fgh","1","0",NULL);
INSERT INTO orders VALUES("8","Tan Hong IT","Dong Nai","xuan loc, dong nai, vietnam","363220339","155000","2020-04-02 10:44:06","ghtrsehts htr yht whtwsht eshtesh té tesh ts hres hsh t","0","1",NULL);
INSERT INTO orders VALUES("9","Tan Hong ","yth","xuan loc, dong nai, vietnam","363220339","10000","2020-04-10 22:06:29","","0","2","2020-04-10 22:08:28");
INSERT INTO orders VALUES("11","Nguyen Phuong Tan","Dong Nai","khu 2, thi tran gia ray, xuan loc, dong nai, vn","0363220339","340000","2020-04-18 12:56:31","","0","2",NULL);


DROP TABLE IF EXISTS posts;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_author` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Draft',
  `post_modified` datetime NULL DEFAULT NULL,
  `post_type` int(11) NOT NULL DEFAULT 1,
  `post_modified_user` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalView` int(11) NOT NULL DEFAULT 0,
  `post_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO posts VALUES("1","2","2020-04-08 05:57:42","","About","Published","2020-04-08 06:31:51","2","Tan Hong ","48","about","about-1page.png");
INSERT INTO posts VALUES("9","3","2020-04-12 13:20:20","","Web developmwnt","Published",NULL,"2",NULL,"0","fewrfewrew",NULL);
INSERT INTO posts VALUES("8","2","2020-04-08 23:13:53","","Terms of use","Published",NULL,"2",NULL,"1","terms-of-use-page",NULL);
INSERT INTO posts VALUES("6","2","2020-04-08 11:47:48","","DMCA Copyright Law","Trash","2020-04-08 10:25:58","1","Tan Hong ","5","dmca-luat-ban",NULL);
INSERT INTO posts VALUES("5","2","2020-04-09 14:03:15","High quality Vietnamese movies<br />
\n<img alt=\"\" src=\"/php-mvc-shop/public/upload/ckeditorimages/about-1page.png\" style=\"height:271px; width:482px\" />","Vietnamese Movies","Published","2020-04-08 10:13:10","1","Tan Hong ","4","phim-viet","phim-viet-5post.png");
INSERT INTO posts VALUES("4","2","2020-04-12 12:54:02","ouhiuh<br />
\naad<br />
\n<img alt=\"\" src=\"/php-mvc-shop/public/upload/ckeditorimages/tenor.gif\" style=\"height:498px; width:498px\" /><br />
\n<br />
\nfhgtfrdhtrd<br />
\nỵytrj","Privacy Policy","Draft","2020-04-08 06:05:46","2","Tan Hong ","7","privacy-policy","privacy-policy-4page.jpg");
INSERT INTO posts VALUES("3","2","2020-04-08 06:17:37","Copyright law based on global law<br />
\n<img alt=\"\" src=\"/php-mvc-shop/public/upload/ckeditorimages/dmca-luat-ban-quyen-2page.jpg\" style=\"height:304px; width:650px\" />","DMCA Copyright Law","Published","2020-04-07 23:52:43","2",NULL,"1","dmca-luat-ban-quyen",NULL);


DROP TABLE IF EXISTS products;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_typeid` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `supply_id` int(11) DEFAULT NULL,
  `product_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createBy` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createDate` date DEFAULT NULL,
  `editBy` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editDate` datetime DEFAULT NULL,
  `totalView` int(11) DEFAULT 0,
  `saleoff` tinyint(11) DEFAULT 0,
  `percentoff` int(11) DEFAULT NULL,
  `img1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_supply_id` (`supply_id`),
  KEY `fk_type_id` (`product_typeid`),
  KEY `fk_id_sub_category` (`sub_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","Sunflower Seeds of Good Quality and Cheap Price","2","1","4","1","Sunflower seeds have large seeds, good quality, no smell, no empty or rotten seeds. Promotes cardiovascular health","10000","Black","Sunflower seeds","Large 100g","Sunflower seeds have large seeds, good quality, no smell, no empty or rotten seeds.<br />
\n<br />
\nSunflower seeds are a gift from the sunflower or sun flower, wherever it grows, the flower always faces the sun. Therefore, sunflower seeds absorb and accumulate special minerals from the sun's rays, which are very good for human health. Mother Nature gives humanity a very valuable seed.<br />
\n<br />
\nSunflower seeds have a gray or black shell, shaped like a teardrop. Peeling the shell will have an attractive flavor and soft texture. According to a study published in ""Food Chemistry,"" sunflower seeds have a very high oil content, healthy fats, and are an excellent and rich source of vitamin E, copper, manganese, selenium, phosphorus, magnesium, vitamin B1, vitamin B6, folate and niacin.<br />
\n<br />
\n<strong>Instructions for use</strong>: Eat directly<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\n<u><strong>Uses</strong></u>:<br />
\n&nbsp;- Promotes cardiovascular health.<br />
\n&nbsp;- Provides Selenium, a powerful antioxidant that boosts thyroid health.<br />
\n&nbsp;- Supports depression, helps improve mood.<br />
\n<br />
\nCommitment to Food Safety and Hygiene.","","2020-03-18","Tan Hong ","2020-04-18 21:44:04","101","0","0","hat-huong-duong-chat-luong-gia-re-1img1.jpg","hat-huong-duong-chat-luong-gia-re-1img2.jpg","","","hat-huong-duong-chat-luong-gia-re-chin-ngon");
INSERT INTO products VALUES("2","Green Thai Milk Tea (Jelly, Pudding) 15k, 20k","2","1","3","1","Thai milk tea (Thai green tea) is a familiar drink that is not only considered a panacea against aging...","15000","Green","Thai green tea, fatty milk, jelly, pudding, pearls,...","Medium - 15k, Large - 20k","Thai milk tea (Thai green tea) is a familiar drink that is not only considered an anti-aging panacea, with its excellent beauty effects, green tea also helps you quench your thirst and stay awake during the hot, tired summer days. Thai green tea with a weight of 200g is produced in Thailand according to advanced high-tech standards, made from fresh, pure green tea buds through a careful selection process.<br />
\n<br />
\nThai green milk tea has a fragrant tea flavor, and a rich, creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note <img alt=\"heart\" src=\"http://localhost/new-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" style=\"height:23px; width:23px\" title=\"heart\" />)","","2020-03-18","Tan Hong ","2020-04-18 17:49:59","115","0","0","tra-sua-thai-xanh-chan-chau-pudding-15k-20k-2img1.jpg","tra-sua-thai-xanh-chan-chau-pudding-15k-20k-2img2.jpg","tra-sua-thai-xanh-chan-chau-pudding-15k-20k-2img3.jpg","tra-sua-thai-xanh-chan-chau-pudding-15k-20k-2img4.jpg","tra-sua-thai-xanh-chan-chau-pudding-15k-20k");
INSERT INTO products VALUES("3","Traditional Milk Tea (Jelly, Pudding) 15k, 20k","2","1","3","1","Traditional milk tea has a fragrant tea flavor, and a rich, creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.","15000","Grey brown","Tea, fatty milk, jelly, pudding, pearls","Medium - 15k, Large - 20k","Milk tea is a refreshing drink that has been imported to Vietnam about 10 years ago, since childhood we have been familiar with a cup of fruit jelly milk tea with all kinds of colors or all kinds of flavors.&nbsp;<br />
\n<br />
\nTraditional milk tea has a fragrant tea flavor, and a rich, creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-18","Tan Hong ","2020-04-11 12:35:05","33","0","0","tra-sua-truyen-thong-chan-chau-pudding-15k-20k-3img1.jpg","tra-sua-truyen-thong-chan-chau-pudding-15k-20k-3img2.jpg","","","tra-sua-truyen-thong-chan-chau-pudding-15k-20k");
INSERT INTO products VALUES("4","Strawberry Flavored Milk Tea (Jelly, Pudding) 15k, 20k","2","1","3","1","Strawberry Flavored Milk Tea (Jelly, Pudding) is a familiar and delicious drink...","15000","Pink","Strawberry flavor, fatty milk, jelly, pudding, pearls...","Medium - 15k, Large - 20k","With the sweetness extracted from delicious strawberries, a type of milk tea was born that is attractive to children because of its pleasant color. Pink color and sweet taste are always the top priorities that people like the most, and the aroma of this miraculous fruit has made not only children but also adults mesmerized.<br />
\n<br />
\nStrawberry flavored milk tea has a fragrant tea flavor, and a rich, creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-11 12:34:00","212","0","0","tra-sua-vi-dau-1.jpg","tra-sua-vi-dau-chan-chau-pudding-15k-20k-4img2.jpg","tra-sua-vi-dau-chan-chau-pudding-15k-20k-4img3.jpg","","tra-sua-vi-dau-chan-chau-pudding-15k-20k");
INSERT INTO products VALUES("5","Chocolate Flavored Milk Tea (Jelly, Pudding) 15k, 20k","2","1","3","1","With a pre-mixed formula that creates a new flavor for chocolate milk tea, Chocolate pearl milk tea has a fragrant tea flavor, chocolate flavor, and creamy milk flavor...","15000","Brown","Chocolate, fatty milk, jelly, pudding, pearls...","Medium - 15k, Large - 20k","CHOCOLATE MILK TEA. Also like matcha green tea or red milk tea.<br />
\n<br />
\nWith a pre-mixed formula that creates a new flavor for chocolate milk tea, Chocolate pearl milk tea has a fragrant tea flavor, chocolate flavor, and creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-11 15:03:52","124","0","0","tra-sua-vi-socola-chan-chau-pudding-15k-20k-5img1.jpg","","","","tra-sua-vi-socola-chan-chau-pudding-15k-20k");
INSERT INTO products VALUES("6","Peach Flavored Milk Tea (Jelly, Pudding) 15k, 20k","2","1","3","1","Peach flavored milk tea has a fragrant peach tea flavor, and a rich, creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.","15000","Pinkish brown","Peach flavor, fatty milk, jelly, pudding, pearls...","Medium - 15k, Large - 20k","<em>With a delicious and easy-to-drink flavor, milk tea has always been a drink that has never been ""cold"", especially for young people. Another feature that makes milk tea so popular is that it can be combined with many fruits and jellies to create attractive, characteristic flavors and meet the preferences of many people.&nbsp;</em><br />
\n<br />
\nPeach flavored milk tea has a fragrant peach tea flavor, and a rich, creamy milk flavor... with crunchy jelly, pudding, and chewy pearls that are very attractive.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately.<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-11 12:37:50","49","0","0","tra-sua-vi-dao-chan-chau-pudding-15k-20k-6img1.jpg","tra-sua-vi-dao-chan-chau-pudding-15k-20k-6img2.jpg","","","tra-sua-vi-dao-chan-chau-pudding-15k-20k");
INSERT INTO products VALUES("7","Winter Melon Tea - Refreshing, detoxifying","2","1","5","1","Winter melon tea is a type of tea made from winter melon and rock sugar, which has a very good cooling effect...","10000","Brownish black","Winter melon, rock sugar","Medium cup, can be set up for a larger cup","Winter melon tea is a type of tea made from winter melon and rock sugar. This is a very popular drink in many countries. Especially in China, Taiwan and Vietnam. Winter melon tea is believed to be a drink that has a very good cooling effect. And this tea is also believed to have the ability to lose weight.<br />
\n&nbsp;
\n<h3><strong>Uses of winter melon tea</strong></h3>
\n
\n<p style=\"margin-left:40px\">1. Winter melon tea helps to lose weight</p>
\n
\n<p style=\"margin-left:40px\">2. Winter melon tea helps with beautiful skin</p>
\n
\n<p style=\"margin-left:40px\">3. Winter melon tea helps to detoxify</p>
\n
\n<p style=\"margin-left:40px\">4. Winter melon tea helps to cool down</p>
\n
\n<p style=\"margin-left:40px\">5. Winter melon tea is good for the digestive system</p>
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose different sizes and prices when ordering.( When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-11 14:10:55","53","0","0","tra-bi-dao-giai-khat-thanh-loc-co-the-7img1.jpg","tra-bi-dao-giai-khat-thanh-loc-co-the-7img2.jpg","tra-bi-dao-giai-khat-thanh-loc-co-the-7img3.jpg","","tra-bi-dao-giai-khat-thanh-loc-co-the");
INSERT INTO products VALUES("8","Homemade Grass Jelly, Delicious and Nutritious","2","1","5","1","Our homemade grass jelly is safe and hygienic, so everyone should order it and eat it on hot days like this to cool down! Combining it with a cup of your choice of milk tea is even more wonderful.","10000","Black","Grass jelly leaves","Optional","<p><strong>Our homemade grass jelly is safe and hygienic, so everyone should order it and eat it on hot days like this to cool down! Combining it with a cup of your choice of milk tea is even more wonderful.</strong></p>
\n
\n<h4><br />
\n<strong>HOW IS GRASS JELLY GOOD FOR YOU?</strong></h4>
\n<strong>Grass jelly</strong>&nbsp;<em>(southern dialect)</em>&nbsp;is loved by many people during the hot season and is also good for health, especially for women and children. In addition, grass jelly helps to lower blood pressure, supports the treatment of diabetes, cools the liver, treats colds caused by heat, muscle pain, arthritis...
\n
\n<p>Grass jelly is not only a common cooling drink but also a panacea.<strong><em>&nbsp;</em></strong>According to Oriental medicine, grass jelly leaves have a sweet taste, cool properties, and have the effect of cooling the body, helping metabolic processes in the body take place easily... so they are often used to cook and process into grass jelly desserts to cool down on hot, sultry summer days.&nbsp;Currently, in many Asian countries, people believe that grass jelly leaf powder has a diuretic effect.</p>
\n
\n<hr />
\n<p>Order now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose many different portions and prices (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)</p>
\n","","2020-03-19","Tan Hong ","2020-04-11 14:38:56","34","0","0","suong-sao-nha-tu-lam-ngon-bo-duong-8img1.jpg","","","","suong-sao-nha-tu-lam-ngon-bo-duong");
INSERT INTO products VALUES("9","Fried fish balls (can be ordered by portion with optional price)","2","1","2","1","Crispy and delicious fried fish balls with cucumber and a great cup of milk tea.","20000","Yellowish brown","Fish balls, cucumber, chili sauce,...","Medium - 15k, Large - 20k, Optional price setup","Crispy and delicious fried fish balls with cucumber and a great cup of milk tea.<br />
\n<br />
\nYou can order a setup according to the portion price you want.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose many different portions and prices (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/new-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" style=\"height:23px; width:23px\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-19 12:31:23","25","0","0","ca-vien-chien-9img1.jpg","ca-vien-chien-co-the-dat-theo-phan-tuy-chon-gia-9img2.jpg","","","ca-vien-chien-co-the-dat-theo-phan-tuy-chon-gia");
INSERT INTO products VALUES("10","Fried shrimp balls (can be ordered by portion with optional price)","2","1","2","1","ok","20000","Yellowish brown","Shrimp balls, chili sauce, cucumber","Medium - 15k, Large - 20k","<p>Crispy, chewy, and rich-flavored fried shrimp balls, I often make them for my child to snack on and for the whole family to eat with rice, they're very delicious!</p>
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/new-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" style=\"height:23px; width:23px\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-19 12:31:42","25","0","0","tom-vien-co-the-dat-theo-phan-tuy-chon-gia-10img1.jpg","","","","tom-vien-co-the-dat-theo-phan-tuy-chon-gia");
INSERT INTO products VALUES("11","Fried beef balls (can be ordered by portion with optional price)","2","1","2","1","Crispy and delicious fried beef balls with cucumber and a great cup of milk tea.","20000","Yellowish brown","Beef balls, chili sauce, cucumber","Medium - 15k, Large - 20k, Optional price setup","Golden, hot, and fragrant beef pieces combined with the rich flavor of the dipping sauce, irresistible and delicious, anyone will crave them. That's fried beef balls.<br />
\n<br />
\nBeef balls are made from beef that has been ground into a fine powder and can be easily distinguished from pork or fish balls because beef balls are darker in color and the most popular type is tendon beef balls, because they are chewy.<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose different sizes, quantities, and prices when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/new-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" style=\"height:23px; width:23px\" title=\"heart\" />)","","2020-03-19","Tan Hong ","2020-04-19 12:30:55","26","0","0","bo-vien-co-the-dat-theo-phan-tuy-chon-gia-11img1.jpg","","","","bo-vien-co-the-dat-theo-phan-tuy-chon-gia");
INSERT INTO products VALUES("24","Fried pancake (Savory version) - Large, crispy, delicious, served with fresh vegetables","1","1","1","0","Fried pancake (Savory version) is large and crispy, served with fresh vegetables and sweet homemade fish sauce that is safe and hygienic...","20000","Yellow","Cassava flour, shrimp, sprouts, pork, mushrooms, fresh vegetables,...","Large","<h4>Introduction:</h4>
\n
\n<p><em>The name ""fried pancake"" comes from the sound of pouring the batter into the pan, which makes a ""sizzling"" sound. The cake has a delicious flavor that carries the characteristics of the Southern folk culinary culture.</em></p>
\n
\n<p><strong>Fried pancake</strong>&nbsp;is a favorite dish of Vietnamese people across the three regions. Depending on the cuisine of each region, the filling can be bean sprouts, papaya or wild flowers, pork belly, shrimp, chicken, or minced duck...<br />
\n<br />
The pancake is fried in oil but does not taste greasy because it is served with many types of vegetables such as lettuce, fish mint, herbs, some people also like to eat it with green mustard greens, shredded green mango, pineapple, carrots...</p>
\n
\n<hr />Order now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose to eat with bean sprouts or without, or remove the ingredients you don't like when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-27","Tan Hong ","2020-04-11 15:20:26","87","0","0","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-man-24img1.jpg","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-man-24img2.jpg","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-man-24img3.jpg","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-man-24img4.jpg","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-man");
INSERT INTO products VALUES("22","Flan cake (can be ordered by portion with optional price)","3","1","2","0","Flan cake is also known as Caramel. This is a delicious, soft, and attractive cake that is loved by many people of all ages.","7000","Yellow","Fresh milk, eggs, caramel sugar,....","Round box","<h4>Introduction:</h4>
\nFlan cake is a delicious and nutritious dessert, it was first made in France and has become popular in most countries around the world.<br />
\n<br />
\n<strong>Flan cake is also known as Caramel. This is a delicious, soft, and attractive cake that is loved by many people of all ages. The cake is steamed from the main ingredients of eggs and milk; caramel sauce. This is a type of cake that probably originated from European cuisine; but is now popular in many places around the world.</strong><br />
\n&nbsp;
\n<hr /><br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose the quantity, size, and price setup when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-25","Tan Hong ","2020-04-11 17:41:36","108","1","28","banh-plan-co-the-dat-theo-phan-tuy-chon-gia-22img1.jpg","banh-plan-22img2.jpg","banh-plan-co-the-dat-theo-phan-tuy-chon-gia-22img3.jpg","banh-plan-22img4.jpg","banh-plan-co-the-dat-theo-phan-tuy-chon-gia");
INSERT INTO products VALUES("25","Fried pancake (Vegetarian version) - Large, crispy, delicious, served with fresh vegetables","1","1","1","0","Fried pancake (Vegetarian version) is large and crispy, served with fresh vegetables and sweet homemade fish sauce that is safe and hygienic...","15000","Yellow","Cassava flour, tofu, sprouts, mushrooms,....","Large","<h4>Introduction:</h4>
\n
\n<p><em>The name ""fried pancake"" comes from the sound of pouring the batter into the pan, which makes a ""sizzling"" sound. The cake has a delicious flavor that carries the characteristics of the Southern folk culinary culture.</em></p>
\n
\n<p><strong>Fried pancake</strong>&nbsp;is a favorite dish of Vietnamese people across the three regions. Depending on the cuisine of each region, the filling can be bean sprouts, papaya or wild flowers, pork belly, shrimp, chicken, or minced duck...<br />
\n<br />
The pancake is fried in oil but does not taste greasy because it is served with many types of vegetables such as lettuce, fish mint, herbs, some people also like to eat it with green mustard greens, shredded green mango, pineapple, carrots...</p>
\n
\n<hr />Order now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose to eat with bean sprouts or without, or remove the ingredients you don't like when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-27","Tan Hong ","2020-04-11 21:33:43","59","0","0","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-chay-25img1.jpg","","","","banh-xeo-chao-to-gion-ngon-kem-rau-rung-hap-dan-loai-an-chay");
INSERT INTO products VALUES("26","5 Flan cakes combined with fresh milk and coffee","1","1","2","0","Flan cake is also known as Caramel. This is a delicious, soft, and attractive cake that is loved by many people of all ages.","25000","Yellow","Coffee, fresh milk, eggs, caramel sugar,....","Large","<h4>Introduction:</h4>
\nFlan cake is a delicious and nutritious dessert, it was first made in France and has become popular in most countries around the world.<br />
\n<br />
\n<strong>Flan cake is also known as Caramel. This is a delicious, soft, and attractive cake that is loved by many people of all ages. The cake is steamed from the main ingredients of eggs and milk; caramel sauce. This is a type of cake that probably originated from European cuisine; but is now popular in many places around the world.</strong><br />
\n&nbsp;
\n<hr /><br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose the quantity, size, and price setup when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-04-10","Tan Hong ","2020-04-11 17:40:19","58","0","0","ly-banh-plan-5-cai-ket-hop-sua-tuoi-va-cafe-26img1.jpg","ly-banh-plan-5-cai-ket-hop-sua-tuoi-va-cafe-26img2.jpg","ly-banh-plan-5-cai-ket-hop-sua-tuoi-va-cafe-26img3.jpg","","ly-banh-plan-5-cai-ket-hop-sua-tuoi-va-cafe");
INSERT INTO products VALUES("27","Pudding jelly with many different delicious and cool flavors","2","1","2","0","Pudding with milk tea is an extremely delicious and attractive dessert, loved by many people, especially young people.","4000","Many colors to choose from","Water, sugar, Gelatine, Syrup,....","Container","<u><strong>Information</strong></u>:<br />
\nPudding is a type of dessert that originated in France. It was imported to Vietnam not long ago.</em><br />
\n<br />
\nToday, pudding is transformed with many different recipes and ingredients, giving us more choices for this attractive dessert. Depending on the ingredients used, pudding has different colors. Green from green tea, yellow from eggs or ripe mango, brown from chocolate,...<br />
\n<br />
\nBesides being used as a dessert, pudding is also used as a topping for some dishes. The most popular is to add it to milk tea, use it with other types of jelly, or eat it with fruit,...<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<u><strong>Instructions for use</strong></u>: Use immediately<br />
\n<br />
\n<u><strong>Storage</strong></u>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose many different jellies, sizes, and prices when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-27","Tan Hong ","2020-04-11 21:35:34","57","0","0","pudding-thach-nhieu-loai-khac-nhau-ngon-mat-27img1.jpg","pudding-thach-nhieu-loai-khac-nhau-ngon-mat-27img2.jpg","pudding-thach-nhieu-loai-khac-nhau-ngon-mat-27img3.jpg","pudding-thach-nhieu-loai-khac-nhau-ngon-mat-27img4.jpg","pudding-thach-nhieu-loai-khac-nhau-ngon-mat");
INSERT INTO products VALUES("28","Bioaqua Sleeping Mask in Pill Form","2","2","8","0","ertyuio","10000","Green","aloe vera","Pill form","The Bioaqua pill-shaped sleeping mask is a product trusted by many Chinese people. It is cheap but has a very good skin care effect, suitable for the needs of students who do not have the conditions to experience high-end products from Japan and Korea
\n<div style=\"margin-left: 40px;\">- Bioaqua jelly mask sleeping mask contains abundant nutrients that bring smooth, rosy skin after just a few uses.<br />
\n- The sleeping mask has a thick gel texture and a very pleasant scent. It is made from natural fruits, so it is extremely gentle<br />
\n- Improved sleep quality will help enhance the skin's ability to regenerate and restore effectively<br />
\n- Helps nourish and moisturize, making skin soft and smooth<br />
\n- Gradually brightens the skin, making the color even and radiant<br />
\n- Gentle skin care and nourishment for all skin types<br />
\n- Helps tighten pores, prevent acne and treat inflammatory skin problems, effective acne treatment for blackheads<br />
\n- Nourishes soft, smooth skin, increases skin elasticity</div>
\n<br />
\n<u><strong>Uses:</strong></u>
\n
\n<ul>
\n	<li>Aloe vera: Aloe vera extract has the effect of brightening skin, moisturizing, cleaning sebum, and especially high oil control ability</li>
\n	<li>Cherry Blossom: Has the effect of moisturizing, smoothing skin, helping skin firm and increase elasticity</li>
\n	<li>Blueberry: Has the effect of whitening, deep moisturizing to keep skin smooth and full of vitality</li>
\n</ul>
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\n( When ordering, please remember to leave a note for our shop&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-03-27","Tan Hong ","2020-04-11 21:31:17","125","0","0","mat-na-ngu-bioaqua-vien-thuoc-28img1.jpg","mat-na-ngu-bioaqua-vien-thuoc-28img2.jpg","mat-na-ngu-bioaqua-vien-thuoc-28img3.jpg","","mat-na-ngu-bioaqua-vien-thuoc");
INSERT INTO products VALUES("31","Kumquat Tea - Refreshing, detoxifying, non-fattening","1","1","5","0","Normally, it's nothing special, but in the hot season, it becomes ""hotter"" than ever because the demand for drinks increases, especially its ability to quench thirst...","10000","Orange yellow","Green tea, kumquat"," ","Kumquat tea is a familiar cool drink, of course its main ingredients are tea, kumquat and sugar. In addition, there is also passion fruit, orange, honey depending on the customer's request.<br />
\n<br />
\nNormally, it's nothing special, but in the hot season, it becomes ""hotter"" than ever because the demand for drinks increases, especially its ability to quench thirst, which must be said to be of a high level with a cool sweet and sour taste and a cheap price.&nbsp;<br />
\n<br />
\nOrder now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose different sizes and prices when ordering (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-04-11","Tan Hong ","2020-04-11 23:32:32","11","0","0","tra-tac---giai-khat--thanh-loc-co-the--khong-beo-31img1.jpg","tra-tac---giai-khat--thanh-loc-co-the--khong-beo-31img2.jpg","","","tra-tac---giai-khat--thanh-loc-co-the--khong-beo");
INSERT INTO products VALUES("32","Fresh milk with jelly and pearls (Optional price 15k, 20k, 25k)","1","1","5","0","If you are tired of milk tea, fresh milk is a suitable and non-fattening choice that is also good for your health.","15000","White","Fresh milk, pearls, flan, pudding,...","Cup","If you are tired of milk tea, fresh milk is a suitable and non-fattening choice that is also good for your health.<br />
\n<br />
\nKorean fresh milk with pearls is currently a very hot drink among young people today, because of the fragrant and rich taste of fresh milk, the chewy and soft texture of pearls, and the light sweetness of Korean brown sugar.
\n<hr />Order now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately.<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","","2020-04-13","Tan Hong ","2020-04-13 16:50:16","22","0","0","sua-tuoi-thach--chan-chau-32img1.jpg","","","","sua-tuoi-thach--chan-chau");
INSERT INTO products VALUES("33","Fresh milk with Milo - delicious crushed Cocoa 20000d","1","1","5","0","trehr","20000","White brown","Fresh milk, pearls, flan, milo pudding,...","Cup","Fresh milk with Milo - delicious crushed Cocoa 20000d<br />
\n<br />
\nIf you are tired of milk tea, fresh milk with crushed Milo and cocoa is a suitable and non-fattening choice that is also good for your health.
\n<hr />Order now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Instructions for use</strong>: Use immediately.<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a lot of jelly or a lot of pearls (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/new-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" style=\"height:23px; width:23px\" title=\"heart\" />)","Tan Hong","2020-04-13","Tan Hong ","2020-04-19 12:45:51","32","0","0","sua-tuoi-milo-cacao-dam-33img1.jpg","sua-tuoi-milo-cacao-dam-33img2.jpg","sua-tuoi-milo-cacao-dam-33img3.jpg","sua-tuoi-milo-cacao-dam-33img4.jpg","sua-tuoi-milo-cacao-dam");
INSERT INTO products VALUES("34","Chicken feet with lemongrass and kumquat, served with delicious dipping sauce","1","1","2","0","Fast delivery, the chicken feet are well-seasoned and crispy, served with a spicy and delicious homemade dipping sauce.","50000"," ","Chicken feet, lemongrass, kumquat, chili (optional), dipping sauce","Large jar","Fast delivery, the chicken feet are well-seasoned and crispy, served with a spicy and delicious homemade dipping sauce.<br />
\n<br />
\nThe taste is salty, slightly sour, and a little spicy. I like to eat a lot of sourness, so I squeeze more kumquat from the bag of chicken. The dipping sauce is sweet, sour, and spicy.<br />
\n<br />
\nAppearance: there are green and red colors of kumquat, chili and lemongrass, the jar is sturdy.
\n<hr />Order now, our shop supports free shipping within a 5km radius and provides enthusiastic support as well as many incentives for our loyal customers.<br />
\n<br />
\nRemember to create an account and place an order to save many orders, our shop will have many incentives for loyal customers! Thank you, everyone.<br />
\n<br />
\n<strong>Storage</strong>: Avoid direct sunlight<br />
\n<br />
\nCommitment to Food Safety and Hygiene.<br />
\n<br />
\nCustomers can choose a larger size or a custom price (When ordering, please remember to leave a note&nbsp;<img alt=\"heart\" src=\"http://localhost/php-mvc-shop/admin/themes/plugins/ckeditor/plugins/smiley/images/heart.png\" title=\"heart\" />)","Tan Hong ","2020-04-16","Tan Hong ","2020-04-16 10:59:49","23","0","0","chan-ga-xa-tac-kem-nuoc-xot-cham-ngon-34img1.jpg","chan-ga-xa-tac-kem-nuoc-xot-cham-ngon-34img2.jpg","","","chan-ga-xa-tac-kem-nuoc-xot-cham-ngon");


DROP TABLE IF EXISTS roles;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_desc` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES("1","Admin","Administrator managing the website system ");
INSERT INTO roles VALUES("2","Moderator","Assistant manager");


DROP TABLE IF EXISTS slides;

CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_img1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_text1` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_text2` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_text3` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_img4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_text4` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_img5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_text5` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO slides VALUES("1","HomePage 1","image1-1-homepage-1.jpg","Just place an order, Chi Koi's shop will immediately fry and deliver it for you to enjoy.","image2-1-homepage-1.jpg","Many types of milk tea for you to choose freely","image3-1-homepage-1.jpg","Many different snacks for you to enjoy","","","","","1");


DROP TABLE IF EXISTS subcategory;

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supply_id` int(11) DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_supply_id` (`supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO subcategory VALUES("1","Fried Pancakes","1","1","banh-xeo");
INSERT INTO subcategory VALUES("2","Snacks","1","1","do-an-vat");
INSERT INTO subcategory VALUES("3","Milk Tea","1","1","tra-sua");
INSERT INTO subcategory VALUES("4","Beans & Seeds","1","1","dau-va-hat");
INSERT INTO subcategory VALUES("5","Eating & Drinking","1","1","an-uong-giai-khat");
INSERT INTO subcategory VALUES("8","Moisturizing mask","1","2","mat-na-duong-da");


DROP TABLE IF EXISTS supplies;

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supply_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO supplies VALUES("1","Vietnam","");


DROP TABLE IF EXISTS types;

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO types VALUES("1","FEATURED PRODUCTS (HOT)","","san-pham-noi-bat");
INSERT INTO types VALUES("2","NEW PRODUCTS","","san-pham-moi");
INSERT INTO types VALUES("3","SALE PRODUCTS","","san-pham-giam-gia");


-- CORRECTION: Changed `user_address` from `varchar(200)` to `varchar(500)`
-- to prevent data truncation errors for long address strings.
DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `user_avatar` varchar(550) COLLATE utf8mb4_unicode_ci DEFAULT 'author-auto.png',
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `verificationCode` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_role` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1042 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","testna","25f9e794323b453885f5181f1b624d0b","Nguyen Tan","0","avatar-user1-test.png","test@gmail.com","01663220339","Xuan Lu1ed9cccthis copy of windows is genurehh","2020-03-22 00:00:00","0","0c2bae3b44c3c49553714688df3dbd05","2020-04-12 04:57:09");
INSERT INTO users VALUES("1014","Tan","202cb962ac59075b964b07152d234b70","Nguyen Tan","2","avatar-user1014-tan.jpg","ph12357tan@gmail.com","89941576","3128  Doctors Drive","2020-03-24 00:00:00","1","793f470cada3b6223637ca20dc0cb9d3",NULL);
INSERT INTO users VALUES("2","tanhongit","847265df1ad7102fe1b5d97884e51801","Tan Hong ","1","avatar-user1011-tanhongit.jpg","phuongtan12357nguyen@gmail.com","363220339","xuan loc, dong nai, vietnam","2020-03-24 00:00:00","1","dd5bfe95860b785a82126bd40a7fc093","2020-04-13 11:46:18");
INSERT INTO users VALUES("4","tanhongitii","25f9e794323b453885f5181f1b624d0b","Tan Hong IT","0","avatar-user1018-tanhongitii.jpg","meowwww@gmail.com.com","363220339","xuan loc, dong nai, vietnam","2020-04-11 00:00:00","0","",NULL);
INSERT INTO users VALUES("3","moderator","25d55ad283aa400af464c76d713c07ad","Tan Hong IT","2","author-auto.png","moderator@gmail.com","363220339","xuan loc, dong nai, vietnam","2020-04-07 00:00:00","1","47986eab669c010f869a7c7f288873e2","2020-04-11 03:18:25");
INSERT INTO users VALUES("1038","shtshrffgd","e807f1fcf82d132f9bb018ca6738a19f","t4greg","0","author-auto.png","phuong12357tan@gmail.com","+8489941576","3128  Doctors Drive","2020-04-02 01:35:31","0","3cb8761195802abf0656e670f73b277c","2020-04-11 01:40:43");
INSERT INTO users VALUES("1039","thtreht","e807f1fcf82d132f9bb018ca6738a19f","dtrdhtrjy","2","author-auto.png","trehytrh@gmail.com","4089941576","3128  Doctors Drive","2020-04-11 02:41:21","0","9b20629c075697db8c9c5d3b94a86f8b",NULL);
INSERT INTO users VALUES("1040","admin","e807f1fcf82d132f9bb018ca6738a19f","Admin","1","author-auto.png","admin@gmail.com","4089941576","3128  Doctors Drive","2020-04-11 02:43:23","0","aca75e03278fa33d61ce42889ea19ed3",NULL);
INSERT INTO users VALUES("1041","user","eba0fd768067afc24806607a4de3f852","User","0","author-auto.png","ph12rgesgresg@gmail.com","4089941576","3128  Doctors Drive","2020-04-11 02:45:37","0","8d9bce9a1dec443a338a00c3e79576f8","2020-04-11 03:20:35");


DROP TABLE IF EXISTS users_online;

CREATE TABLE `users_online` (
  `session` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(34) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` varchar(550) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateonline` datetime NOT NULL,
  PRIMARY KEY (`session`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users_online VALUES("imug14ki0q2voomg1vec6bpu3p","1586580224","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-11 11:43:44");
INSERT INTO users_online VALUES("msj692bj83nad5ddvb6cjt79gg","1586593321","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-11 15:22:01");
INSERT INTO users_online VALUES("tkck1ninob4qj4b1m6hg2odkj1","1586602762","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-11 17:59:22");
INSERT INTO users_online VALUES("1l835nbt5ge32riiu32u0tnoft","1586601715","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-11 17:41:55");
INSERT INTO users_online VALUES("cu5calrh294f4e1skmk3epsbdh","1586624144","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-11 23:55:44");
INSERT INTO users_online VALUES("ipr1h8bpsm81sio33kidr09875","1586626277","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-12 00:31:17");
INSERT INTO users_online VALUES("qrg3jbpj8gbnk7jkqfv14jp4db","1586684941","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-12 16:49:01");
INSERT INTO users_online VALUES("dch2468m3nkh54pg7eqrimnch3","1586667589","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-12 11:59:49");
INSERT INTO users_online VALUES("2fhq7n9nkvdptlktjvpeuian83","1586745634","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-13 09:40:34");
INSERT INTO users_online VALUES("d83k1hq46e2bnbphk4qog0duka","1586769577","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-13 16:19:37");
INSERT INTO users_online VALUES("ct2ha9tsdmukk92cnb6aivgi32","1586758860","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-13 13:21:00");
INSERT INTO users_online VALUES("q6uhu0g4qt794me6dl4tolt69q","1586799218","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-14 00:33:38");
INSERT INTO users_online VALUES("gokih8mthn12kftet0ofnlv9ke","1586884245","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-15 00:10:45");
INSERT INTO users_online VALUES("g4nbe3cgookc4l9dd8b5nn5bra","1586934776","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-15 14:12:56");
INSERT INTO users_online VALUES("ip13q3g2qd2kttsot6onpa6bh1","1587063041","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-17 01:50:41");
INSERT INTO users_online VALUES("70g1j4g341vtk69o01hrhd1mpo","1587133220","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-17 21:20:20");
INSERT INTO users_online VALUES("toh12m5lrfcgtl3edkknlc14fq","1587134595","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-17 21:43:15");
INSERT INTO users_online VALUES("jf2s4n36q8cdfub5qs60vsuoic","1587200885","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-18 16:08:05");
INSERT INTO users_online VALUES("7sjnm4igkiue8ir2et5i5m4ric","1587207351","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-18 17:55:51");
INSERT INTO users_online VALUES("giqe6d6bil5g8efmmovlnr6dss","1587226980","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-18 23:23:00");
INSERT INTO users_online VALUES("go2mug9fde7cphdknjrc39rupb","1587263351","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-19 09:29:11");
INSERT INTO users_online VALUES("ndssrnrd7p4itagsjq4pqdc49t","1587278220","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36","2020-04-19 13:37:00");
