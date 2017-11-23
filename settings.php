<?php
	// Default timezone //
	date_default_timezone_set('Europe/Rome');
	
	// DNC Do not change, initializes the M_CLI constant to true if the script
	// is being run via command line.
	define( 'M_CLI', (PHP_SAPI == 'cli') ? true : false );
	// End DNC
	
	// Define DB Connection params - MySql only at the moment //
	define( 'M_DB_HOST', '' );
	define( 'M_DB_CATALOG', '' );
	define( 'M_DB_USER', '' );
	define( 'M_DB_PASSWORD', '' );
	
	// Define PATHS, do not change if you keep the default dir structure //
	define( 'M_BASE_PATH', dirname(__FILE__) );
	define( 'M_SOURCES', M_BASE_PATH . '/core/sources' );
	define( 'M_LIBRARIES', M_BASE_PATH . '/core/libraries' );
	define( 'M_CACHE', M_BASE_PATH . '/core/cache' );
	define( 'M_CLASSES', M_BASE_PATH . '/core/classes' );
	define( 'M_UPLOADS', M_BASE_PATH . '/uploads' );
	define( 'M_COMPOSER', M_BASE_PATH . '/vendor/autoload.php' );
	
	// Define URLs and site options //
	define( 'M_BASE_URL', '' );
	define( 'M_NAME', 'Site Name' );
	define( 'M_CLAIM', 'Site Claim' );
	define( 'M_DESCRIPTION', 'Default description for SEO' );
	define( 'M_KEYWORDS', 'Default keywords for SEO' );
	define( 'M_SEPARATOR', '|' );
	
	// Define routes //
	$routes = array(
		'/^(\/)?$/' => 'home.php', // "/"
		'/404/' => '404.php', // "/404"
		'/issues(\/)?(page\/[0-9]+)?(\/)?$/' => 'issues/list.php', // "/issues/page/PAGE_NUMBER"
		'/issue\/[0-9]+\/[a-zA-Z0-9_\-]+(\/)?$/' => 'issues/issue.php', // "/issue/ISSUE_NUMBER/ISSUE_TITLE/"
		'/read\/[a-zA-Z0-9_\-]+\/[0-9]+(\/)?$/' => 'issues/article.php', // "/issue/ISSUE_TITLE/ISSUE_ID/read/ARTICLE_TITLE/ARTICLE_ID"
		'/page\/[a-zA-Z0-9_\-]+\/[0-9]+(\/)?$/' => 'pages/page.php', // "/page/PAGE_NAME/PAGE_ID",
		'/login(\/)?/' => 'admin/login.php' // "/login"
	);