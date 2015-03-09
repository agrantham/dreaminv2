<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

WARNING - 2015-01-24 01:25:48 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 03:34:55 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 13:33:58 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 13:34:18 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 13:34:19 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 13:34:23 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 13:34:39 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 16:33:45 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 16:33:49 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 16:33:49 --> Error - Invalid method: Auth\Auth::find in /var/www/html/fuel/fuel/packages/auth/classes/auth.php on line 348
WARNING - 2015-01-24 16:49:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:04:45 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:04:45 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:04:45 --> Error - Invalid method: Auth\Auth::find in /var/www/html/fuel/fuel/packages/auth/classes/auth.php on line 348
WARNING - 2015-01-24 17:07:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:07:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:07:25 --> Fatal Error - Class 'Auth_User' not found in /var/www/html/fuel/fuel/app/classes/controller/users.php on line 11
WARNING - 2015-01-24 17:08:07 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:08:07 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:28:58 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:32:30 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:33:51 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:33:51 --> Parsing Error - syntax error, unexpected '->' (T_OBJECT_OPERATOR) in /var/www/html/fuel/fuel/app/classes/controller/welcome.php on line 36
WARNING - 2015-01-24 17:34:00 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:34:00 --> Parsing Error - syntax error, unexpected '->' (T_OBJECT_OPERATOR) in /var/www/html/fuel/fuel/app/classes/controller/welcome.php on line 39
WARNING - 2015-01-24 17:34:09 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:34:09 --> Fatal Error - Call to undefined method Orm\Query::execute() in /var/www/html/fuel/fuel/app/classes/controller/welcome.php on line 39
WARNING - 2015-01-24 17:34:19 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:35:51 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:36:35 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:36:35 --> Fatal Error - Undefined constant 'user\Model\Auth_User' in /var/www/html/fuel/fuel/app/classes/controller/welcome.php on line 14
WARNING - 2015-01-24 17:36:42 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:37:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:37:25 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 't0.group' in 'field list' with query: "SELECT `t0`.`id` AS `t0_c0`, `t0`.`username` AS `t0_c1`, `t0`.`password` AS `t0_c2`, `t0`.`group` AS `t0_c3`, `t0`.`email` AS `t0_c4`, `t0`.`last_login` AS `t0_c5`, `t0`.`login_hash` AS `t0_c6`, `t0`.`profile_fields` AS `t0_c7`, `t0`.`created_at` AS `t0_c8`, `t0`.`updated_at` AS `t0_c9` FROM `users` AS `t0` JOIN `clouds_users` AS `t0_through` ON (`t0_through`.`userid` = `t0`.`id`) WHERE `t0_through`.`cloudid` = '2'" in /var/www/html/fuel/fuel/core/classes/database/pdo/connection.php on line 270
WARNING - 2015-01-24 17:38:46 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:38:46 --> Fatal Error - Class 'Auth_Cloud' not found in /var/www/html/fuel/fuel/app/classes/controller/welcome.php on line 37
WARNING - 2015-01-24 17:38:54 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:38:54 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 't1.group' in 'field list' with query: "SELECT `t0`.`id` AS `t0_c0`, `t0`.`title` AS `t0_c1`, `t0`.`body` AS `t0_c2`, `t0`.`status` AS `t0_c3`, `t0`.`goal` AS `t0_c4`, `t0`.`created_at` AS `t0_c5`, `t0`.`updated_at` AS `t0_c6`, `t1_through`.`userid`, `t1_through`.`cloudid`, `t1`.`id` AS `t1_c0`, `t1`.`username` AS `t1_c1`, `t1`.`password` AS `t1_c2`, `t1`.`group` AS `t1_c3`, `t1`.`email` AS `t1_c4`, `t1`.`last_login` AS `t1_c5`, `t1`.`login_hash` AS `t1_c6`, `t1`.`profile_fields` AS `t1_c7`, `t1`.`created_at` AS `t1_c8`, `t1`.`updated_at` AS `t1_c9` FROM (SELECT `t0`.`id`, `t0`.`title`, `t0`.`body`, `t0`.`status`, `t0`.`goal`, `t0`.`created_at`, `t0`.`updated_at` FROM `clouds` AS `t0` WHERE `t0`.`id` = 3 LIMIT 1) AS `t0` LEFT JOIN `clouds_users` AS `t1_through` ON (`t0`.`id` = `t1_through`.`cloudid`) LEFT JOIN `users` AS `t1` ON (`t1_through`.`userid` = `t1`.`id`)" in /var/www/html/fuel/fuel/core/classes/database/pdo/connection.php on line 270
WARNING - 2015-01-24 17:42:24 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:42:24 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 't1.group' in 'field list' with query: "SELECT `t0`.`id` AS `t0_c0`, `t0`.`title` AS `t0_c1`, `t0`.`body` AS `t0_c2`, `t0`.`status` AS `t0_c3`, `t0`.`goal` AS `t0_c4`, `t0`.`created_at` AS `t0_c5`, `t0`.`updated_at` AS `t0_c6`, `t1_through`.`userid`, `t1_through`.`cloudid`, `t1`.`id` AS `t1_c0`, `t1`.`username` AS `t1_c1`, `t1`.`password` AS `t1_c2`, `t1`.`group` AS `t1_c3`, `t1`.`email` AS `t1_c4`, `t1`.`last_login` AS `t1_c5`, `t1`.`login_hash` AS `t1_c6`, `t1`.`profile_fields` AS `t1_c7`, `t1`.`created_at` AS `t1_c8`, `t1`.`updated_at` AS `t1_c9` FROM (SELECT `t0`.`id`, `t0`.`title`, `t0`.`body`, `t0`.`status`, `t0`.`goal`, `t0`.`created_at`, `t0`.`updated_at` FROM `clouds` AS `t0` WHERE `t0`.`id` = 3 LIMIT 1) AS `t0` LEFT JOIN `clouds_users` AS `t1_through` ON (`t0`.`id` = `t1_through`.`cloudid`) LEFT JOIN `users` AS `t1` ON (`t1_through`.`userid` = `t1`.`id`)" in /var/www/html/fuel/fuel/core/classes/database/pdo/connection.php on line 270
WARNING - 2015-01-24 17:45:47 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:46:59 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 17:46:59 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 't0.group' in 'field list' with query: "SELECT `t0`.`id` AS `t0_c0`, `t0`.`username` AS `t0_c1`, `t0`.`password` AS `t0_c2`, `t0`.`group` AS `t0_c3`, `t0`.`email` AS `t0_c4`, `t0`.`last_login` AS `t0_c5`, `t0`.`login_hash` AS `t0_c6`, `t0`.`profile_fields` AS `t0_c7`, `t0`.`created_at` AS `t0_c8`, `t0`.`updated_at` AS `t0_c9` FROM `users` AS `t0` JOIN `clouds_users` AS `t0_through` ON (`t0_through`.`userid` = `t0`.`id`) WHERE `t0_through`.`cloudid` = '2'" in /var/www/html/fuel/fuel/core/classes/database/pdo/connection.php on line 270
WARNING - 2015-01-24 17:48:29 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:48:54 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:50:00 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:54:38 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:55:01 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:55:08 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:55:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 17:55:24 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:01:22 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
ERROR - 2015-01-24 18:01:22 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 't1.group' in 'field list' with query: "SELECT `t0`.`id` AS `t0_c0`, `t0`.`title` AS `t0_c1`, `t0`.`body` AS `t0_c2`, `t0`.`status` AS `t0_c3`, `t0`.`goal` AS `t0_c4`, `t0`.`created_at` AS `t0_c5`, `t0`.`updated_at` AS `t0_c6`, `t1_through`.`userid`, `t1_through`.`cloudid`, `t1`.`id` AS `t1_c0`, `t1`.`username` AS `t1_c1`, `t1`.`password` AS `t1_c2`, `t1`.`group` AS `t1_c3`, `t1`.`email` AS `t1_c4`, `t1`.`last_login` AS `t1_c5`, `t1`.`login_hash` AS `t1_c6`, `t1`.`profile_fields` AS `t1_c7`, `t1`.`created_at` AS `t1_c8`, `t1`.`updated_at` AS `t1_c9` FROM (SELECT `t0`.`id`, `t0`.`title`, `t0`.`body`, `t0`.`status`, `t0`.`goal`, `t0`.`created_at`, `t0`.`updated_at` FROM `clouds` AS `t0` WHERE `t0`.`id` = 1 LIMIT 1) AS `t0` LEFT JOIN `clouds_users` AS `t1_through` ON (`t0`.`id` = `t1_through`.`cloudid`) LEFT JOIN `users` AS `t1` ON (`t1_through`.`userid` = `t1`.`id`)" in /var/www/html/fuel/fuel/core/classes/database/pdo/connection.php on line 270
WARNING - 2015-01-24 18:01:57 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:03:07 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:03:10 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:03:14 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:03:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:03:26 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:05:23 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
WARNING - 2015-01-24 18:05:23 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
