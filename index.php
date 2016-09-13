<?php
	error_reporting(E_ALL);
 	session_start();
	
	$settings = './settings.php';
	$page = '505.php';
	
	$output = new stdClass();
	$output->error = "missing config file";
	
	if ( file_exists( $settings ) ) {
		
		require_once( $settings );
		
		// TODO //
		// Check that all the required folders have been defined, and that they're existing and writable (if needed) //
		
		// Setup //
		// Include external Libraries //
		if (file_exists( M_LIBRARIES ) ):
			if ( $handle = opendir( M_LIBRARIES ) ):
				while ( false !== ( $entry = readdir($handle) ) ):
					if ( $entry != "." && $entry != ".." && ( is_dir( M_LIBRARIES . '/' . $entry ) ) ):
						if ( $handle2 = opendir( M_LIBRARIES . '/' . $entry ) ):
							while ( false !== ( $entry2 = readdir( $handle2 ) ) ):
								if ($entry2 != "." && $entry2 != ".." && (strstr($entry2, '.lib.php') !== false)):
									require_once( M_LIBRARIES . '/' . $entry . '/' . $entry2 );
								endif;
							endwhile;
						endif;
					endif;
				endwhile;
			endif;
		endif;
		// Include Classes //
		if (file_exists( M_CLASSES ) ):
			if ( $handle = opendir( M_CLASSES ) ):
				while ( false !== ( $entry = readdir($handle) ) ):
					if ( $entry != "." && $entry != ".." && ( is_dir( M_CLASSES . '/' . $entry ) ) ):
						if ( $handle2 = opendir( M_CLASSES . '/' . $entry ) ):
							while ( false !== ( $entry2 = readdir( $handle2 ) ) ):
								if ($entry2 != "." && $entry2 != ".." && (strstr($entry2, '.class.php') !== false)):
									require_once( M_CLASSES . '/' . $entry . '/' . $entry2 );
								endif;
							endwhile;
						endif;
					endif;
				endwhile;
			endif;
		endif;
		// Include and Init modules aded via Composer
		if (file_exists(M_COMPOSER)) require_once( M_COMPOSER );
		
		// Routing //
		$page = '404.php';	
		$output->error = "Invalid route.";	
		$parts = null;
		$self = substr( $_SERVER['REQUEST_URI'] , 1 , strlen ( $_SERVER['REQUEST_URI'] ) );
		$format = (isset($_REQUEST['format'])) ? $_REQUEST['format'] : 'html';	
		$request_uri = explode('?', $self);
		
		foreach( $routes as $key => $value ) {
			if ( preg_match( $key , $request_uri[0] ) ) {
				$page = $value;
				break;
			}
		}
			
		if ($page != '404.php' && $page != '505.php' && file_exists( M_SOURCES )) {
			if ( !file_exists( M_SOURCES .'/' . $page ) ) {
				$page = '404.php';
				$output->error = "Source file not found (" . M_SOURCES . '/' . $page . ")";
			} else {
				$output->error = null;
			}
		}
	}
	
	if ( M_DB_HOST !== '' && M_DB_CATALOG !== '' ) {
		try {
			$DBH = new PDO("mysql:dbname=" . M_DB_CATALOG . ";charset=UTF8;host=" . M_DB_HOST, M_DB_USER, M_DB_PASSWORD);
		} catch (PDOException $e) {
			$page = "505.php";
			$output->error = "unable to connect to the DB: " . $e->getMessage();
		}
	}
	include( M_SOURCES .'/' . $page );
	die();
?>	