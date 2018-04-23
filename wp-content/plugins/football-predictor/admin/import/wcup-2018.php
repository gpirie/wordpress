<?php
if (!defined('ABSPATH')) {
    exit;
}
$sql = "INSERT INTO `{$wpdb->prefix}{$this->prefix}match` (`match_id`,`match_no`, `kickoff`, `home_team_id`, `away_team_id`, `home_goals`, `away_goals`, `home_penalties`, `away_penalties`, `venue_id`, `is_result`, `extra_time`, `stage_id`, `scored`, `wwhen`) VALUES
(1, 1, '2018-06-14 12:00:00', 1, 2, 0, 0, 0, 0, 8, 0, 0, 1, 1, '2018-01-18 21:05:06'),
(2, 2, '2018-06-15 09:00:00', 3, 4, 0, 0, 0, 0, 4, 0, 0, 1, 0, '2018-01-18 21:00:27'),
(3, 3, '2018-06-15 12:00:00', 7, 8, 0, 0, 0, 0, 1, 0, 0, 2, 0, '2018-01-18 21:01:18'),
(4, 4, '2018-06-15 15:00:00', 5, 6, 0, 0, 0, 0, 5, 0, 0, 2, 0, '2018-01-18 21:02:05'),
(5, 5, '2018-06-16 07:00:00', 9, 10, 0, 0, 0, 0, 6, 0, 0, 3, 1, '2018-01-18 21:05:29'),
(6, 6, '2018-06-16 10:00:00', 13, 14, 0, 0, 0, 0, 11, 0, 0, 4, 0, '2018-01-18 21:03:49'),
(7, 7, '2018-06-16 13:00:00', 11, 12, 0, 0, 0, 0, 13, 0, 0, 3, 0, '2018-01-18 21:04:50'),
(8, 8, '2018-06-16 21:00:00', 15, 16, 0, 0, 0, 0, 2, 0, 0, 4, 0, '2018-01-18 21:06:16'),
(9, 9, '2018-06-17 09:00:00', 19, 20, 0, 0, 0, 0, 9, 0, 0, 5, 0, '2018-01-19 15:34:44'),
(10, 10, '2018-06-17 12:00:00', 21, 22, 0, 0, 0, 0, 8, 0, 0, 6, 1, '2018-01-19 15:35:54'),
(11, 11, '2018-06-17 15:00:00', 17, 18, 0, 0, 0, 0, 10, 0, 0, 5, 0, '2018-01-19 15:36:49'),
(12, 12, '2018-06-18 09:00:00', 23, 24, 0, 0, 0, 0, 7, 0, 0, 6, 1, '2018-01-19 15:56:20'),
(13, 13, '2018-06-18 12:00:00', 25, 26, 0, 0, 0, 0, 5, 0, 0, 7, 0, '2018-01-19 15:55:11'),
(14, 14, '2018-06-18 15:00:00', 27, 28, 0, 0, 0, 0, 3, 0, 0, 7, 1, '2018-01-19 15:56:44'),
(15, 15, '2018-06-19 09:00:00', 31, 32, 0, 0, 0, 0, 13, 0, 0, 8, 0, '2018-01-19 15:57:38'),
(16, 16, '2018-06-19 12:00:00', 29, 30, 0, 0, 0, 0, 11, 0, 0, 8, 0, '2018-01-19 15:58:36'),
(17, 17, '2018-06-19 15:00:00', 1, 3, 0, 0, 0, 0, 1, 0, 0, 1, 0, '2018-01-19 15:59:16'),
(18, 18, '2018-06-20 09:00:00', 5, 7, 0, 0, 0, 0, 8, 0, 0, 2, 0, '2018-01-19 16:01:16'),
(19, 19, '2018-06-20 12:00:00', 4, 2, 0, 0, 0, 0, 10, 0, 0, 1, 0, '2018-01-19 16:02:07'),
(20, 20, '2018-06-20 15:00:00', 8, 6, 0, 0, 0, 0, 6, 0, 0, 2, 0, '2018-01-19 16:03:18'),
(21, 21, '2018-06-21 09:00:00', 12, 10, 0, 0, 0, 0, 9, 0, 0, 3, 0, '2018-01-19 16:04:11'),
(22, 22, '2018-06-21 12:00:00', 9, 11, 0, 0, 0, 0, 4, 0, 0, 3, 0, '2018-01-19 17:18:31'),
(23, 23, '2018-06-21 15:00:00', 13, 15, 0, 0, 0, 0, 7, 0, 0, 4, 0, '2018-01-19 17:19:17'),
(24, 24, '2018-06-22 09:00:00', 17, 19, 0, 0, 0, 0, 12, 0, 0, 5, 0, '2018-01-19 17:20:27'),
(25, 25, '2018-06-22 12:00:00', 16, 14, 0, 0, 0, 0, 3, 0, 0, 4, 0, '2018-01-19 17:21:10'),
(26, 26, '2018-06-22 15:00:00', 20, 18, 0, 0, 0, 0, 2, 0, 0, 5, 0, '2018-01-19 17:21:52'),
(27, 27, '2018-06-23 09:00:00', 25, 27, 0, 0, 0, 0, 11, 0, 0, 7, 0, '2018-01-19 17:22:53'),
(28, 28, '2018-06-23 12:00:00', 24, 22, 0, 0, 0, 0, 10, 0, 0, 6, 0, '2018-01-19 17:24:39'),
(29, 29, '2018-06-23 15:00:00', 21, 23, 0, 0, 0, 0, 5, 0, 0, 6, 0, '2018-01-19 17:25:18'),
(30, 30, '2018-06-24 09:00:00', 28, 26, 0, 0, 0, 0, 7, 0, 0, 7, 0, '2018-01-19 17:26:04'),
(31, 31, '2018-06-24 12:00:00', 32, 30, 0, 0, 0, 0, 4, 0, 0, 8, 0, '2018-01-19 17:26:44'),
(32, 32, '2018-06-24 15:00:00', 29, 31, 0, 0, 0, 0, 6, 0, 0, 8, 0, '2018-01-19 17:27:30'),
(33, 33, '2018-06-25 11:00:00', 4, 1, 0, 0, 0, 0, 9, 0, 0, 1, 0, '2018-01-19 17:28:45'),
(34, 34, '2018-06-25 11:00:00', 2, 3, 0, 0, 0, 0, 3, 0, 0, 1, 0, '2018-01-19 17:29:27'),
(35, 35, '2018-06-25 15:00:00', 8, 5, 0, 0, 0, 0, 13, 0, 0, 2, 0, '2018-01-19 17:30:15'),
(36, 36, '2018-06-25 15:00:00', 6, 7, 0, 0, 0, 0, 2, 0, 0, 2, 0, '2018-01-19 17:30:58'),
(37, 37, '2018-06-26 11:00:00', 12, 9, 0, 0, 0, 0, 8, 0, 0, 3, 0, '2018-01-19 17:31:34'),
(38, 38, '2018-06-26 11:00:00', 10, 11, 0, 0, 0, 0, 5, 0, 0, 3, 0, '2018-01-19 17:32:13'),
(39, 39, '2018-06-26 15:00:00', 16, 13, 0, 0, 0, 0, 1, 0, 0, 4, 0, '2018-01-19 17:32:53'),
(40, 40, '2018-06-26 15:00:00', 14, 15, 0, 0, 0, 0, 10, 0, 0, 4, 0, '2018-01-19 17:33:20'),
(41, 41, '2018-06-27 11:00:00', 22, 23, 0, 0, 0, 0, 4, 0, 0, 6, 0, '2018-01-19 17:34:29'),
(42, 42, '2018-06-27 11:00:00', 24, 21, 0, 0, 0, 0, 6, 0, 0, 6, 0, '2018-01-19 17:35:05'),
(43, 43, '2018-06-27 15:00:00', 20, 17, 0, 0, 0, 0, 11, 0, 0, 5, 0, '2018-01-19 17:35:37'),
(44, 44, '2018-06-27 15:00:00', 18, 19, 0, 0, 0, 0, 7, 0, 0, 5, 0, '2018-01-19 17:36:16'),
(45, 45, '2018-06-28 11:00:00', 32, 29, 0, 0, 0, 0, 3, 0, 0, 8, 0, '2018-01-19 17:36:51'),
(46, 46, '2018-06-28 11:00:00', 30, 31, 0, 0, 0, 0, 9, 0, 0, 8, 0, '2018-01-19 17:37:25'),
(47, 47, '2018-06-28 15:00:00', 26, 27, 0, 0, 0, 0, 13, 0, 0, 7, 0, '2018-01-19 17:37:59'),
(48, 48, '2018-06-28 15:00:00', 28, 25, 0, 0, 0, 0, 2, 0, 0, 7, 0, '2018-01-19 17:38:41'),
(49, 49, '2018-06-30 11:00:00', 35, 44, 0, 0, 0, 0, 2, 0, 0, 9, 0, '2018-01-19 17:41:01'),
(50, 50, '2018-06-30 15:00:00', 33, 42, 0, 0, 0, 0, 5, 0, 0, 9, 0, '2018-01-19 17:42:51'),
(51, 51, '2018-07-01 11:00:00', 34, 41, 0, 0, 0, 0, 8, 0, 0, 9, 0, '2018-01-19 17:43:24'),
(52, 52, '2018-07-01 15:00:00', 36, 43, 0, 0, 0, 0, 7, 0, 0, 9, 0, '2018-01-19 17:44:06'),
(53, 53, '2018-07-02 11:00:00', 37, 46, 0, 0, 0, 0, 9, 0, 0, 9, 0, '2018-01-19 17:44:53'),
(54, 54, '2018-07-02 15:00:00', 39, 48, 0, 0, 0, 0, 10, 0, 0, 9, 0, '2018-01-19 17:45:22'),
(55, 55, '2018-07-03 11:00:00', 38, 45, 0, 0, 0, 0, 1, 0, 0, 9, 0, '2018-01-19 17:46:02'),
(56, 56, '2018-07-03 15:00:00', 40, 47, 0, 0, 0, 0, 11, 0, 0, 9, 0, '2018-01-19 17:46:46'),
(57, 57, '2018-07-06 11:00:00', 49, 50, 0, 0, 0, 0, 7, 0, 0, 10, 0, '2018-01-19 17:47:41'),
(58, 58, '2018-07-06 15:00:00', 53, 54, 0, 0, 0, 0, 6, 0, 0, 10, 0, '2018-01-19 17:48:37'),
(59, 59, '2018-07-07 11:00:00', 55, 56, 0, 0, 0, 0, 9, 0, 0, 10, 0, '2018-01-19 17:49:19'),
(60, 60, '2018-07-07 15:00:00', 51, 52, 0, 0, 0, 0, 5, 0, 0, 10, 0, '2018-01-19 17:49:52'),
(61, 61, '2018-07-10 15:00:00', 57, 58, 0, 0, 0, 0, 5, 0, 0, 11, 0, '2018-01-19 17:51:12'),
(62, 62, '2018-07-11 15:00:00', 59, 60, 0, 0, 0, 0, 8, 0, 0, 11, 0, '2018-01-19 17:52:04'),
(63, 63, '2018-07-14 11:00:00', 61, 62, 0, 0, 0, 0, 1, 0, 0, 12, 0, '2018-01-19 17:53:22'),
(64, 64, '2018-07-15 12:00:00', 63, 64, 0, 0, 0, 0, 8, 0, 0, 13, 0, '2018-01-19 17:54:14')";
$wpdb->query($sql);

