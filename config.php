<?php
// HTTP
	define('HTTP_SERVER', 'http://localhost/fund/');
	define('HTTP_CATALOG', 'http://localhost/fund/');

// HTTPS
	define('HTTPS_SERVER', 'http://localhost/fund/');
	define('HTTPS_CATALOG', 'http://localhost/fund/');
	$path=__DIR__.'/';
// DIR
	define('DIR_APPLICATION', $path);
	define('DIR_SYSTEM', $path.'system/');
	define('DIR_LANGUAGE', $path.'language/');
	define('DIR_TEMPLATE', $path.'view/template/');
	define('DIR_CONFIG', $path.'system/config/');
	define('DIR_IMAGE', $path.'image/');
	define('DIR_CACHE', $path.'system/cache/');
	define('DIR_DOWNLOAD', $path.'system/download/');
	define('DIR_UPLOAD', $path.'system/upload/');
	define('DIR_LOGS', $path.'system/logs/');
	define('DIR_MODIFICATION', $path.'system/modification/');
	define('DIR_CATALOG', $path.'catalog/');

// DB
	define('DB_DRIVER', 'mysqli');
	define('DB_HOSTNAME', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'fund');
	define('DB_PREFIX', '');
