<?php
class JConfig {
	public $offline = '0';
	public $offline_message = 'Сайт закрыт на техническое обслуживание.<br /> Пожалуйста, зайдите позже.';
	public $display_offline_message = '1';
	public $offline_image = '';
	public $sitename = 'Принт-Экспресс';
	public $editor = 'codemirror';
	public $captcha = '0';
	public $list_limit = '100';
	public $access = '1';
	public $debug = '0';
	public $debug_lang = '0';
	public $dbtype = 'mysqli';
	public $host = 'localhost';
	public $user = 'root';
	public $password = '';
	public $db = 'pedb';
	public $dbprefix = 'pedb_';
	public $live_site = '';
	public $secret = 'vx3qy7bq1SsT9Ujw';
	public $gzip = '1';
	public $error_reporting = 'development';
	public $helpurl = 'https://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
	public $offset = 'Europe/Moscow';
	public $mailer = 'mail';
	public $mailfrom = 'admin@print-express99.ru';
	public $fromname = 'ООО "Принт-Экспресс"';
	public $sendmail = '/usr/sbin/sendmail';
	public $smtpauth = '0';
	public $smtpuser = '';
	public $smtppass = '';
	public $smtphost = 'localhost';
	public $smtpsecure = 'none';
	public $smtpport = '25';
	public $caching = '0';
	public $cache_handler = 'file';
	public $cachetime = '30';
	public $MetaDesc = '';
	public $MetaKeys = '';
	public $MetaTitle = '1';
	public $MetaAuthor = '0';
	public $MetaVersion = '0';
	public $robots = 'noindex, nofollow';
	public $sef = '1';
	public $sef_rewrite = '0';
	public $sef_suffix = '1';
	public $unicodeslugs = '0';
	public $feed_limit = '10';
	public $log_path = 'D:\\Work\\WWW\\XAMPP\\htdocs\\joomla/logs';
	public $tmp_path = 'D:\\Work\\WWW\\XAMPP\\htdocs\\joomla/tmp';
	public $lifetime = '60';
	public $session_handler = 'database';
	public $MetaRights = '© ООО "Принт-Экспресс", 2016';
	public $sitename_pagetitles = '0';
	public $force_ssl = '0';
	public $feed_email = 'site';
	public $cookie_domain = '';
	public $cookie_path = '';
	public $memcache_persist = '1';
	public $memcache_compress = '0';
	public $memcache_server_host = 'localhost';
	public $memcache_server_port = '11211';
	public $memcached_persist = '1';
	public $memcached_compress = '0';
	public $memcached_server_host = 'localhost';
	public $memcached_server_port = '11211';
	public $proxy_enable = '0';
	public $proxy_host = '';
	public $proxy_port = '';
	public $proxy_user = '';
	public $proxy_pass = '';
	public $mailonline = '1';
	public $session_memcache_server_host = 'localhost';
	public $session_memcache_server_port = '11211';
	public $session_memcached_server_host = 'localhost';
	public $session_memcached_server_port = '11211';
	public $frontediting = '1';
	public $asset_id = '1';
	public $cache_platformprefix = '0';
	public $redis_persist = '1';
	public $redis_server_host = 'localhost';
	public $redis_server_port = '6379';
	public $redis_server_auth = '';
	public $redis_server_db = '0';
	public $massmailoff = '0';
}