$sql = "INSERT INTO `{$wpdb->prefix}{$this->prefix}stage` (`stage_name`, `is_group`, `sort_order`, `wwhen`) VALUES
('Group A', 1, 1, '2018-01-19 04:03:57'),
('Group B', 1, 2, '2018-01-19 04:04:06'),
('Group C', 1, 3, '2018-01-19 04:04:15'),
('Group D', 1, 4, '2018-01-19 04:04:24'),
('Group E', 1, 5, '2018-01-19 04:04:33'),
('Group F', 1, 6, '2018-01-19 04:04:44'),
('Group G', 1, 7, '2018-01-19 04:05:07'),
('Group H', 1, 8, '2018-01-19 04:05:22'),
('Round of 16', 0, 9, '2018-01-19 04:05:34'),
('Quarter-finals', 0, 10, '2018-01-19 04:05:46'),
('Semi-finals', 0, 11, '2018-01-19 04:05:58'),
('Play-off for Third Place', 0, 12, '2018-01-19 04:07:01'),
('Final', 0, 13, '2018-01-19 04:07:17')";
$wpdb->query($sql);

$sql = "INSERT INTO `{$wpdb->prefix}{$this->prefix}team` (`team_id`,`name`, `country`, `team_url`, `group_order`, `wwhen`) VALUES
(1, 'Russia', 'RUS', 'http://www.fifa.com/worldcup/teams/team=43965/index.html', 1, '2018-01-18 03:00:00'),
(2, 'Saudi Arabia', 'SAU', 'http://www.fifa.com/worldcup/teams/team=43835/index.html', 1, '2018-01-18 03:00:00'),
(3, 'Egypt', 'EGY', 'http://fifa.com/worldcup/teams/team=43855/index.html', 1, '2018-01-18 03:00:00'),
(4, 'Uruguay', 'URY', 'http://fifa.com/worldcup/teams/team=43930/index.html', 1, '2018-01-18 03:00:00'),
(5, 'Portugal', 'PRT', 'http://fifa.com/worldcup/teams/team=43963/index.html', 2, '2018-01-18 03:00:00'),
(6, 'Spain', 'ESP', 'http://fifa.com/worldcup/teams/team=43969/index.html', 2, '2018-01-18 03:00:00'),
(7, 'Morocco', 'MAR', 'http://fifa.com/worldcup/teams/team=43872/index.html', 2, '2018-01-18 03:00:00'),
(8, 'Iran', 'IRN', 'http://fifa.com/worldcup/teams/team=43817/index.html', 2, '2018-01-18 03:00:00'),
(9, 'France', 'FRA', 'http://fifa.com/worldcup/teams/team=43946/index.html', 3, '2018-01-18 03:00:00'),
(10, 'Australia', 'AUS', 'http://fifa.com/worldcup/teams/team=43976/index.html', 3, '2018-01-18 03:00:00'),
(11, 'Peru', 'PER', 'http://fifa.com/worldcup/teams/team=43929/index.html', 3, '2018-01-18 03:00:00'),
(12, 'Denmark', 'DNK', 'http://fifa.com/worldcup/teams/team=43941/index.html', 3, '2018-01-18 03:00:00'),
(13, 'Argentina', 'ARG', 'http://fifa.com/worldcup/teams/team=43922/index.html', 4, '2018-01-18 03:00:00'),
(14, 'Iceland', 'ISL', 'http://fifa.com/worldcup/teams/team=43951/index.html', 4, '2018-01-18 03:00:00'),
(15, 'Croatia', 'HRV', 'http://fifa.com/worldcup/teams/team=43938/index.html', 4, '2018-01-18 03:00:00'),
(16, 'Nigeria', 'NGA', 'http://fifa.com/worldcup/teams/team=43876/index.html', 4, '2018-01-18 03:00:00'),
(17, 'Brazil', 'BRA', 'http://fifa.com/worldcup/teams/team=43924/index.html', 5, '2018-01-18 03:00:00'),
(18, 'Switzerland', 'CHE', 'http://fifa.com/worldcup/teams/team=43971/index.html', 5, '2018-01-18 03:00:00'),
(19, 'Costa Rica', 'CRI', 'http://fifa.com/worldcup/teams/team=43901/index.html', 5, '2018-01-18 03:00:00'),
(20, 'Serbia', 'SRB', 'http://fifa.com/worldcup/teams/team=1902465/index.html', 5, '2018-01-18 03:00:00'),
(21, 'Germany', 'DEU', 'http://fifa.com/worldcup/teams/team=43948/index.html', 6, '2018-01-18 03:00:00'),
(22, 'Mexico', 'MEX', 'http://fifa.com/worldcup/teams/team=43911/index.html', 6, '2018-01-18 03:00:00'),
(23, 'Sweden', 'SWE', 'http://fifa.com/worldcup/teams/team=43970/index.html', 6, '2018-01-18 03:00:00'),
(24, 'Republic of Korea', 'KOR', 'http://www.fifa.com/worldcup/teams/team=43822/index.html', 6, '2018-01-18 03:00:00'),
(25, 'Belgium', 'BEL', 'http://fifa.com/worldcup/teams/team=43935/index.html', 7, '2018-01-18 03:00:00'),
(26, 'Panama', 'PAN', 'http://fifa.com/worldcup/teams/team=43914/index.html', 7, '2018-01-18 03:00:00'),
(27, 'Tunisia', 'TUN', 'http://fifa.com/worldcup/teams/team=43888/index.html', 7, '2018-01-18 03:00:00'),
(28, 'England', 'ENG', 'http://fifa.com/worldcup/teams/team=43942/index.html', 7, '2018-01-18 03:00:00'),
(29, 'Poland', 'POL', 'http://fifa.com/worldcup/teams/team=43962/index.html', 8, '2018-01-18 03:00:00'),
(30, 'Senegal', 'SEN', 'http://fifa.com/worldcup/teams/team=43879/index.html', 8, '2018-01-18 03:00:00'),
(31, 'Colombia', 'COL', 'http://fifa.com/worldcup/teams/team=43926/index.html', 8, '2018-01-18 03:00:00'),
(32, 'Japan', 'JPN', 'http://fifa.com/worldcup/teams/team=43819/index.html', 8, '2018-01-18 03:00:00'),
(33,'Winner Group A', 'xxx', '', 0, '2018-01-19 02:20:59'),
(34,'Winner Group B', 'xxx', '', 0, '2018-01-19 02:31:37'),
(35,'Winner Group C', 'xxx', '', 0, '2018-01-19 02:31:53'),
(36,'Winner Group D', 'xxx', '', 0, '2018-01-19 02:32:11'),
(37,'Winner Group E', 'xxx', '', 0, '2018-01-19 02:32:25'),
(38,'Winner Group F', 'xxx', '', 0, '2018-01-19 02:32:49'),
(39,'Winner Group G', 'xxx', '', 0, '2018-01-19 02:33:06'),
(40,'Winner Group H', 'xxx', '', 0, '2018-01-19 02:33:23'),
(41,'Second Group A', 'xxx', '', 0, '2018-01-19 02:33:47'),
(42,'Second Group B', 'xxx', '', 0, '2018-01-19 02:34:03'),
(43,'Second Group C', 'xxx', '', 0, '2018-01-19 02:23:36'),
(44,'Second Group D', 'xxx', '', 0, '2018-01-19 02:23:49'),
(45,'Second Group E', 'xxx', '', 0, '2018-01-19 02:24:00'),
(46,'Second Group F', 'xxx', '', 0, '2018-01-19 02:24:14'),
(47,'Second Group G', 'xxx', '', 0, '2018-01-19 02:24:29'),
(48,'Second Group H', 'xxx', '', 0, '2018-01-19 02:24:42'),
(49,'Winner Match 49', 'xxx', '', 0, '2018-01-19 02:24:58'),
(50,'Winner Match 50', 'xxx', '', 0, '2018-01-19 02:25:09'),
(51,'Winner Match 51', 'xxx', '', 0, '2018-01-19 02:25:21'),
(52,'Winner Match 52', 'xxx', '', 0, '2018-01-19 02:25:38'),
(53,'Winner Match 53', 'xxx', '', 0, '2018-01-19 02:25:49'),
(54,'Winner Match 54', 'xxx', '', 0, '2018-01-19 02:26:07'),
(55,'Winner Match 55', 'xxx', '', 0, '2018-01-19 02:26:27'),
(56,'Winner Match 56', 'xxx', '', 0, '2018-01-19 02:26:36'),
(57,'Winner Match 57', 'xxx', '', 0, '2018-01-19 02:26:48'),
(58,'Winner Match 58', 'xxx', '', 0, '2018-01-19 02:26:58'),
(59,'Winner Match 59', 'xxx', '', 0, '2018-01-19 02:27:09'),
(60,'Winner Match 60', 'xxx', '', 0, '2018-01-19 02:27:19'),
(61,'Loser Match 61', 'xxx', '', 0, '2018-01-19 04:09:37'),
(62,'Loser Match 62', 'xxx', '', 0, '2018-01-19 04:09:49'),
(63,'Winner Match 61', 'xxx', '', 0, '2018-01-19 04:10:15'),
(64,'Winner Match 62', 'xxx', '', 0, '2018-01-19 04:10:29')";
$wpdb->query($sql);

