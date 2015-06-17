<?php
	header("HTTP/1.0 505 Server Error");
	trigger_error ( $output->error, E_USER_ERROR );
?>