$sql = "INSERT INTO `{$wpdb->prefix}{$this->prefix}venue` (`venue_id`,`venue_name`, `venue_url`, `stadium`, `tz_offset`, `wwhen`) VALUES
(1, 'Saint Petersburg Stadium', 'http://fifa.com/worldcup/destination/stadiums/stadium=5031303/index.html', 'Saint Petersburg Stadium', -3, '2018-01-18 03:00:00'),
(2, 'Kaliningrad Stadium', 'http://fifa.com/worldcup/destination/stadiums/stadium=5000437/index.html', 'Kaliningrad Stadium', -3, '2014-01-24 19:57:28'),
(3, 'Volgograd Arena', 'http://fifa.com/worldcup/destination/stadiums/stadium=5000569/index.html', 'Volgograd Arena', -3, '2018-01-18 03:00:00'),
(4, 'Ekaterinburg Arena', 'http://fifa.com/worldcup/destination/stadiums/stadium=5031304/index.html', 'Ekaterinburg Arena', -3, '2018-01-18 03:00:00'),
(5, 'Fisht Stadium', 'http://fifa.com/worldcup/destination/stadiums/stadium=5031302/index.html', 'Fisht Stadium', -3, '2018-01-18 03:00:00'),
(6, 'Kazan Arena', 'http://fifa.com/worldcup/destination/stadiums/stadium=5028773/index.html', 'Kazan Arena', -3, '2018-01-18 03:00:00'),
(7, 'Nizhny Novgorod Stadium', 'http://www.fifa.com/worldcup/destination/stadiums/stadium=5001165/index.html', 'Nizhny Novgorod Stadium', -3, '2018-01-18 03:00:00'),
(8, 'Luzhniki Stadium', 'http://fifa.com/worldcup/destination/stadiums/stadium=810/index.html', 'Luzhniki Stadium', -3, '2018-01-18 03:00:00'),
(9, 'Samara Arena', 'http://fifa.com/worldcup/destination/stadiums/stadium=5001246/index.html', 'Samara Arena', -3, '2018-01-18 03:00:00'),
(10, 'Rostov Arena', 'http://fifa.com/worldcup/destination/stadiums/stadium=5000547/index.html', 'Rostov Arena', -3, '2018-01-18 03:00:00'),
(11, 'Spartak Stadium', 'http://fifa.com/worldcup/destination/stadiums/stadium=5030706/index.html', 'Spartak Stadium', -3, '2018-01-18 03:00:00'),
(12, 'Saint Petersburg Stadium', 'http://fifa.com/worldcup/destination/stadiums/stadium=5031303/index.html', 'Saint Petersburg Stadium', -3, '2018-01-18 03:00:00'),
(13, 'Mordovia Arena', 'http://fifa.com/worldcup/destination/stadiums/stadium=5031301/index.html', 'Mordovia Arena', -3, '2018-01-18 03:00:00')";
$wpdb->query($sql);

$this->setMessage(__('Match data imported', FP_PD));